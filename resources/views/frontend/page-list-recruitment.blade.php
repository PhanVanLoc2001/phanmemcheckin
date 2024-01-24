@extends('frontend.layouts.app')
@section('title'){{$page->page_title}}@endsection
@section('meta-desc'){{$page->page_seodesc}}@endsection
@section('meta-title'){{$page->page_title}}@endsection
@section('content')
    <section class="list_recruitment_banner">
        <div class="box_banner">
            <div class="option_banner">
                <div class="container">
                    <div class="row">
                        @include('frontend.layouts.search-form')
                    </div>
                </div>
            </div>
        </div>
        <div class="padding"></div>
        <div class="vacancies">
            <div class="container">
                <div class="row box_vacancies">
                   @foreach($recruitments as $recruitment)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 product" style="margin-top: 50px">
                        <div class="vacancies_item">
                            <div class="img_pr">
                                <a href="{{'recruitment/' . $recruitment->rec_slug}}">
                                    <img src="{{$recruitment->rec_thumb}}" alt="{{$recruitment->rec_title}}"/>
                                </a>
                            </div>
                            <div class="category">
                               <p>{{$recruitment->rec_department}}</p>
                            </div>
                            <div class="vacancies_name">
                                <a href="{{'recruitment/' . $recruitment->rec_slug}}">{{$recruitment->rec_title}}</a>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-7">
                                        <img src="{{url('/assets/img/recruitment/Group_478.png')}}" alt="ad">
                                        <p class="">{{$recruitment->rec_workplace}}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <img src="{{url('/assets/img/recruitment/CurrencyCircleDollar.png')}}" alt="a1">
                                        <p class=""> Thỏa Thuận</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="padding"></div>
    </section>
@endsection
