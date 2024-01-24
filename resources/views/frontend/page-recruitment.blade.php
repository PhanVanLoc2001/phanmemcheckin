@extends('frontend.layouts.app')
@section('title'){{$page->page_title}}@endsection
@section('meta-desc'){{$page->page_seodesc}}@endsection
@section('meta-title'){{$page->page_title}}@endsection
@section('content')
    <section class="recruitment_banner">
        <div class="box_banner wow fadeInDown">
            <div class="banner_img">
                <img src="{{url('/assets/img/recruitment/image_3_1.png')}}" alt="banner phần mềm ninja"/>
            </div>
            <div class="banner_text">
                <div class="pr_btn">
                    <h3>Ninja Group</h3>
                </div>
                <div class="padding-bottom"></div>
                <h1>TÌM KIẾM NHÂN TÀI</h1>
                <div class="padding-bottom"></div>
                <h2>Với phương châm "con người là quan trọng nhất", chúng
                    tôi luôn tìm kiếm và trao cơ hội phát triển về nghề nghiệp
                    với những các ứng viên tiềm năng, phù hợp nhất với Ninja Group</h2>
                <div class="padding-bottom"></div>
                <div class="pr_btn">
                    <a href="{{url('/danh-sach-tuyen-dung')}}">Xem vị trí đang tuyển dụng</a>
                </div>
            </div>

        </div>
        <div class="padding"></div>
        <div class="padding"></div>
        <div class="about-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 wow fadeInLeft">
                        <div class="about_banner_img">
                            <img src="{{url('/assets/img/recruitment/Rectangle_33.png')}}"
                                 alt="banner giới thiệu">
                        </div>
                        <div class="follow">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img src="{{url('/assets/img/recruitment/Group_476.png')}}" alt="">
                                    </div>
                                    <div class="col-md-7">
                                        <img src="{{url('/assets/img/recruitment/Group_477.png')}}" alt="">
                                    </div>
                                    <div class="padding-bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInRight">
                        <div class="padding"></div>
                        <div class="padding"></div>
                        <div class="about_banner_text">
                            <h2><span>GIỚI THIỆU CHUNG</span> VỀ NINJA GROUP </h2>
                            <p></p>
                            <h3>Ninja Group là công ty chuyên cung cấp các giải pháp phần mềm Marketing trên các nền
                                tảng Social như: Facebook, Zalo, Tiktok, Telegram...Bộ giải pháp phần mềm của Ninja
                                Group giúp cá nhân, doanh nghiệp dễ dàng triển khai các chiến dịch Marketing, bán hàng
                                hiệu quả.</h3><br>
                            <h3>Bên cạnh đó, phần mềm Ninja cũng là đối tác tin cậy của nhiều đơn vị hàng đầu về công
                                nghệ Marketing như: vietmoz, Seongon, Novaon Group, Datviet Software..</h3>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="padding"></div>
        <div class="vacancies">
            <div class="text_recruitment wow tada">
                <h2><span>Các vị trí </span>đang tuyển </h2>
                <p></p>
            </div>
            <div class="container">
                <div class="row box_vacancies wow pulse">
                                      @forelse ($recruitments as $key => $recruitment)
                                      @php
                ++$key;
            @endphp
            @if ($loop->iteration > 3)
                @break
            @endif
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 product" style="margin-top: 30px">
                        <div class="vacancies_item">
                            <div class="img_pr">
                                <a href="{{'recruitment/'.$recruitment->rec_slug}}">
                                    <img src="{{$recruitment->rec_thumb}}" alt="{{$recruitment->rec_title}}"/>
                                </a>
                            </div>
                            <div class="category">
                                <p>{{$recruitment->rec_department}}</p>
                            </div>
                            <div class="vacancies_name">
                                <a href="{{'recruitment/'.$recruitment->rec_slug}}">{{$recruitment->rec_title}}</a>
                            </div>
                            <div class="content">

                                <div class="row">
                                    <div class="col-md-7">
                                        <img src="{{url('/assets/img/recruitment/Group_478.png')}}" alt="icon">
                                        <p>{{$recruitment->rec_workplace}}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <img src="{{url('/assets/img/recruitment/CurrencyCircleDollar.png')}}" alt="icon">
                                        <p>Thỏa Thuận</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>  
                    @if($key >= 3)
                        <div class="btn_readmore">
                            <a href="/danh-sach-tuyen-dung">Xem thêm</a>
                        </div>
                    @endif
                                        @empty
                                          <div class="text-center mt-3">
                                              {{ __('Sorry, no posts matched your criteria.') }}
                                          </div>

                                        @endforelse
                </div>
            </div>
        </div>
        <div class="padding"></div>
        <!-- <div class="work_environment">
            <div class="container">
                <div class="row box_work_environment">
                    <div class="work_environment_title wow bounce">
                        <h2>
                            <span>MÔI TRƯỜNG </span>TẠI NINJA GROUP
                        </h2>
                        <p class="crossbar"></p>
                    </div>
                    <div class="padding-bottom"></div>
                    <div class="img-group">
                        <div class="img-line-1">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5 wow rollIn">
                                        {{--                                        <img src="<?php the_field('a1','option'); ?>">--}}
                                    </div>
                                    <div class="col-md-3 wow bounceInDown center">
                                        {{--                                        <img src="<?php the_field('a2','option');?>">--}}
                                    </div>
                                    <div class="col-md-4 wow lightSpeedIn">
                                        {{--                                        <img src="<?php the_field('a3','option');?>" alt="anh_a3">--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="img-line-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4 wow flipInX">
                                        {{--                                        <img src="<?php the_field('b1','option');?>">--}}
                                    </div>
                                    <div class="col-sm-8 wow flipInY">
                                        {{--                                        <img src="<?php the_field('b2','option');?>" alt="anh_b2">--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="img-line-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 wow rollIn">
                                        {{--                                        <img src="<?php the_field('c1','option');?>" alt="c1">--}}
                                    </div>
                                    <div class="col-sm-6 wow rollIn">
                                        {{--                                        <img src="<?php the_field('c2','option');?>" alt="c2">--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>

@endsection
