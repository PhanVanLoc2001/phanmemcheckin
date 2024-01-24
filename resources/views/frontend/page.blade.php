@extends('frontend.layouts.app')
@section('title')
    {{ $page->page_title }}
@endsection
@section('meta-desc')
    {{ $page->page_seodesc }}
@endsection
@section('meta-title')
    {{ $page->page_title }}
@endsection
@section('content')
    <div class="bg-img">
        <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg1">
        <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg2">
        <img src="assets/img/bg/feature-bg-03.png" alt="img" class="bgimg3">
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">{{ $page->page_title }}</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page->page_title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="content">

        <div class="container">
            <!-- Get In Touch -->
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-img">
                        <img src="assets/img/contact-us.avif" class="img-fluid" alt="img">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-queries">
                        <h2>Liên hệ với chúng tôi</h2>
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Họ và tên</label>
                                        <input class="form-control" type="text" placeholder="Nhập tên*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email</label>
                                        <input class="form-control" type="email" placeholder="Nhập Email*">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Số điện thoại</label>
                                        <input class="form-control" type="text" placeholder="Nhập số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Nội dung</label>
                                        <textarea class="form-control" rows="4" placeholder="Nhập nội dung"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">Gửi<i
                                            class="feather-arrow-right-circle ms-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- /Get In Touch -->

        </div>
    </div>
@endsection
