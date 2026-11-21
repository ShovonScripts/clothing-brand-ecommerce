<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Type;
use App\Models\Color;
use App\Models\Weight;
use App\Models\Variation;
use DB;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\UploadService;
use Illuminate\Validation\ValidationException;


class ProductController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->middleware('permission:product.view')->only(['index']);
        $this->middleware('permission:product.create')->only(['create', 'store']);
        $this->middleware('permission:product.edit')->only(['edit', 'update', 'productCopy']);
        $this->middleware('permission:product.delete')->only(['destroy', 'deleteImage']);
        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function productExport(){
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function index()
    {

        if(!auth()->user()->can('product.view'))
        {
            abort(403, 'unauthorized');
        }

        $q=request()->q;
        $query=Product::query();
                if(!empty($q)){
                    $query->where(function($row) use ($q){
                        $row->where('name','Like','%'.$q.'%');
                        $row->orwhere('description','Like','%'.$q.'%');
                        $row->orwhere('sku','Like','%'.$q.'%');
                    });
                }

        if(auth()->user()->hasRole('admin')==false){
              $query->where('user_id', auth()->user()->id);
            }

        $items=$query->latest()->paginate(30);
        // dd($items);

        return view('backend.products.index', compact('items','q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubcategory(){

        $cats=Category::where('parent_id', request('cat_id'))->select('name','id')->pluck('name','id')->toArray();

        return response()->json($cats);
    }
    public function create()
    {
        $cats=Category::whereNull('parent_id')->get();
        $sizes=Size::all();
        $types=Type::all();
        $colors=Color::all();
        $weights=Weight::all();
        return view('backend.products.create', compact('cats','sizes','types','colors','weights'));
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
            'type' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'category_id' => 'required',
            'sub_category_id' => '',
            'type_id' => '',
            'description' => '',
            'body' => '',
            'feature' => '',
            'sku' => '',
            'purchase_price' => '',
            'sell_price' => 'required|numeric',
            'regular_price' => '',
            'is_stock' => '',
            'video_link' => ''
        ]);

        $data['user_id'] = auth()->user()->id;

        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadService->upload($request->file('image'), 'products', 'product');
            }

            $product = Product::create($data);

            if (isset($request->images)) {
                $imageData = [];
                foreach ($request->images as $image) {
                    $filename = $this->uploadService->upload($image, 'products', 'product');
                    $imageData[] = ['image' => $filename];
                }

                if (!empty($imageData)) {
                    $product->images()->createMany($imageData);
                }
            }

            if ($request->type == 'variable') {

                $variableData = [];

                $variableData[] = [
                    'size_id'=>"3",
                    'color_id'=>"1",
                    'weight_id'=>"1",
                    'price'=>$request->sell_price,
                ];

                foreach ($request->size_id as $key => $size) {
                   $variableData[]=[
                        'size_id'=>$size,
                        'color_id'=>$request->color_id[$key],
                        'weight_id'=>$request->weight_id[$key],
                        'price'=>$request->price[$key],
                   ];
                }

                if (!empty($variableData)) {
                    $product->variations()->createMany($variableData);
                }

            } else {
                $variableData = [];

                $variableData[] = [
                    'size_id'=>"3",
                    'color_id'=>"1",
                    'weight_id'=>"1",
                    'price'=>$request->sell_price,
                ];
                if (!empty($variableData)) {
                    $product->variations()->createMany($variableData);
                }
            }

            DB::commit();
            return response()->json(['status'=>true ,'msg'=>'Product Is  Created !!','url'=>route('admin.products.index')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>false ,'msg'=>$e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('sizes','sizes.stocks')->find($id);
        return view('backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item=Product::with('sizes')->find($id);
        $cats=Category::whereNull('parent_id')->get();
        $sizes=Size::all();
        $types=Type::all();
        $colors=Color::all();
        $weights=Weight::all();

        $subs=Category::where('parent_id', $item->category_id)->get();

        return view('backend.products.edit', compact('item','cats','sizes','types','subs','colors','weights'));
    }

    public function productCopy($id){
        $item=Product::with('sizes')->find($id);
        $cats=Category::whereNull('parent_id')->get();
        $sizes=Size::all();
        $types=Type::all();
        $colors=Color::all();

        $subs=Category::where('parent_id', $item->category_id)->get();
        return view('backend.products.copy', compact('item','cats','sizes','types','subs','colors'));
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

        $product=Product::find($id);
        $data=$request->validate([
             'name'=> 'required',
             'category_id'=> 'required',
             'sub_category_id'=> '',
             'type_id'=> '',
             'description'=> '',
             'body'=> '',
             'feature'=> '',
             'sku'=> '',
             'purchase_price'=> '',
             'regular_price'=> '',
             'sell_price'=> 'required|numeric',
             'is_stock' => ''
        ]);


    DB::beginTransaction();

        try {

        if($request->hasFile('image')) {
            $this->uploadService->delete($product->image, 'products');
            $data['image'] = $this->uploadService->upload($request->file('image'), 'products', 'product');
        }

        if(isset($request->images)) {
            $imageData = [];
            foreach ($request->images as $image) {
                $filename = $this->uploadService->upload($image, 'products', 'product');
                $imageData[] = ['image' => $filename];
            }

            if (!empty($imageData)) {
                $product->images()->createMany($imageData);
            }

        }

        $product->update($data);

        $deleteVariations=Variation::where('product_id',$id)->whereNotIn('id',$request->variation_id)->get();

        if ($deleteVariations->count()) {
            foreach ($deleteVariations as $key => $dvariation) {
                $dvariation->delete();
            }
        }


        if (isset($request->size_id)) {

            $variableData = [];
            foreach ($request->size_id as $key => $size) {

                if (isset($request->variation_id[$key])) {
                    $variable=Variation::find($request->variation_id[$key]);
                    $variable->size_id=$size;
                    $variable->color_id=$request->color_id[$key];
                    $variable->weight_id=$request->weight_id[$key];
                    $variable->price=$request->price[$key];
                    $variable->save();
                }else{
                    $variableData[]=[
                        'size_id'=>$size,
                        'color_id'=>$request->color_id[$key],
                        'weight_id'=>$request->weight_id[$key],
                        'price'=>$request->price[$key],
                    ];
                }
            }

            if (!empty($variableData)) {
                $product->variations()->createMany($variableData);
            }

        }

        DB::commit();
        return response()->json(['status'=>true ,'msg'=>'Product Is Updated !!','url'=>route('admin.products.index')]);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status'=>false ,'msg'=>$e->getMessage()]);
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

        $product=Product::find($id);
        $this->uploadService->delete($product->image, 'products');
        $this->uploadService->delete($product->optional_image, 'products');

        if ($product->images()->count()) {

            foreach ($product->images as $key => $image) {
                $this->uploadService->delete($image->image, 'products');
            }
            $product->images()->delete();
        }

        foreach ($product->variations as $key => $dvariation) {
            $dvariation->delete();
        }
        $product->delete();
        DB::commit();
        return response()->json(['status'=>true ,'msg'=>'Product Is Deleted !!']);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status'=>false ,'msg'=>$e->getMessage()]);
    }

    }

    public function deleteImage($id){

        $item=ProductImage::find($id);
        $this->uploadService->delete($item->image, 'products');
        $item->delete();
        return back();
    }

    public function fileUpload(Request $request){

        if($request->hasFile('upload')) {
            $filename = $this->uploadService->upload($request->file('upload'), 'ck-images', 'default');

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('ck-images/'.$filename);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }

    }

    public function recommendedUpdate (){

        $status=(request('is_recommended')==1)?1:null;
        DB::table('products')->whereIn('id', request('product_ids'))->update(['is_recommended'=>$status]);
        return response()->json(['status'=>true ,'msg'=>'Product Status Updated !!']);
    }

}