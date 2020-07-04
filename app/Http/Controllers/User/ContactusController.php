<?php

namespace App\Http\Controllers\User;

use App\User;
use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ContactMessage;

class ContactusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-usercontactus|all-shoppermissions')->only('create');
        $this->middleware('permission:delete-usercontactus|all-shoppermissions')->only('destroy');
    }

    public function index()
    {
        $messages = ContactUs::where(['user_id' => auth()->user()->id, 'parent_id' => null])->orderBy('read', 'desc')->get();

        return view('users.contactus.index', compact('messages'));
    }

    public function create()
    {
        return view('users.contactus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notification_data = array();
        if ($request->has('replay')) {
            $request->validate([
                'body' => 'required',
            ]);
            $data['body'] = $request->body;
            $data['parent_id'] = $request->parent_id;
            $data['user_id'] = auth()->user()->id;
            $contactMessage = ContactUs::create($data);

            $notification_data = ['contact_message_id' => $contactMessage->parent_id,
            'user_fullname' => $contactMessage->user->first_name.' '.$contactMessage->user->last_name,
                 ];
            //send notifications to admins
            $admins = User::where('type', 0)->get();

            foreach ($admins as $admin) {
                if ($admin->hasAnyPermission(['all', 'index-contactus'])) {
                    $admin->notify(new ContactMessage($notification_data));
                }
            }

            return redirect()->route('user.contactus.show', $request->parent_id)->with('success', __('site.message_created'));
        } else {
            $request->validate(['body' => 'required', 'title' => 'required']);
            $data = $request->except(['_token']);
            $data['user_id'] = auth()->user()->id;
            $contactMessage = ContactUs::create($data);

            //sent notification to admins
            $admins = User::where('type', 0)->get();
            $notification_data = ['contact_message_id' => $contactMessage->id,
            'user_fullname' => $contactMessage->user->first_name.' '.$contactMessage->user->last_name,
                 ];
            //send notifications to admins
            foreach ($admins as $admin) {
                if ($admin->hasAnyPermission(['all', 'index-contactus'])) {
                    $admin->notify(new ContactMessage($notification_data));
                }
            }
        }

        return redirect()->route('user.contactus.index')->with('success', __('site.created_successfully'));
    }

    public function show($id)
    {
        $message = ContactUs::where(['parent_id' => null, 'id' => $id])->first();
        if (is_null($message)) {
            return redirect()->route('user.contactus.index');
        }

        return view('users.contactus.show')->with(['message' => $message]);
    }

    public function destroy($id)
    {
        $message = ContactUs::findOrFail($id);
        if ($message->parent_id == null) {
            foreach ($message->replies as $replay) {
                $replay->delete();
            }

            $message->delete();

            return redirect()->route('user.contactus.index')->with('success', __('site.deleted_successfully'));
        }
        //deletes a replay only
        $message->delete();

        return redirect()->route('user.contactus.show', $message->parent_id)->with('success', __('site.deleted_successfully'));
    }
}
