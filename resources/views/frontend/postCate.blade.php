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
    {{-- <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h1 class="breadcrumb-title">{{ $category->cate_title }}</h1>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ $category->cate_title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- /Breadcrumb -->
    {{-- <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        @if ($news->isEmpty())
                            <p>Không có bài viết nào.</p>
                        @else
                            @foreach ($news as $post)
                                <div class="col-md-4 d-flex">

                                    <!-- Blog Post -->
                                    <div class="blog grid-blog flex-fill">
                                        <div class="blog-image">
                                            <a href="{{ url($post->post_slug) }}"><img class="img-fluid"
                                                    src="{{ $post->post_thumb ? url($post->post_thumb) : url('assets/img/default.jpg') }}"
                                                    alt="Post Image"></a>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-category">
                                                <ul>
                                                    <li><span class="cat-blog">{{ $category->cate_title }}</span></li>
                                                    <li><i
                                                            class="feather-calendar me-2"></i>{{ Carbon::parse($post->created_at)->locale('vi')->diffForHumans() }}
                                                    </li>

                                                </ul>
                                            </div>
                                            <h3 class="blog-title">
                                                <a href="{{ url($post->post_slug) }}">{{ $post->post_title }}</a>
                                            </h3>
                                            <p>{!! Str::limit($post->post_desc, 110) !!}</p>
                                            <a href="{{ url($post->post_slug) }}" class="read-more">Đọc thêm <i
                                                    class="feather-arrow-right-circle"></i></a>
                                        </div>
                                    </div>
                                    <!-- /Blog Post -->

                                </div>
                            @endforeach
                        @endif
                        <div class="col-md-12">
                            <div class="blog-pagination">
                                {{ $news->onEachSide(2)->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div> --}}
    <section class="page-margin">
        <!-- breadcrumb start-->
        <div class="breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 d-align-center">
                        <h2 class="title"><span>{{ $category->cate_title }}</span></h2>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <nav class="theme-breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active"><a href="#">{{ $category->cate_title }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb end-->
        <!-- blog Section start-->
        <section class="blog-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-12">
                        @if ($news->isEmpty())
                            <p>No articles found.</p>
                        @else
                            @foreach ($news as $post)
                                <div class="card-marketing">
                                    <div class="img-card">
                                        <a href="{{ url($post->post_slug) }}"><img
                                                src="{{ $post->post_thumb ? url($post->post_thumb) : url('assets/img/default.jpg') }}"
                                                alt="{{ $post->post_title }}" width=273px height=182px;></a>
                                    </div>
                                    <div class="card-content">
                                        <div class="content-top">
                                            <p><a href="{{ url($post->post_slug) }}">{{ $post->post_title }}</a></p>
                                            <div class="desc">
                                                {{ $post->post_desc }}
                                            </div>
                                        </div>
                                        <div class="more">
                                            <div class="time">
                                                <div class="icon">
                                                    <img src="{{ url('img/Time-Circle.png') }}" alt="alt">
                                                </div>
                                                <div class="title">
                                                    {{ Carbon::parse($post->created_at)->locale('vi')->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="col-md-12 d-flex justify-content-center">
                            {{ $news->onEachSide(2)->withQueryString()->links() }}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 list-sidebar">
                        @include('frontend.layouts.sidebar-news')
                    </div>
                </div>
            </div>
            <div class="animation-circle absolute"><i></i><i></i><i></i></div>
            <div class="animation-circle-inverse"><i></i><i></i><i></i></div>
        </section>
    </section>
@endsection
