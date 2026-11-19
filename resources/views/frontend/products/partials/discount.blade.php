<div class="row row--15">
    @forelse($items as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb--30">
        @include('frontend.products.partials.product_section')
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-warning" style="border-radius:0">There are no sale pieces right now. Check back soon.</div>
    </div>
    @endforelse
</div>
<div class="text-center pt--20">
    <div class="pagination-wrap">{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</div>
</div>
