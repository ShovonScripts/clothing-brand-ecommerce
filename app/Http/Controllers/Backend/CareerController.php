<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Services\UploadService;

class CareerController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:career.view')->only(['index']);
        $this->middleware('permission:career.create')->only(['create', 'store']);
        $this->middleware('permission:career.edit')->only(['edit', 'update']);
        $this->middleware('permission:career.delete')->only(['destroy']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $items = Career::all();
        return view('backend.career.index', compact('items'));
    }


    public function create()
    {
        return view('backend.career.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadService->upload($request->file('image'), 'career', 'default');
        }

        Career::create($data);

        return response()->json(['status' => true, 'msg' => 'Career  Is Created !!']);
    }


    public function edit($id)
    {
        $item = Career::find($id);
        return view('backend.career.edit', compact('item'));

    }


    public function update(Request $request, $id)
    {

        $item = Career::find($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->uploadService->delete($item->image, 'career');
            $data['image'] = $this->uploadService->upload($request->file('image'), 'career', 'default');
        }

        $item->update($data);

        return response()->json(['status' => true, 'msg' => 'Career  Is Updated !!']);
    }

    public function destroy($id)
    {
        $product = Career::find($id);
        $this->uploadService->delete($product->image, 'career');
        $product->delete();
        return response()->json(['status' => true, 'msg' => 'Career Is Deleted !!']);

    }

}