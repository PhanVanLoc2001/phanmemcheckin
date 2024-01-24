@extends('frontend.layouts.app')
@section('title')
    {{ $recruitment->rec_title }}
@endsection
@section('meta-desc')
    {{ $recruitment->rec_seodesc }}
@endsection
@section('meta-title')
    {{ $recruitment->rec_title }}
@endsection
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <section class="detail_news single_recruitment">
        <div class="container">
            <div class="row">
            </div>
        </div>
        <div class="banner_recruitment">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 background-all">
                        <div class="row background-cl">
                            <div class="col-lg-7 col-md-6 col-sm-6 col-12 box_right_2">
                                <div class="box_img_2">
                                    <img src="{{ $recruitment->rec_thumb }}" alt="{{ $recruitment->rec_title }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12 box_left">
                                <div class="box_text">
                                    <div class="time">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>{{ Carbon::parse($recruitment->created_at)->diffForHumans() }}</span>
                                    </div>
                                    <div class="text">
                                        {{ $recruitment->rec_department }}
                                    </div>
                                    <div class="title">
                                        <h1>{{ $recruitment->rec_title }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11 col-md-8 col-sm-9 col-12 box_content">
                                <div class="padding-bottom"></div>
                                {!! $recruitment->rec_content !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        @include('frontend.layouts.sidebar-recruitment')
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
