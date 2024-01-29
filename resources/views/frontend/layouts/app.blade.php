<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta-desc')" />
    @php
        $currentUrl = request()->url();
    @endphp
    <link rel="canonical" href="{{ $currentUrl }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('meta-title')" />
    <meta property="og:description" content="@yield('meta-desc')" />
    <meta property="og:url" content="{{ $currentUrl }}" />
    <meta name="robots" content="max-image-preview:large,noarchive,noodp,index,follow">
    <meta property="og:site_name"
        content="Phần mềm chấm công công nghệ AI, quản lý nhân sự với công nghệ hiện đại, chi phí tối giản" />
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="icon" href="{{ url('img/favicon.webp') }}">
    @include('frontend.layouts.style')
    @yield('schema')
    <!-- Google tag (gtag.js) -->
    @if ($contact)
        {!! $contact->code_header !!}
    @endif

</head>

<body>
    @include('frontend.layouts.header')
    @yield('content')
    <div class="hotline-phone-ring-wrap" id="hotline-phone-1">
        <div class="hotline-phone-ring">
            <div class="hotline-phone-ring-circle"></div>
            <div class="hotline-phone-ring-circle-fill"></div>
            <div class="hotline-phone-ring-img-circle"><a
                    href="tel:@if ($contact) {{ $contact->phone_link }} @endif"
                    aria-label="Number Phone" class="pps-btn-img">
                    <span class="background-call"></span> </a></div>
        </div>
        <div class="hotline-bar"><a href="@if ($contact) {{ $contact->phone_link }} @endif"
                aria-label="Số điện thoại: @if ($contact) {{ $contact->phone_number }} @endif"
                rel="nofollow">
                <span class="text-hotline">
                    @if ($contact)
                        {{ $contact->phone_number }}
                    @endif
                </span> </a></div>
    </div>
    @include('frontend.layouts.footer')
    @include('frontend.layouts.script')
</body>

</html>
