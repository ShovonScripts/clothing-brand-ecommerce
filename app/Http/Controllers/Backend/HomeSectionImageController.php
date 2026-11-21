<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSectionImage;
use App\Services\UploadService;

class HomeSectionImageController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:image.view')->only(['index']);
        $this->middleware('permission:image.create')->only(['store']);
        $this->middleware('permission:image.edit')->only(['edit', 'update']);
        $this->middleware('permission:image.delete')->only(['destroy']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {

        $items = HomeSectionImage::paginate(20);
        return view('backend.home_section_images.index', compact('items'));
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
            'section' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'link' => '',
            'is_for_small' => '',
            'mobile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('mobile_image')) {
            $data['mobile_image'] = $this->uploadService->upload($request->file('mobile_image'), 'homeimages', 'banner');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadService->upload($request->file('image'), 'homeimages', 'banner');
        }

        HomeSectionImage::create($data);

        return response()->json(['status' => true, 'msg' => 'HomeSectionImage Is  Created !!', 'url' => route('admin.home_section_images.index')]);
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
        $item = HomeSectionImage::find($id);
        return view('backend.home_section_images.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http.Response
     */
    public function update(Request $request, $id)
    {
        $homeimage = HomeSectionImage::find($id);
        $data = $request->validate([
            'title' => '',
            'text' => '',
            'link' => '',
            'section' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->uploadService->delete($homeimage->image, 'homeimages');
            $data['image'] = $this->uploadService->upload($request->file('image'), 'homeimages', 'banner');
        }


        if ($request->hasFile('mobile_image')) {
            $this->uploadService->delete($homeimage->mobile_image, 'homeimages');
            $data['mobile_image'] = $this->uploadService->upload($request->file('mobile_image'), 'homeimages', 'banner');
        }

        $homeimage->update($data);

        return response()->json(['status' => true, 'msg' => 'HomeSectionImage Is Updated !!', 'url' => route('admin.home_section_images.index')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = HomeSectionImage::find($id);
        $this->uploadService->delete($item->image, 'homeimages');
        $this->uploadService->delete($item->mobile_image, 'homeimages');
        $item->delete();
        return response()->json(['status' => true, 'msg' => 'HomeSectionImage Is Deleted !!']);

    }

}