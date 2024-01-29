@php
    use Carbon\Carbon;
@endphp
<!-- Categories -->
<div class="card about-widget">
    <div class="card-body">
        <h4 class="side-title">Hỗ trợ trực tuyến</h4>
        @if ($contact)
            {!! $contact->list_phone !!}
        @endif
    </div>
</div>
<!-- /Categories -->

<!-- Categories -->
<div class="card category-widget">
    <div class="card-body">
        <h4 class="side-title">Danh mục</h4>
        <ul class="categories">
            @foreach ($categories as $cateNew)
                <li><a href="{{ url($cateNew->cate_slug) }}">{{ $cateNew->cate_title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<!-- /Categories -->

<!-- Latest Posts -->
<div class="card post-widget">
    <div class="card-body">
        <h4 class="side-title">Tin tức mới nhất</h4>
        <ul class="latest-posts">
            @foreach ($news as $new)
                <li>
                    <div class="post-thumb">
                        <a href="{{ $new->post_slug }}">
                            <img class="img-fluid"
                                src="{{ $new->post_thumb ? url($new->post_thumb) : url('assets/img/default.jpg') }}"
                                alt="{{ $new->post_title }}">
                        </a>
                    </div>
                    <div class="post-info">
                        <p>{{ Carbon::parse($new->created_at)->locale('vi')->diffForHumans() }}</p>
                        <h4>
                            <a href="{{ $new->post_slug }}">{{ Str::limit($new->post_title, 60) }}</a>
                        </h4>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- /Latest Posts -->
