@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <form action="{{ route('posts.update', $posts->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xl-9">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Sửa bài viết</h5>
                            <small class="text-muted float-end">Edit</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="post_title">Tiêu đề:</label>
                                <input type="text" class="form-control" id="post_title" name="post_title"
                                    value="{{ old('post_title', $posts->post_title) }}"
                                    placeholder="Vui lòng nhập tiêu đề..." onkeyup="changePostSlug()">
                            </div>
                            <div class="mb-3">
                                <label for="post_title">Đường dẫn:</label>
                                <input type="text" class="form-control" id="post_slug" name="post_slug"
                                    value="{{ old('post_slug', $posts->post_slug) }}">
                            </div>
                            <div class="mb-3">
                                <label for="post_desc">Mô tả ngắn</label>
                                <textarea onkeyup="changePostDescp()" id="post_desc" name="post_desc" class="form-control" rows="3">{{ old('post_desc', $posts->post_desc) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="post_content">Nội dung:</label>
                                <textarea id="editor" class="form-control my-editor__" id="post_content" name="post_content" rows="10">{{ old('post_content', $posts->post_content) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Chọn bài viết</h5>
                            <small class="text-muted float-end">select</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="postList">Chọn bài viết</label>
                                <select id="postList" name="post_list[]" class="form-control js-example-tokenizer"
                                    multiple="multiple">
                                    @foreach ($postList as $postId => $postTitle)
                                        <option value="{{ $postId }}"
                                            {{ in_array($postId, $selectedPosts) ? 'selected' : '' }}>
                                            {{ $postTitle }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">SEO</h5>
                            <small class="text-muted float-end">seo</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h2 class="box_title">{{ $posts->post_seotitle }}
                                </h2>
                                <div class="box_slug">
                                    {{ url($posts->post_slug) }}
                                </div>
                                <div class="box_desc">
                                    {{ $posts->post_seodesc }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="post_seotitle">SEO Tiêu đề</label>
                                <input type="text" id="post_seotitle" name="post_seotitle" class="form-control"
                                    onkeyup="changePostSeo()" value="{{ old('post_seotitle', $posts->post_seotitle) }}">
                            </div>

                            <div class="mb-3">
                                <label for="post_seodesc">SEO Mô tả</label>
                                <textarea id="post_seodesc" name="post_seodesc" class="form-control" rows="3">{{ old('post_seodesc', $posts->post_seodesc) }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Cách hiển thị</h5>
                            <small class="text-muted float-end">View</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="post_status">Trạng thái</label>
                                <select id="post_status" name="post_status"
                                    class="form-select @error('post_status') is-invalid @enderror" required>
                                    <option value="1"
                                        {{ old('post_status', $posts->post_status) == 1 ? 'selected' : '' }}>Đã xuất bản
                                    </option>
                                    <option value="0"
                                        {{ old('post_status', $posts->post_status) == 0 ? 'selected' : '' }}>Nháp</option>
                                </select>
                                @error('post_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                {!! Form::label('post_templates', 'Giao diện', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'post_templates',
                                    ['postSingle' => 'Chọn giao diện'] + array_combine($arrayTheme, $arrayTheme),
                                    old('page_templates', $posts->page_templates),
                                    ['class' => 'form-select', 'id' => 'selectTemplate', 'aria-label' => 'Default select example'],
                                ) !!}
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" id="post_spinned" name="post_spinned" class="form-check-input"
                                    value="1" {{ old('post_spinned') ?? $posts->post_spinned == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="post_spinned">Ghim bài</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Sửa</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>

                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Danh Mục</h5>
                            <small class="text-muted float-end">Category</small>
                        </div>
                        <div class="card-body">
                            {!! showCategoriesindex($sub, $selectedCategories, 0) !!}
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Đăng</h5>
                            <small class="text-muted float-end">New</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                {!! Form::label('updated_at', 'Ngày cập nhật:', ['class' => 'col-form-label']) !!}
                                {!! Form::input(
                                    'datetime-local',
                                    'updated_at',
                                    old('updated_at', $posts->updated_at) ? old('updated_at', $posts->updated_at) : date('Y-m-d H:i:s'),
                                    [
                                        'class' => 'form-control',
                                        'id' => 'html5-datetime-local-input',
                                    ],
                                ) !!}
                            </div>
                            <div class="mb-3">
                                <label for="post_tags">Thẻ:</label>
                                <select class="form-control js-example-tokenizer" multiple="multiple" name="tags[]">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, $tag_ids_coroi) ? 'selected' : '' }}>
                                            {{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Nhập các thẻ cách nhau bằng dấu phẩy (,).</small>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Ảnh đại diện</h5>
                            <small class="text-muted float-end">Thumb</small>
                        </div>
                        <div class="card-body">
                            <div id="images">
                                @if ($posts->post_thumb == null)
                                    Chưa có ảnh được chọn.
                                @else
                                    <div class="image">
                                        <img src="{{ $posts->post_thumb }}" alt="ảnh đại diện">
                                        <p>{{ $posts->post_thumb }}</p>
                                        <input class="form-control" type="hidden" name="post_thumb"
                                            value="{{ $posts->post_thumb }}">
                                    </div>
                                @endif


                            </div>
                            <div id="btn" class="btn btn-primary" style="opacity:0.2;cursor:default">Chọn ảnh</div>
                            <div id="loading" style="font-size:12px">Loading file manager...</div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="module" src="{{ url('/assets/js/filemanager-more.js') }}"></script>
    <script type="module" src="{{ url('/assets/js/filemanager-one.js') }}"></script>
    <script>
        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [','],
            theme: "classic"
        })
    </script>
    <script>
        var url = "{{ url('/') }}";

        function changePostSlug() {
            let title = $('input[name=post_title]').val();
            var slug = convertSlug(title);
            var link = url + "/" + slug;
            $('input[name=post_slug]').val(slug);
            $('.box_slug').html(link);
            $('input[name=post_seotitle]').val(title);
        }

        function changePostDescp() {
            let desp = $('textarea[name=post_seodesc]').val();
            $('.box_desc').html(desp);
        }

        function changePostSeo() {
            let seotitle = $('input[name=post_seotitle]').val();
            $('.box_title').text(seotitle);
        }

        $(document).ready(function() {
            // Bắt sự kiện thay đổi trên trường "post_slug"
            $('input[name=post_slug]').on('input', function() {
                var slug = $(this).val();
                var fullSlug = "{{ url('') }}" + "/" + slug;
                $('.box_slug').text(fullSlug);
            });
        });
    </script>
@endsection
