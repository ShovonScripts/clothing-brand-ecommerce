@extends('frontend.app')

@section('title', 'Sale — GENTRY')

@section('content')
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">Sale</li>
            </ul>
        </div>
    </div>

    <div class="axil-shop-area">
        <div class="container-fluid">
            <div class="gm-section-head" style="margin-bottom:28px">
                <div>
                    <span class="gm-eyebrow">Limited time</span>
                    <h1 class="gm-title">Season sale</h1>
                    <p class="gm-subtitle">Considered pieces at considered prices. Up to 40% off selected styles.</p>
                </div>
                <a href="{{ route('front.products.index') }}" class="gm-link">Shop full price <i class="fas fa-arrow-right"></i></a>
            </div>

            <div id="product_data"></div>
        </div>
    </div>
</main>
@endsection

@push('js')
<script type="text/javascript">
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetchData(page);
    });

    $(document).ready(function () {
        fetchData();
    });

    function fetchData(page) {
        $.ajax({
            type: 'GET',
            url: '{{ route("front.discountProduct") }}?page=' + (page || 1),
            data: {},
            success: function (res) {
                if (res.success == true) {
                    $('div#product_data').html(res.html);
                }
            }
        });
    }
</script>
@endpush
