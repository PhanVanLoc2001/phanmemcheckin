@extends('frontend.layouts.app')
@section('title'){{$page->page_title}}@endsection
@section('meta-desc'){{$page->page_seodesc}}@endsection
@section('meta-title'){{$page->page_title}}@endsection
@section('content')
    <section class="contact-page-section">
        <div class="container">
            <div class="sec-title">
                <div class="title">Liên hệ</div>
                <h2>Liên hệ với chúng tôi</h2>
            </div>
            <div class="inner-container">
                <div class="row clearfix">

                    <!--Form Column-->
                    <div class="form-column col-md-8 col-sm-12 col-xs-12">
                        <div class="inner-column">

                            <!--Contact Form-->
                            <div class="contact-form">
                                <form method="post" action="{{ route('send.email') }}" id="contact-form">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                            <input type="text" name="fullname" placeholder="Họ và tên" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                            <input type="email" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                            <input type="text" name="subject" placeholder="Vấn đề" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                            <input type="text" name="phone" placeholder="Số điện thoại">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                            <textarea name="message" placeholder="Tin nhắn" required></textarea>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                            <button type="submit" class="theme-btn btn-style-one" >Gửi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--End Contact Form-->

                        </div>
                    </div>

                    <!--Info Column-->
                    <div class="info-column col-md-4 col-sm-12 col-xs-12">
                        <div class="inner-column">
                            <h2>Contact Info</h2>
                            <ul class="list-info">
                                <li><i class="fas fa-globe"></i>https://phanmemninja.vn/</li>
                                <li><i class="far fa-envelope"></i>example@test</li>
                                <li><i class="fas fa-phone"></i>0908.165.480<br> 0967.922.911</li>
                            </ul>
                            <ul class="social-icon-four">
                                <li class="follow">Follow on: </li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
