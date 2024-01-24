@extends('frontend.layouts.app')
@section('title')
    {{ $tags->tag_name }}
@endsection
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h1 class="breadcrumb-title">{{ $tags->tag_name }}</h1>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item" aria-current="page"> {{ $tags->tag_name }}</li>
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
                <div class="col-12">
                    <div class="row">
                        @if ($posts->isEmpty())
                            <p>Không có bài viết nào.</p>
                        @else
                            @foreach ($posts as $post)
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
                                                    {{-- <li><span class="cat-blog">{{ $category->cate_title }}</span></li> --}}
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
                                {{ $posts->onEachSide(2)->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
