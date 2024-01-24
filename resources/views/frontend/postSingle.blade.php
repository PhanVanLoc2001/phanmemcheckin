@extends('frontend.layouts.app')
@section('title')
    {{ $post->post_title }}
@endsection
@section('meta-desc')
    {{ $post->post_seodesc }}
@endsection
@section('meta-title')
    {{ $post->post_title }}
@endsection
@section('schema')
    <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{url($post->post_slug)}}"
  },
  "headline": "{{$post->post_title}}",
  "description": "{{$post->post_seodesc}}",
  "datePublished": "{{$post->created_at}}",
  "dateModified": "{{$post->updated_at}}",
  "author": {
    "@type": "Person",
    "name": "{{$post->user->name}}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Công Ty Cổ Phần Đầu Tư & Công Nghệ Ninja",
    "logo": {
      "@type": "ImageObject",
      "url": "",
      "width": 96,
      "height": 66
    }
  },
  "image": {
    "@type": "ImageObject",
    "url": "{{$post->post_thumb ? url($post->post_thumb) : url('assets/img/default.jpg')}}",
    "width": 800,
    "height": 400
  }
}
</script>
@endsection
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-12 blog-details">

                    <div class="blog-head">
                        <div class="blog-category">
                            @if ($category)
                                <ul>
                                    <li><span class="cat-blog">{{ $category->cate_title }}</span></li>
                                </ul>
                            @endif
                        </div>
                        <h3>{{ $post->post_title }}</h3>
                        <div class="blog-category sin-post">
                            <ul>
                                <li><i class="feather-calendar me-1"></i>
                                    {{ Carbon::parse($post->created_at)->locale('vi')->diffForHumans() }}</li>
                                <li>
                                    <div class="post-author">
                                        <a href="#"><img src="{{ url('assets/img/user.png') }}"
                                                alt="Post Author"><span>
                                                @if (isset($post->user->name) && !empty($post->user->name))
                                                    {{ $post->user->name }}
                                                @endif
                                            </span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Blog Post -->
                    <div class="blog blog-list">
                        <div class="blog-content">
                            {!! $post->post_content !!}
                        </div>
                    </div>
                    <!-- /Blog Post -->

                    <div class="social-widget blog-review">
                        <h4>Tags</h4>
                        <div class="ad-widget">
                            <ul>
                                @if ($tags)
                                    @foreach ($tags as $tag)
                                        <li><a href="{{ url('tag/' . $tag->tag_slug) }}">{{ $tag->tag_name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="card-container in" style=" padding: 12px 12px 1px; background: #dee2e6;">
                        @foreach ($postList as $postItem)
                            {{-- @dd($postItem) --}}
                            <div class="card in"
                                style="display: flex;flex-direction: row;border-top: 1px solid #ccc;padding: 10px; margin-bottom: 12px;">
                                <div class="image"
                                    style="flex-shrink: 0;margin-right: 10px;max-width: 200px;max-height: 200px; ">
                                    <a href="{{ $postItem->post_slug }}" target="_blank"><img
                                            src="{{ $postItem->post_thumb ? url($postItem->post_thumb) : url('/assets/img/default.jpg') }}"
                                            alt="{{ $postItem->post_title }}"
                                            style="width: 100%;height: 100%;object-fit: cover;"></a>
                                </div>
                                <div class="content" style=" flex-grow: 1;">
                                    <a href="{{ $postItem->post_slug }}" target="_blank"
                                        style="text-decoration: none;font-size: 18px;font-weight: 600;display: block;margin-bottom: 10px;color: #2a2a2a;line-height: 24px;">{{ $postItem->post_title }}</a>
                                    <p>{!! Str::limit(strip_tags($postItem->post_content), 300) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($contact)
                        {!! $contact->contact_single !!}
                    @endif
                </div>

                <!-- Blog Sidebar -->
                <div class="col-lg-4 col-md-12 blog-sidebar theiaStickySidebar">
                    @include('frontend.layouts.sidebar-news')
                </div>
                <!-- /Blog Sidebar -->

            </div>
            <section class="service-section">
                <div class="container">
                    <div class="section-heading">
                        <div class="row">
                            <div class="col-md-6 aos" data-aos="fade-up">
                                <h2>Bài viết liên quan</h2>
                            </div>
                            <div class="col-md-6 text-md-end aos" data-aos="fade-up">
                                <div class="owl-nav mynav"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel service-slider">
                                @foreach ($randomPosts as $new)
                                    <div class="service-widget aos" data-aos="fade-up">
                                        <div class="service-img">
                                            <a href="{{ $new->post_slug }}">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="{{ $new->post_thumb ? url($new->post_thumb) : url('assets/img/default.jpg') }}">
                                            </a>
                                            @if ($category)
                                                <div class="fav-item">
                                                    <a href="{{ $category->cate_slug }}"><span
                                                            class="item-cat">{{ $category->cate_title }}</span></a>
                                                    <a href="javascript:void(0)" class="fav-icon">
                                                        <i class="feather-heart"></i>
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="item-info">
                                                <a href="#"><span class="item-img"><img
                                                            src="{{ url('assets/img/user.png') }}" class="avatar"
                                                            alt="anh"></span></a>
                                            </div>
                                        </div>
                                        <div class="service-content">
                                            <h3 class="title">
                                                <a href="{{ $new->post_slug }}">{{ $new->post_title }}</a>
                                            </h3>
                                            <p>
                                                @if (isset($post->user->name) && !empty($post->user->name))
                                                    {{ $post->user->name }}
                                                @endif
                                                <span class="rate"><i class="fas fa-star filled"></i>4.9</span>
                                            </p>
                                            <div class="serv-info">
                                                <a href="{{ $new->post_slug }}" class="btn btn-book">Xem tiếp</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-sec aos" data-aos="fade-up">
                            <a href="{{ url('/tin-tuc') }}" class="btn btn-primary btn-view">Xem tất cả<i
                                    class="feather-arrow-right-circle"></i></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
