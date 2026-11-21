<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingPage;
use App\Models\LandingPageSlider;
use App\Models\DeliveryCharge;
use App\Models\Product;
use App\Models\Variation;
use DB;
use App\Utils\ModulUtil;
use App\Utils\Util;
use App\Models\Order;
use App\Services\UploadService;
use App\Models\User;

class LandingPageController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:landing.view')->only(['index', 'landing_page']);
        $this->middleware('permission:landing.manage')->only(['create', 'store', 'edit', 'update', 'destroy', 'delete_slider', 'storeData']);
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $items = LandingPage::all();
        return view('backend.landing_pages.index', compact('items'));
    }

    public function create()
    {
        return view('backend.landing_pages.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'title3' => 'required',
            'title4' => 'required',
            'video_url' => '',
            'des1' => 'required',
            'feature' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
            'phone' => 'required',
            'des3' => '',
            'pay_text' => '',
            'product_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadService->upload($request->file('image'), 'landing_pages', 'landing');
        }

        $landPage = LandingPage::create($data);
        if (isset($request->sliderimage)) {

            $imageData = [];
            foreach ($request->sliderimage as $image) {
                $filename = $this->uploadService->upload($image, 'landing_sliders', 'slider');
                $imageData[] = ['image' => $filename];
            }

            if (!empty($imageData)) {
                $landPage->images()->createMany($imageData);
            }
        }

        return response()->json([
            'status' => true,
            'msg'    => 'Landing Page Created Successfully..!!'
        ]);

    }

    public function edit($id)
    {
        $item = LandingPage::find($id);
        return view('backend.landing_pages.edit', compact('item'));
    }

    public function delete_slider($id)
    {
        $item = LandingPageSlider::find($id);
        $this->uploadService->delete($item->image, 'landing_sliders');
        $item->delete();
        return back();
    }

    public function update(Request $request, $id)
    {

        $updatePage = LandingPage::find($id);
        $data = $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'title3' => 'required',
            'title4' => 'required',
            'video_url' => '',
            'des1' => 'required',
            'feature' => 'required',
            'old_price' => '',
            'new_price' => '',
            'phone' => '',
            'des3' => '',
            'pay_text' => '',
            'product_id' => '',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->uploadService->delete($updatePage->image, 'landing_pages');
            $data['image'] = $this->uploadService->upload($request->file('image'), 'landing_pages', 'landing');
        }

        if (isset($request->sliderimage)) {

            $imageData = [];
            foreach ($request->sliderimage as $image) {
                $filename = $this->uploadService->upload($image, 'landing_sliders', 'slider');
                $imageData[] = ['image' => $filename];
            }

            if (!empty($imageData)) {
                $updatePage->images()->createMany($imageData);
            }

        }

        $updatePage->update($data);

        return response()->json([
            'status' => true,
            'msg'    => 'Landing Page Updated Successfully..!!'
        ]);

    }


    public function landing_page($id)
    {
        $ln_pg = LandingPage::with('images')->find($id);
        $charges = DeliveryCharge::whereNotNull('status')->get();
        return view('backend.landing_pages.land_page', compact('ln_pg', 'charges'));
    }

    public function storeData(Request $request)
    {

        $data = $request->validate([
            'mobile' => 'digits_between:11,11',
            'first_name' => 'required',
            'payment_method' => '',
            'shipping_address' => 'required',
            'note' => '',
            'delivery_charge_id' => 'required|numeric',
        ]);

        if (empty(auth()->user()->id)) {
            $user = User::create([
                'first_name' => $request->first_name,
                'mobile' => $request->mobile,
                'shipping_address' => $request->shipping_address,
                'note' => $request->note
            ]);
            $data['user_id'] = $user->id;

        } else {
            $data['user_id'] = auth()->user()->id;
        }

        $product = Product::with('variations')->where('id', $request->prd_id)->first();
        $v_id = Variation::where('product_id', $product->id)->first()->id;

        $pr_data = [
            'product_id' => $product['id'],
            'quantity' => 1,
            'unit_price' => $product['sell_price'],
            'discount' => $product['discount'],
            'is_stock' => $product['is_stock'],
            'variation_id' => $v_id
        ];


        $charge = DeliveryCharge::find($data['delivery_charge_id']);
        $charge = $charge ? $charge->amount : 0;
        $data['date'] = date('Y-m-d');

        // Order Assign Among Users Start

        $usrs = DB::table('model_has_roles')->where('role_id', 8)->get();
        $verified_users = [];

        foreach ($usrs as $user) {
            $test = DB::table('users')->where('id', $user->model_id)->first();

            if ($test->status == 1) {
                $verified_users[] = $user->model_id;
            }
        }

        $keyValue = array_rand($verified_users);
        $data['assign_user_id'] = $verified_users[$keyValue];

        // Order Assign Among Users End


        $data['invoice_no'] = generateInvoiceNo();
        $data['discount'] = $product['discount'];
        $data['amount'] = $product['sell_price'];
        $data['shipping_charge'] = $charge;
        $data['final_amount'] = $product['sell_price'];

        DB::beginTransaction();
        try {

            unset($data['payment_method']);
            $order = Order::create($data);

            if (!empty($pr_data)) {

                $order->details()->create($pr_data);

            }

            $this->modulutil->orderPayment($order, $request->all());
            $this->modulutil->orderstatus($order);

            if ($request->payment_method == 'nogod' || $request->payment_method == 'bkash' || $request->payment_method == 'rocket')
            {
                $order->payments()->create([
                    'amount' => $order->final_amount,
                    'account_no' => $request->pay_num,
                    'tnx_id' => $request->tnx_id,
                    'method' => $request->payment_method,
                    'date' => date('Y-m-d'),
                    'note' => '',
                ]);

                $order->payment_status = $request->payment_method . '_pending';
                $order->save();

                /* send sms */

                DB::commit();

                session()->put('cart', []);
                session()->put('coupon_discount', null);
                session()->put('discount_type', null);

                $url = route('front.confirmOrder', [$order->id]);
                return response()->json(['success' => true, 'msg' => 'Order Create successfully!', 'url' => $url]);
            }  else if ($request->payment_method == 'stripe')

            {
                if (empty(config('services.stripe.secret'))) { DB::rollback(); return response()->json(['success' => false, 'msg' => 'Stripe is not configured.']); }
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                $charge = \Stripe\Charge::create([
                    'source' => $request->stripeToken,
                    'description' => 'Order #' . $order->invoice_no,
                    'amount' => (int) round($order->final_amount * 100),
                    'currency' => 'usd'
                ]);

                if ($charge->status == 'succeeded') {
                    OrderPayment::create([
                        'order_id' => $order->id,
                        'amount' => $order->final_amount,
                        'account_no' => $request->input('mobile'),
                        'tnx_id' => '123',
                        'method' => 'Stripe',
                        'date' => date('Y-m-d'),
                        'note' => ''
                    ]);

                    $order->payment_status = 'Stripe Completed';
                    $order->save();

                    DB::commit();
                    session()->put('cart', []);
                    session()->put('coupon_discount', null);
                    session()->put('discount_type', null);

                    return redirect()->route('front.confirmOrder', [$order->id]);
            }
        }
            else
            {
                $url = route('front.confirmOrder', [$order->id]);
                session()->put('cart', []);
                session()->put('coupon_discount', null);
                session()->put('discount_type', null);
                $msg = 'প ('.$order->first_name.'),Demo1 ডা ('.$order->invoice_no.') সলভ  য়ছ
            পন  কে আ ীঘ নে ক  রব ।  ্ত া 09696801173 মব  ল  ধব';
                $number = $order->mobile;
            //  $success=SendSms($number ,$msg);
            $success = 'test';
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Order Create successfully!', 'url' => $url]);
            }


        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['success' => false, 'msg' => 'Something went wrong while placing your order. Please try again.']);
        }
    }

    public function destroy(Request $request, $id)
    {
        $single_page = LandingPage::with('images')->find($id);

        if ($single_page) {
            $this->uploadService->delete($single_page->image, 'landing_pages');
        }

        if ($single_page->images()->count() >= 1) {
            foreach ($single_page->images as $key => $slider_image) {
                $this->uploadService->delete($slider_image, 'landing_sliders');
            }
        }

        $single_page->delete();

        return response()->json([
            'status' => true,
            'msg'     => 'Landing Page Deleted Successfully..!!!'
        ]);

    }

}