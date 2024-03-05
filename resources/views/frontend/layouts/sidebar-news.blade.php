@php
    use Carbon\Carbon;
@endphp

<div class="sidebar-tool">
    <div class="title">
        <p>Hỗ trợ trực tuyến</p>
    </div>
    <p class="sider-center"></p>
    <div class="btn">
        <i class="fa-solid fa-location-dot"></i>
        <span>Hotline hỗ trợ</span>
    </div>
    <ul>
        @if ($contact)
            {!! $contact->list_phone !!}
        @endif
    </ul>
</div>
<!-- /Latest Posts -->
