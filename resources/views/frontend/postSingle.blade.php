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
    <section class="page-margin">
        <!-- breadcrumb start-->
        <div class="breadcrumb-bg">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6 d-align-center">
                <h2 class="title"><span>{{$post->post_title}}</span></h2>
              </div>
              <div class="col-md-6 col-sm-6">
                <nav class="theme-breadcrumb" aria-label="breadcrumb">
                  <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="{{url('tin-tuc')}}">Tin Tức</a></li>
                    <li class="breadcrumb-item active"><a href="#">{{$post->post_title}}</a></li>
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
              <!-- blog details starts-->
              <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="blog-details">
                  <div class="news-text">

                    {!! $post->post_content !!}
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
              </div>
              <!-- blog details end-->
              <!--Blog sidebar  -->
              <div class="col-md-4 col-lg-3 order-md-last list-sidebar">
                @include('frontend.layouts.sidebar-news')
              </div>
              <!--Blog sidebar Ends-->
            </div>
          </div>
        </section>
      </section>
@endsection
