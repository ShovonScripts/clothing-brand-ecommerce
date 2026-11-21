<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\{Information, User};
use Illuminate\Http\Request;
use App\Services\UploadService;
use Auth, Validator;
class InformationController extends Controller{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:settings.view')->only(['index', 'showProfile']);
        $this->middleware('permission:settings.edit')->only(['update', 'statusCoupon']);
        $this->middleware('permission:settings.scripts')->only(['update']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $information = Information::first();
        
        return view('backend.informations.index', compact('information'));
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'site_name'    => ['required'],    
            'site_logo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:512'],    
            'owner_phone'   => ['required'],    
            'owner_email'   => ['required'],    
            'address'       => ['required'],
            'copyright'     => ['required'],
            'facebook'      => '',
            'instagram'     => '',
            'youtube'       => '',
            'tracking_code' => '',  
            'pixel' => '',  
            'search_console' => '',  
            'recommend_num' => '', 
            'discount_num'  => '', 
            'newarrival_num' => '',   
            'bkash' => '',
            'bkash_number' => '',
            'nogod' => '',
            'nogod_number' => '',
            'rocket' => '',
            'rocket_number' => '',
            'paypal' => '',
            'paypal_account' => '',
            'stripe' => '', 
            'stripe_account' => '',
            'supp_num1' => '',
            'supp_num2' => '',
            'supp_num3' => '',
            'number_visibility' => '',
            'currency' => '',
        ]);
        
        $information = Information::findOrFail($id);
        
        if($request->hasFile('site_logo'))
        {
            $this->uploadService->delete($information->site_logo, 'img');
            $data['site_logo'] = $this->uploadService->upload($request->file('site_logo'), 'img', 'logo');
        }

        if($request->hasFile('favicon'))
        {
            $this->uploadService->delete($information->favicon, 'img');
            $data['favicon'] = $this->uploadService->upload($request->file('favicon'), 'img', 'favicon');
        }
		
		 if($request->hasFile('og_images'))
        {
            $this->uploadService->delete($information->og_images, 'img');
            $data['og_images'] = $this->uploadService->upload($request->file('og_images'), 'img', 'og_image');
        }


        $information->update($data);
        return back()->with(['msg'=> 'Site settings has been updated']);
        
    }
  
    public function statusCoupon(Request $request)
    {
    	$information = Information::first();
        $information->coupon_visibility = $request->coupon_visibility;
        $information->save();       
        
        return back()->with(['msg'=> 'Site settings has been updated']);
    }
    
    public function showProfile()
    {
        $data = Auth::user();
        
         return view('backend.informations.profile', compact('data'));
    }    
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'username' => ['required', 'unique:users,username,'.$user->id],
                'mobile' => ['required', 'unique:users,mobile,'.$user->id],
                'business_name' => ['required'],
                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            ]);
            
        $data = $request->only(['first_name', 'last_name', 'username', 'mobile', 'business_name']);
        
        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }
            
         if($request->hasFile('image'))
         {
             $this->uploadService->delete($user->image, 'img');
             $data['image'] = $this->uploadService->upload($request->file('image'), 'img', 'default');
         }
         
         $user->update($data);
         
         return response()->json(['success' => 'Profile has been updated']);
             
    }
    
}