@extends('frontend.layouts.app')
@section('title')Phần mềm Ninja - Phần mềm Marketing Top 1 Việt Nam @endsection
@section('meta-desc')Phần mềm Ninja - phần mềm marketing hàng đầu tại Việt Nam giúp tăng doanh số bán hàng của bạn. Khám phá tính năng đặc biệt phần mềm Ninja để mang lại hiệu quả tức thì @endsection
@section('meta-title')Phần mềm Ninja - Phần mềm Marketing Top 1 Việt Nam @endsection
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <style>
        .highlight {
            background-color: yellow;
        }
    </style>
{{--    $category->cate_slug.'/'.--}}
    <section class="news">
        <div class="container">
            <div class="news_slider">
                @foreach($latestNews as $new)
                    <div class="slider-item">
                        <div data-wow-duration="1.5s" class="box_img wow bounceInLeft">
                            <div class="img">
                                <a href="{{$new->post_slug . '.html'}}">
                                    <img alt="{!! $new->post_title !!}" src="{{url($new->post_thumb)}}">
                                </a>
                            </div>
                        </div>
                        <div data-wow-duration="1.5s" class="box_content wow bounceInRight">
                            <div class="content_item ">
                                <div class="title">
                                    <h2><a href="{{$new->post_slug . '.html'}}">{{$new->post_title}}</a></h2>
                                    <div class="text">
                                        {!! Str::words(strip_tags($new->post_content), 50) !!}
                                    </div>
                                </div>

                                <div class="time_see">
                                    <div class="time">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>{{Carbon::parse($new->created_at)->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($loop->iteration == 2)
                        @break
                    @endif
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="news_list">
                <div class="title wow fadeInUp">
                    <h1>Kết quả tìm kiếm cho "{{ $keyword }}"</h1>
                    <p></p>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-8 col-12 box_content">
                        @forelse($results as $result)
                            <div class="list_item">
                                <div class="box_list row">
                                    <div class="right col-md-4 wow fadeInLeftBig">
                                        <div class="img">
                                            <a href="{{$result->post_slug . '.html'}}">
                                                <img alt="{{$result->post_title}}" src="{{$result->post_thumb}}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="left col-md-8 wow fadeInUpBig">
                                        <div class="box_text">
                                            <div class="title">
                                                <h2><a href="{{$result->post_slug . '.html'}}">{!!$result->post_title!!}</a></h2>
                                                <div class="text">
                                                    <span>{!! Str::words(strip_tags($result->post_content), 50) !!}</span>
                                                </div>
                                            </div>
                                            <div class="time_see">
                                                <div class="time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    <span>{{Carbon::parse($result->created_at)->diffForHumans() }}</span>
                                                </div>
                                                <div class="see">
                                                    <i class="fa-regular fa-eye"></i>
                                                    <span>7895 lượt xem</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($loop->iteration == 10)
                                @break
                            @endif
                        @empty
                            {{ __('Sorry, no posts matched your criteria.') }}
                        @endforelse
                        <div class="read_more">
                            <div class="btn">
                                {!! $links !!}
                            </div>
                        </div>
                        <div class="navigation"><p></p></div>
                    </div>
                    @include('frontend.layouts.sidebar-news')
                </div>
            </div>

        </div>
    </section>
@endsection
