<?php

namespace App\Http\Controllers\User;

use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactusController extends Controller
{
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
        if ($request->has('replay')) {
            $request->validate([
                'body' => 'required',
            ]);
            $data['body'] = $request->body;
            $data['parent_id'] = $request->parent_id;
            $data['user_id'] = auth()->user()->id;
            ContactUs::create($data);

            return redirect()->route('user.contactus.show', $request->parent_id)->with('success', __('site.message_created'));
        } else {
            $request->validate(['body' => 'required', 'title' => 'required']);
            $data = $request->except(['_token']);
            $data['user_id'] = auth()->user()->id;
            ContactUs::create($data);
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
