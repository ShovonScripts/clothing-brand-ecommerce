@forelse($items as $product)
<div class="col-lg-3 col-md-4 col-sm-6 col-6 mb--30">
    @include('frontend.products.partials.product_section')
</div>
@empty
<div class="col-12">
    <div class="alert alert-warning" style="border-radius:0">No products match these filters. Try removing a filter or browse the full collection.</div>
</div>
@endforelse

<div class="col-12">
    <div class="text-center pt--20">
        <div class="pagination-wrap">{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</div>
    </div>
</div>
