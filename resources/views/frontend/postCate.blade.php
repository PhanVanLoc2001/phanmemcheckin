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
