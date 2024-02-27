@extends('frontend.layouts.app')
@section('title')
{{ $product->prod_title }}
@endsection
@section('meta-desc')
{{ $product->prod_seodesc }}
@endsection
@section('meta-title')
{{ $product->prod_title }}
@endsection
@section('schema')
    <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{url('san-pham/'.$product->prod_slug)}}"
  },
  "headline": "{{$product->prod_name}}",
  "description": "{{$product->prod_seodesc}}",
  "datePublished": "{{$product->created_at}}",
  "dateModified": "{{$product->updated_at}}",
  "author": {
    "@type": "Person",
    "name": "{{$product->user->name}}"
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
    "url": "{{$product->prod_thumb ? url($product->prod_thumb) : url('assets/immg/default.jpg')}}",
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
                        <h3>{{ $product->prod_name }}</h3>
                        <div class="blog-category sin-post">
                            <ul>
                                <li><i class="feather-calendar me-1"></i>
                                    {{ Carbon::parse($product->created_at)->locale('vi')->diffForHumans() }}</li>
                                <li>
                                    <div class="post-author">
                                        <a href="#"><img src="{{ url('assets/img/user.png') }}"
                                                alt="product Author"><span>
                                                @if (isset($product->user->name))
                                                    {{ $product->user->name }}
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
                            {!! $product->prod_content !!}
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
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="{{ $new->prod_thumb ? url($new->prod_thumb) : url('assets/img/default.jpg') }}">
                                            </a>
                                            @if ($category)
                                                <div class="fav-item">
                                                    <a href="{{ url($category->cate_slug) }}"><span
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
                                                <a
                                                    href="{{ url('san-pham/' . $new->prod_slug) }}">{{ $new->prod_name }}</a>
                                            </h3>
                                            <p>
                                                {{ Str::limit($new->prod_desc, 50) }}
                                            </p>
                                            <div class="serv-info">
                                                <a href="{{ url('san-pham/' . $new->prod_slug) }}" class="btn btn-book">Xem
                                                    tiếp</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-sec aos" data-aos="fade-up">
                            <a href="{{ url('/san-pham') }}" class="btn btn-primary btn-view">Xem tất cả<i
                                    class="feather-arrow-right-circle"></i></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
