@extends('frontend.layouts.app')
@section('title')
    {{ $category->cate_title }}
@endsection
@section('meta-desc')
    {{ $category->cate_seodesc }}
@endsection
@section('meta-title')
    {{ $category->cate_title }}
@endsection
@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">{{ $category->cate_title }}</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ $category->cate_title }}</li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Grid</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 view-list">
                    <div class="row">
                        @if ($products->isEmpty())
                            <p>Không có bài viết nào.</p>
                        @else
                            @foreach ($prodList as $product)
                                <!-- Service List -->
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="service-widget">
                                        <a href="{{ url('san-pham/' . $product->prod_slug) }}">
                                            <div class="service-img service-show-img">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="{{ $product->prod_library ? url($product->prod_library) : url('assets/img/default.jpg') }}">
                                            </div>
                                        </a>
                                        <div class="service-content service-content-three">
                                            <h3 class="title">
                                                <a
                                                    href="{{ url('san-pham/' . $product->prod_slug) }}">{{ $product->prod_name }}</a>
                                            </h3>
                                            <div class="main-saloons-profile">
                                                <div class="saloon-profile-left">
                                                    <div class="saloon-content">
                                                        <div class="saloon-content-top">

                                                        </div>
                                                        <div class="saloon-content-btn">
                                                            <span>{{ Str::limit($product->prod_desc, 95) }}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="saloon-bottom1 mb-2">
                                                <a href="{{ url('san-pham/' . $product->prod_slug) }}"><i
                                                        class="fa-solid fa-angles-right"></i> Tìm hiểu
                                                    thêm</a>
                                            </div>
                                            <div class="saloon-bottom">
                                                <a href="{{ $product->download }}"><i
                                                        class="fa-solid fa-download mr-2"></i> Tải phần
                                                    mềm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Service List -->
                            @endforeach
                        @endif

                    </div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blog-pagination rev-page">
                                {{ $prodList->onEachSide(2)->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                    <!-- /Pagination -->
                </div>
            </div>
        </div>
    </div>
@endsection
