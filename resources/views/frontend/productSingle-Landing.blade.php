@extends('frontend.layouts.app')
@section('title')
    {{ $product->prod_name }}
@endsection
@section('meta-desc')
    {{ $product->prod_seodesc }}
@endsection
@section('meta-title')
    {{ $product->prod_title }}
@endsection
@section('content')
    <section class="hero-section-two">
        <div class="banner-slider slider">
            <div class="banner">
                <img class="img-fluid" src="{{ url('') }}/assets/img/banner.jpg" alt="img">
            </div>
            <div class="banner">
                <img class="img-fluid" src="{{ url('') }}/assets/img/banner-02.jpg" alt="img">
            </div>
            <div class="banner">
                <img class="img-fluid" src="{{ url('') }}/assets/img/banner-03.jpg" alt="img">
            </div>
        </div>
    </section>
    <section class="about-us-eight-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="about-eight-main">
                        <img src="{{ url('assets/img/anhtest.png') }}" alt="anh">
                        <div class="truely-eight-bg">
                            <img src="{{ url('assets/img/her-section-eight-bg.png') }}" alt="" class="img-fluid">
                        </div>
                        <div class="truely-eight-bg-two">
                            <img src="{{ url('assets/img/her-section-eight-bg.png') }}" alt="anh">
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-12">
                    <div class="passion-eight-all">
                        <div class="section-heading section-heading-eight passion-eight-heading aos aos-init aos-animate"
                            data-aos="fade-up">
                            <img src="{{ url('assets/img/icons/dog.svg') }}" alt="svg">
                            <h2>About Truely sell pet care</h2>
                            <p>Mauris ut cursus nunc. </p>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>
                        <ul>
                            <li>
                                <img src="{{ url('assets/img/icons/pink-dog-feet.svg') }}" alt="svg">
                                <span>The Pet Expert</span>
                            </li>
                            <li>
                                <img src="{{ url('assets/img/icons/pink-dog-feet.svg') }}" alt="svg">
                                <span>Love Your Pet More</span>
                            </li>
                            <li>
                                <img src="{{ url('assets/img/icons/pink-dog-feet.svg') }}" alt="svg">
                                <span>Your Pet, Our Passion</span>
                            </li>
                            <li>
                                <img src="{{ url('assets/img/icons/pink-dog-feet.svg') }}" alt="svg">
                                <span>The Pet Expert</span>
                            </li>
                            <li>
                                <img src="{{ url('assets/img/icons/pink-dog-feet.svg') }}" alt="svg">
                                <span>Love Your Pet More</span>
                            </li>
                            <li>
                                <img src="{{ url('assets/img/icons/pink-dog-feet.svg') }}" alt="svg">
                                <span>Your Pet, Our Passion</span>
                            </li>
                        </ul>
                        <div class="passion-eight-content">
                            <div class="passion-content-top">
                                <img src="{{ url('assets/img/icons/win.svg') }}" alt="svg">
                                <div class="passion-content-bottom">
                                    <h2>98.7%</h2>
                                    <p>of reviews are 5 star</p>
                                </div>
                                <a href="#" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="healthy-eight-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <div class="pets-content-all">
                        <h2>Keeping your pets</h2>
                        <h1>Happy, Healthy And Safe!</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="healthy-pets-img">
                        <img src="{{ url('assets/img/anhtest.png') }}" alt=" anh" class="img-fluid">
                        <div class="healthy-eight-bg">
                            <img src="{{ url('assets/img/her-section-eight-bg.png') }}" alt="anh">
                        </div>
                        <div class="healthy-eight-bg-two">
                            <img src="{{ url('assets/img/her-section-eight-bg.png') }}" alt="anh">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="service-section">
        <div class="container">
            <div class="section-heading">
                <div class="row">
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <h2>Featured Services</h2>
                        <p>Explore the greates our services. You won’t be disappointed</p>
                    </div>
                    <div class="col-md-6 text-md-end aos" data-aos="fade-up">
                        <div class="owl-nav mynav"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel service-slider">
                        <div class="service-widget aos" data-aos="fade-up">
                            <div class="service-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="{{ url('') }}/assets/img/services/service-01.jpg">
                                </a>
                                <div class="fav-item">
                                    <a href="categories.html"><span class="item-cat">Cleaning</span></a>
                                    <a href="javascript:void(0)" class="fav-icon">
                                        <i class="feather-heart"></i>
                                    </a>
                                </div>
                                <div class="item-info">
                                    <a href="providers.html"><span class="item-img"><img
                                                src="{{ url('') }}/assets/img/profiles/avatar-01.jpg" class="avatar"
                                                alt="avatar"></span></a>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3 class="title">
                                    <a href="service-details.html">Electric Panel Repairing Service</a>
                                </h3>
                                <p><i class="feather-map-pin"></i>New Jersey, USA<span class="rate"><i
                                            class="fas fa-star filled"></i>4.9</span></p>
                                <div class="serv-info">
                                    <h6>$25.00<span class="old-price">$35.00</span></h6>
                                    <a href="service-details.html" class="btn btn-book">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="service-widget aos" data-aos="fade-up">
                            <div class="service-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="{{ url('') }}/assets/img/services/service-02.jpg">
                                </a>
                                <div class="fav-item">
                                    <a href="categories.html"><span class="item-cat">Construction</span></a>
                                    <a href="javascript:void(0)" class="fav-icon">
                                        <i class="feather-heart"></i>
                                    </a>
                                </div>
                                <div class="item-info">
                                    <a href="providers.html"><span class="item-img"><img
                                                src="{{ url('') }}/assets/img/profiles/avatar-02.jpg"
                                                class="avatar" alt="avatar"></span></a>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3 class="title">
                                    <a href="service-details.html">Toughened Glass Fitting Services</a>
                                </h3>
                                <p><i class="feather-map-pin"></i>Montana, USA<span class="rate"><i
                                            class="fas fa-star filled"></i>4.9</span></p>
                                <div class="serv-info">
                                    <h6>$45.00</h6>
                                    <a href="service-details.html" class="btn btn-book">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="service-widget aos" data-aos="fade-up">
                            <div class="service-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="{{ url('') }}/assets/img/services/service-03.jpg">
                                </a>
                                <div class="fav-item">
                                    <a href="categories.html"><span class="item-cat">Carpentry</span></a>
                                    <a href="javascript:void(0)" class="fav-icon">
                                        <i class="feather-heart"></i>
                                    </a>
                                </div>
                                <div class="item-info">
                                    <a href="providers.html"><span class="item-img"><img
                                                src="{{ url('') }}/assets/img/profiles/avatar-03.jpg"
                                                class="avatar" alt="avatar"></span></a>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3 class="title">
                                    <a href="service-details.html">Wooden Carpentry Work</a>
                                </h3>
                                <p><i class="feather-map-pin"></i>Montana, USA<span class="rate"><i
                                            class="fas fa-star filled"></i>4.9</span></p>
                                <div class="serv-info">
                                    <h6>$45.00</h6>
                                    <a href="service-details.html" class="btn btn-book">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="service-widget aos" data-aos="fade-up">
                            <div class="service-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="{{ url('') }}/assets/img/services/service-11.jpg">
                                </a>
                                <div class="fav-item">
                                    <a href="categories.html"><span class="item-cat">Construction</span></a>
                                    <a href="javascript:void(0)" class="fav-icon">
                                        <i class="feather-heart"></i>
                                    </a>
                                </div>
                                <div class="item-info">
                                    <a href="providers.html"><span class="item-img"><img
                                                src="{{ url('') }}/assets/img/profiles/avatar-04.jpg"
                                                class="avatar" alt="avatar"></span></a>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3 class="title">
                                    <a href="service-details.html">Plumbing Services</a>
                                </h3>
                                <p><i class="feather-map-pin"></i>Georgia, USA<span class="rate"><i
                                            class="fas fa-star filled"></i>4.9</span></p>
                                <div class="serv-info">
                                    <h6>$45.00</h6>
                                    <a href="service-details.html" class="btn btn-book">Book Now</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="btn-sec aos" data-aos="fade-up">
                    <a href="search.html" class="btn btn-primary btn-view">View All<i
                            class="feather-arrow-right-circle"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
