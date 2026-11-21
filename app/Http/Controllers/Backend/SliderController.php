<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Services\UploadService;

class SliderController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:slider.view')->only(['index']);
        $this->middleware('permission:slider.create')->only(['create', 'store']);
        $this->middleware('permission:slider.edit')->only(['edit', 'update']);
        $this->middleware('permission:slider.delete')->only(['destroy']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $items = Slider::get();
        return view('backend.sliders.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sliders.create');
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
            'title' => 'required',
            'description' => '',
            'link' => '',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('mobile_image')) {
            $data['mobile_image'] = $this->uploadService->upload($request->file('mobile_image'), 'sliders', 'slider');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadService->upload($request->file('image'), 'sliders', 'slider');
        }

        Slider::create($data);

        return response()->json(['status' => true, 'msg' => 'Slider Is  Created !!', 'url' => route('admin.sliders.index')]);
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
        $item = Slider::find($id);

        return view('backend.sliders.edit', compact('item'));
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
        $slider = Slider::find($id);
        $data = $request->validate([
            'title' => 'required',
            'description' => '',
            'link' => '',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->uploadService->delete($slider->image, 'sliders');
            $data['image'] = $this->uploadService->upload($request->file('image'), 'sliders', 'slider');
        }

        if ($request->hasFile('mobile_image')) {
            $this->uploadService->delete($slider->mobile_image, 'sliders');
            $data['mobile_image'] = $this->uploadService->upload($request->file('mobile_image'), 'sliders', 'slider');
        }

        $slider->update($data);

        return response()->json(['status' => true, 'msg' => 'Slider Is Updated !!', 'url' => route('admin.sliders.index')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $this->uploadService->delete($slider->image, 'sliders');
        $this->uploadService->delete($slider->mobile_image, 'sliders');
        $slider->delete();
        return response()->json(['status' => true, 'msg' => 'Slider Is Deleted !!']);

    }

}