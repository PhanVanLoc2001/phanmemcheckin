@php
    use Carbon\Carbon;
@endphp
<!-- Categories -->
{{-- <div class="card about-widget">
    <div class="card-body">
        <p class="side-title">Hỗ trợ trực tuyến</p>
        @if ($contact)
            {!! $contact->list_phone !!}
        @endif
    </div>
</div> --}}
<!-- /Categories -->

<!-- Categories -->
{{-- <div class="card category-widget">
    <div class="card-body">
        <p class="side-title">Danh mục</p>
        <ul class="categories">
            @foreach ($categories as $cateNew)
                <li><a href="{{ url($cateNew->cate_slug) }}">{{ $cateNew->cate_title }}</a></li>
            @endforeach
        </ul>
    </div>
</div> --}}
<!-- /Categories -->

<!-- Latest Posts -->
{{-- <div class="card post-widget">
    <div class="card-body">
        <p class="side-title">Tin tức mới nhất</p>
        <ul class="latest-posts">
            @foreach ($news as $new)
                <li>
                    <div class="post-thumb">
                        <a href="{{ url($new->post_slug) }}">
                            <img class="img-fluid"
                                src="{{ $new->post_thumb ? url($new->post_thumb) : url('assets/img/default.jpg') }}"
                                alt="{{ $new->post_title }}">
                        </a>
                    </div>
                    <div class="post-info">
                        <p>{{ Carbon::parse($new->created_at)->locale('vi')->diffForHumans() }}</p>
                        <h3>
                            <a href="{{ url($new->post_slug) }}">{{ Str::limit($new->post_title, 60) }}</a>
                        </h3>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div> --}}
<div class="sidebar">
    <div class="sidebar-space">
      <h4 class="blog-title">Hỗ trợ trực tuyến</h4>
      <div class="blog-divider"></div>
      <div class="blog-cat-detail">
        @if ($contact)
            {!! $contact->list_phone !!}
        @endif
      </div>
    </div>
    <h4 class="blog-title">Bài viết mới nhất</h4>
    <div class="blog-divider"></div>
    <div class="recent-blog marg-20">
        @foreach ($news->take(5) as $new)
      <div class="media d-flex"><a href="{{ url($new->post_slug) }}"><img class="me-3" src="{{ $new->post_thumb ? url($new->post_thumb) : url('assets/img/default.jpg') }}" alt="blog"></a>
        <div class="media-body"><a href="{{ url($new->post_slug) }}">
            <h5 class="mt-0">{{ $new->post_title }}</h5></a>
          <p class="m-0">{{ Carbon::parse($new->created_at)->locale('vi')->diffForHumans() }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
<!-- /Latest Posts -->
