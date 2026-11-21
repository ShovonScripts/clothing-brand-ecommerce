<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Services\UploadService;

class AboutUsController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:about_us.view')->only(['index']);
        $this->middleware('permission:about_us.edit')->only(['store']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $item = AboutUs::first() ?? new AboutUs();
        return view('backend.about_us.about_us', compact('item'));
    }


    public function store(Request $request)
    {
        $item = AboutUs::first() ?? new AboutUs();

        $data = $request->validate([
            'site_name' => 'required',
            'site_url' => 'required',
            'page_title' => 'required',
            'sub_title' => 'required',
            'speech' => 'required',
            'page_desc' => '',
            'title_one' => '',
            'desc_one' => '',
            'title_two' => '',
            'desc_two' => '',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $url = $request->video;

        if (!empty($url) && ($item->video != $url)) {
            $data['video'] = $this->getUrl($url);
        }

        if ($request->hasFile('cover_image')) {
            $this->uploadService->delete($item->cover_image, 'aboutus');
            $data['cover_image'] = $this->uploadService->upload($request->file('cover_image'), 'aboutus', 'about');
        }

        if ($request->hasFile('signature')) {
            $this->uploadService->delete($item->signature, 'aboutus');
            $data['signature'] = $this->uploadService->upload($request->file('signature'), 'aboutus', 'about');
        }


        if ($item->exists) {
            $item->update($data);
        } else {
            AboutUs::create($data);
        }

        return response()->json(['status' => true, 'msg' => 'About Us Info  Is Created !!']);
    }

    private function getUrl($url)
    {

        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        return $my_array_of_vars['v'];

    }

}