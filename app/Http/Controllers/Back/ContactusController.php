<?php

namespace App\Http\Controllers\back;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-contactus|all')->only('store');
        $this->middleware('permission:index-contactus|all')->only('index');
        $this->middleware('permission:delete-contactus|all')->only('destroy');
        $this->middleware('permission:show-contactus|all')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $messages = ContactUs::where('parent_id', null);

        if ($request->has('title')) {
            $messages = $messages->where('title', 'like', '%'.$request->input('title').'%');
        }

        $messages = $messages->orderBy('id', 'desc')->get();

        return view('back.contact_us.index')->with([
            'messages' => $messages,
            'page_name' => 'contact_us',
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create($id)
    // {
    //     return view('back.contact_us.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate(['body' => 'required']);
        $data = $request->except(['_wysihtml5_mode']);
        $data['user_id'] = auth()->user()->id;
        $data['parent_id'] = $id;
        ContactUs::create($data);

        return redirect()->route('admin.contactus.show', $id)->with('success', __('site.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count_messages = ContactUs::where('parent_id', null)->count();
        $message = ContactUs::where(['parent_id' => null, 'id' => $id])->first();
        if (is_null($message)) {
            return redirect()->route('admin.contactus.index');
        }
        $message->read = 1;
        $message->save();

        return view('back.contact_us.show')->with([
            'page_name' => 'contact_us',
            'message' => $message,
            'count_messages' => $count_messages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = ContactUs::findOrFail($id);
        if ($message->parent_id == null) {
            foreach ($message->replies as $replay) {
                $replay->delete();
            }

            $message->delete();

            return redirect()->route('admin.contactus.index')->with('success', __('site.deleted_successfully'));
        }
        //deletes a replay only
        $message->delete();

        return redirect()->route('admin.contactus.show', $message->parent_id)->with('success', __('site.deleted_successfully'));
    }
}
