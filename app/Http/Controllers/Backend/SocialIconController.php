<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialIcon;
use App\Services\UploadService;

class SocialIconController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:social_icons.view')->only(['index']);
        $this->middleware('permission:social_icons.create')->only(['create', 'store']);
        $this->middleware('permission:social_icons.edit')->only(['edit', 'update']);
        $this->middleware('permission:social_icons.delete')->only(['destroy']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $items = SocialIcon::all();
        return view('backend.social_icons.index', compact('items'));
    }


    public function create()
    {
        return view('backend.social_icons.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $data['image'] = $this->uploadService->upload($request->file('icon'), 'social_icons', 'default');
        }

        SocialIcon::create($data);

        return response()->json(['status' => true, 'msg' => 'SocialIcon  Is Created !!']);
    }


    public function edit($id)
    {
        $item = SocialIcon::find($id);
        return view('backend.social_icons.edit', compact('item'));

    }


    public function update(Request $request, $id)
    {

        $item = SocialIcon::find($id);

        $data = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $this->uploadService->delete($item->image, 'social_icons');
            $data['image'] = $this->uploadService->upload($request->file('icon'), 'social_icons', 'default');
        }

        $item->update($data);

        return response()->json(['status' => true, 'msg' => 'SocialIcon  Is Updated !!']);
    }

    public function destroy($id)
    {
        $product = SocialIcon::find($id);
        $this->uploadService->delete($product->image, 'social_icons');
        $product->delete();
        return response()->json(['status' => true, 'msg' => 'SocialIcon Is Deleted !!']);

    }

}