<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;
use DB;
use App\Services\UploadService;

class CategoryController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:category.view')->only(['index']);
        $this->middleware('permission:category.create')->only(['store']);
        $this->middleware('permission:category.edit')->only(['edit', 'update', 'popularCatgeory']);
        $this->middleware('permission:category.delete')->only(['destroy']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $types = Type::all();
        $items = Category::latest()->paginate(20);
        $cats = Category::whereNull('parent_id')->select('name', 'id')->pluck('name', 'id')->toArray();
        return view('backend.categories.index', compact('items', 'types', 'cats'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'required|unique:categories,url',
            'parent_id' => '',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadService->upload($request->file('image'), 'categories', 'category');
        }

        Category::create($data);

        return response()->json(['status' => true, 'msg' => 'Category Is  Created !!', 'url' => route('admin.categories.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Category::find($id);
        $types = Type::all();
        $cats = Category::whereNull('parent_id')->select('name', 'id')->pluck('name', 'id')->toArray();
        return view('backend.categories.edit', compact('item', 'types', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $data = $request->validate([
            'name' => 'required',
            'url' => 'required|unique:categories,url,' . $id,
            'parent_id' => '',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->uploadService->delete($category->image, 'categories');
            $data['image'] = $this->uploadService->upload($request->file('image'), 'categories', 'category');
        }

        $category->update($data);

        return response()->json(['status' => true, 'msg' => 'Category Is Updated !!', 'url' => route('admin.categories.index')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $this->uploadService->delete($category->image, 'categories');
        $category->delete();
        return response()->json(['status' => true, 'msg' => 'Category Is Deleted !!']);

    }

    public function popularCatgeory()
    {

        $status = (request('is_popular') == 1) ? 1 : null;
        DB::table('categories')->whereIn('id', request('cat_ids'))->update(['is_popular' => $status]);
        return response()->json(['status' => true, 'msg' => 'Category Status Updated !!']);
    }

}