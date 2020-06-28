<?php

namespace App\Http\Controllers\Back;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Category\StoreRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Category $model)
    {
        $this->middleware('permission:create-category|all')->only('create');
        $this->middleware('permission:update-category|all')->only('edit');
        $this->middleware('permission:delete-category|all')->only('destroy');
        $this->middleware('permission:status-category|all')->only('status');
        parent::__construct($model);
    }

    public function index()
    {
        $categories = Category::all();

        return view('back.category.index')->with([
            'page_name' => parent::getPluralModelName(),
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.category.create')->with([
            'page_name' => parent::getPluralModelName(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Category::create(['name' => $request->name]);

        return redirect()->route('admin.category.index')->with('success', __('site.created_successfully'));
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
        $category = Category::findOrFail($id);

        return view('back.category.edit')->with([
            'page_name' => parent::getPluralModelName(),
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.category.index')->with('success', __('site.edit_successfully'));
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
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', __('site.deleted_successfully'));
    }

    //change the status of the category to publish or not
    public function status($id)
    {
        $category = Category::findOrFail($id);
        $category->status == 1 ? $category->status = 0 : $category->status = 1;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', __('site.change_status_successfully'));
    }
}
