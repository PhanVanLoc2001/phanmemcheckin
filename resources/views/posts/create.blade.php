@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        {!! Form::open(['route' => 'posts.store', 'method' => 'POST', 'class' => 'form-floating']) !!}
        @csrf
        <div class="row">
            <div class="col-xl-9">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thêm bài viết</h5>
                        <small class="text-muted float-end">New</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            {!! Form::label('post_title', 'Tiêu đề:') !!}
                            {!! Form::text('post_title', old('post_title'), [
                                'class' => 'form-control' . ($errors->has('post_title') ? ' is-invalid' : ''),
                                'placeholder' => 'Vui lòng nhập tiêu đề...',
                                'onkeyup' => 'changePostSlug()',
                            ]) !!}
                            {!! $errors->first('post_title', '<span class="text-danger">:message</span>') !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::label('post_slug', 'Đường dẫn:') !!}
                            {!! Form::text('post_slug', old('post_slug'), [
                                'class' => 'form-control' . ($errors->has('post_slug') ? ' is-invalid' : ''),
                                'placeholder' => 'Vui lòng nhập đường dẫn...',
                            ]) !!}
                            {!! $errors->first('post_slug', '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('post_desc', 'Mô tả ngắn:') !!}
                            {!! Form::textarea('post_desc', old('post_desc'), [
                                'class' => 'form-control',
                                'rows' => '3',
                            ]) !!}
                            {!! $errors->first('post_desc', '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('post_content', 'Nội dung:') !!}
                            {!! Form::textarea('post_content', old('post_content'), [
                                'class' => 'form-control',
                                'rows' => '10',
                                'id' => 'editor',
                            ]) !!}
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
                            {!! Form::label('postList', 'Chọn bài viết') !!}
                            {!! Form::select('post_list[]', $postList, null, [
                                'id' => 'postList',
                                'class' => 'form-control js-example-tokenizer',
                                'multiple' => 'multiple',
                            ]) !!}
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
                            <h2 class="box_title">Giới thiệu về phần mềm Ninja
                            </h2>
                            <div class="box_slug">
                                {{ url('/gioi-thieu-ve-phan-mem-ninja') }}
                            </div>
                            <div class="box_desc">
                                Phần mềm Ninja là đơn vị cung cấp các Giải pháp công nghệ, Hệ thống Phần mềm
                                Marketing hàng đầu tại Việt Nam. Sản phẩm của chúng tôi mang đến sự tiện lợi cho
                                khách hàng doanh nghiệp, cá nhân có hoạt động kinh doanh thương mại điện tử…
                            </div>
                        </div>
                        <div class="mb-3">
                            {!! Form::label('post_seotitle', 'SEO Tiêu đề') !!}
                            {!! Form::text('post_seotitle', old('post_seotitle'), [
                                'class' => 'form-control',
                                'onkeyup' => 'changePostSeo()',
                            ]) !!}
                            {!! $errors->first('post_seotitle', '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('post_keyword', 'SEO từ khóa') !!}
                            {!! Form::text('post_keyword', old('post_keyword'), ['class' => 'form-control']) !!}
                            <em><span class="text-danger fw-bold">Lưu ý</span>: Các từ khóa được cách nhau bởi dấu ,. Ví
                                dụ: Phần mềm Ninja, phần mềm marketing ... </em>
                        </div>
                        <div class="mb-3">
                            {!! Form::label('post_seodesc', 'SEO Mô tả') !!}
                            {!! Form::textarea('post_seodesc', old('post_seodesc'), [
                                'class' => 'form-control',
                                'rows' => '3',
                                'onkeyup' => 'changePostDescp()',
                            ]) !!}
                            {!! $errors->first('post_seodesc', '<span class="text-danger">:message</span>') !!}
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
                            {!! Form::label('post_status', 'Trạng thái', ['class' => 'form-label']) !!}
                            {!! Form::select('post_status', ['1' => 'Xuất bản', '0' => 'Bản nháp'], old('post_status'), [
                                'class' => 'form-select',
                                'id' => 'selectTemplate',
                                'aria-label' => 'Default select example' . ($errors->has('post_status') ? ' is-invalid' : ''),
                                'required',
                            ]) !!}
                            @error('post_status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {!! Form::label('post_templates', 'Giao diện', ['class' => 'form-label']) !!}
                            {!! Form::select(
                                'post_templates',
                                ['postSingle' => 'Chọn giao diện'] + array_combine($arrayTheme, $arrayTheme),
                                old('page_templates'),
                                ['class' => 'form-select', 'id' => 'selectTemplate', 'aria-label' => 'Default select example'],
                            ) !!}
                        </div>
                        <div class="form-check mb-3">
                            {!! Form::checkbox('post_spinned', '1', old('post_spinned'), [
                                'class' => 'form-check-input',
                                'id' => 'post_spinned',
                            ]) !!}
                            {!! Form::label('post_spinned', 'Ghim bài', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Danh Mục</h5>
                        <small class="text-muted float-end">Category</small>
                    </div>
                    <div class="card-body">
                        {!! showCategoriesindex($sub, []) !!}
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Đăng</h5>
                        <small class="text-muted float-end">New</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            {!! Form::label('created_at', 'Ngày đăng:', ['class' => 'col-form-label']) !!}
                            <div class="">
                                {!! Form::input('datetime-local', 'created_at', old('created_at') ? old('created_at') : date('Y-m-d H:i:s'), [
                                    'class' => 'form-control',
                                    'id' => 'html5-datetime-local-input',
                                ]) !!}
                            </div>
                        </div>
                        <div class="mb-3">
                            {!! Form::label('tags[]', 'Thẻ:') !!}
                            {!! Form::select('tags[]', $tags->pluck('tag_name', 'tag_name'), old('tags'), [
                                'class' => 'form-control js-example-tokenizer',
                                'multiple' => 'multiple',
                            ]) !!}
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
                            Chưa có ảnh được chọn.
                        </div>
                        <div id="btn" class="btn btn-primary" style="opacity:0.2;cursor:default">Chọn ảnh</div>
                        <div id="loading" style="font-size:12px">Loading file manager...</div>
                    </div>
                </div>
                {{-- <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thư viện</h5>
                        <small class="text-muted float-end">Thumb</small>
                    </div>
                    <div class="card-body">
                        <div id="images-gallery">
                            <p>0 ảnh đã được chọn</p>
                        </div>
                        <div id="btn-gallery" class="btn btn-primary" style="opacity:0.2;cursor:default">Chọn ảnh
                        </div>
                        <div id="loading-gallery" style="font-size:12px">Loading file manager...</div>
                    </div>

                </div> --}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    {{-- <script type="module" src="{{ url('/assets/js/filemanager-more.js') }}"></script> --}}
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
