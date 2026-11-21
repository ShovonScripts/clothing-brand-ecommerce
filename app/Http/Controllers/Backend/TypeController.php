<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use DB;
use App\Services\UploadService;

class TypeController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:type.view')->only(['index']);
        $this->middleware('permission:type.create')->only(['create', 'store']);
        $this->middleware('permission:type.edit')->only(['edit', 'update', 'topBrandUpdate']);
        $this->middleware('permission:type.delete')->only(['destroy']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $items = Type::all();
        return view('backend.types.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.types.create');
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadService->upload($request->file('image'), 'types', 'default');
        }

        Type::create($data);

        return response()->json(['status' => true, 'msg' => 'Type Is  Created !!', 'url' => route('admin.types.index')]);
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
     * @return \Illuminate\Http.Response
     */
    public function edit($id)
    {
        $item = Type::find($id);
        return view('backend.types.edit', compact('item'));
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
        $category = Type::find($id);
        $data = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->uploadService->delete($category->image, 'types');
            $data['image'] = $this->uploadService->upload($request->file('image'), 'types', 'default');
        }

        $category->update($data);

        return response()->json(['status' => true, 'msg' => 'Type Is Updated !!', 'url' => route('admin.types.index')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Type::find($id);
        $this->uploadService->delete($category->image, 'types');
        $category->delete();
        return response()->json(['status' => true, 'msg' => 'Type Is Deleted !!']);

    }

    public function topBrandUpdate()
    {

        $status = (request('is_top') == 1) ? 1 : null;
        DB::table('types')->whereIn('id', request('brand_ids'))->update(['is_top' => $status]);
        return response()->json(['status' => true, 'msg' => 'Brand Status Updated !!']);
    }

}