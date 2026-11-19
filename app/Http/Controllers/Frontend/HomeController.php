<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSectionImage;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Page;

class HomeController extends Controller
{
  	public function sendSMs(){
     
    }
    public function home(){
        $sliders=Slider::orderBy('id')->get();
        $brands=Type::whereNotNull('is_top')->take(12)->get();
        $cats=Category::whereNull('parent_id')->where('is_popular', 1)->with('subcats')->withCount('products')->get();
        $images=HomeSectionImage::all();

        $newArrivals = Product::with(['variation', 'category'])
            ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
            ->latest()
            ->take(8)
            ->get();

        $saleProducts = Product::with(['variation', 'category'])
            ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
            ->whereNotNull('products.discount_type')
            ->take(4)
            ->get();

        $recommended = Product::with(['variation', 'category'])
            ->select('products.id','products.name','products.type','products.sell_price','products.regular_price','products.image','products.is_stock','products.is_free_shipping','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount','products.created_at')
            ->where('products.is_recommended', 1)
            ->take(4)
            ->get();

        return view('frontend.home', compact('sliders','cats','brands','images','newArrivals','saleProducts','recommended'));
    }
    
    public function aboutUs(){
        $page=Page::where('page','about')->first();
        return view('frontend.about_us', compact('page'));
    }

    public function contactUs(){

        return view('frontend.contact_us');

    }
    
    public function privacyPolicy(){

        return view('frontend.privacy_policy');

    }
    
    public function termCondition(){
		$page=Page::where('page','term')->first();
        return view('frontend.term_and_condition', compact('page'));

    }
    
    
    public function faq(){
        return view('frontend.faq');
    }

    public function returnPolicy(){
        return view('frontend.return_policy');
    }

    public function contact(Request $request){

        $data=$request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
            'email' => '',
            'message' => 'required',
        ]);

        Contact::create($data);

        return response()->json(['success'=>true,'msg'=>'Successfully Created Your Info!']);


    }

    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Store in database or mailing service
        // For now, just return success
        return response()->json([
            'success' => true,
            'msg' => 'Thanks for subscribing! You\'ll hear from us soon.'
        ]);
    }

}
