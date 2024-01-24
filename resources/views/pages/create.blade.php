@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        {!! Form::open(['route' => 'pages.store', 'method' => 'page', 'class' => 'form-floating']) !!}
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thêm trang</h5>
                        <small class="text-muted float-end">New</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            {!! Form::label('page_title', 'Tiêu đề:') !!}
                            {!! Form::text('page_title', old('page_title'), [
                                'class' => 'form-control' . ($errors->has('page_title') ? ' is-invalid' : ''),
                                'placeholder' => 'Vui lòng nhập tiêu đề...',
                                'onkeyup' => 'changePageSlug()',
                            ]) !!}
                            {!! $errors->first('page_title', '<span class="text-danger">:message</span>') !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::label('page_slug', 'Đường dẫn:') !!}
                            {!! Form::text('page_slug', old('page_slug'), [
                                'class' => 'form-control' . ($errors->has('page_slug') ? ' is-invalid' : ''),
                                'placeholder' => 'Vui lòng nhập đường dẫn...',
                            ]) !!}
                            {!! $errors->first('page_slug', '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('page_desc', 'Mô tả ngắn:') !!}
                            {!! Form::textarea('page_desc', old('page_desc'), [
                                'class' => 'form-control',
                                'rows' => '3',
                            ]) !!}
                            {!! $errors->first('page_desc', '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('page_content', 'Nội dung:') !!}
                            {!! Form::textarea('page_content', old('page_content'), [
                                'class' => 'form-control ',
                                'id' => 'editor',
                                'rows' => '10',
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
                            {!! Form::label('page_seotitle', 'SEO Tiêu đề') !!}
                            {!! Form::text('page_seotitle', old('page_seotitle'), [
                                'class' => 'form-control',
                                'onkeyup' => 'changePageSeo()',
                            ]) !!}
                            {!! $errors->first('page_seotitle', '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('page_seodesc', 'SEO Mô tả') !!}
                            {!! Form::textarea('page_seodesc', old('page_seodesc'), [
                                'class' => 'form-control',
                                'rows' => '3',
                                'onkeyup' => 'changePageDescp()',
                            ]) !!}
                            {!! $errors->first('page_seodesc', '<span class="text-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Cách hiển thị</h5>
                        <small class="text-muted float-end">View</small>
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
                            {!! Form::label('page_status', 'Trạng thái') !!}
                            {!! Form::select('page_status', ['1' => 'Đã xuất bản', '0' => 'Nháp'], old('page_status'), [
                                'class' => 'form-select' . ($errors->has('page_status') ? ' is-invalid' : ''),
                                'required',
                            ]) !!}
                            @error('page_status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {!! Form::label('page_templates', 'Giao diện', ['class' => 'form-label']) !!}
                            {!! Form::select(
                                'page_templates',
                                ['page' => 'Chọn giao diện'] + array_combine($arrayTheme, $arrayTheme),
                                old('page_templates'),
                                ['class' => 'form-select', 'id' => 'selectTemplate', 'aria-label' => 'Default select example'],
                            ) !!}
                        </div>
                        {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Quay lại</a>

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
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    <script type="module" src="{{ url('/assets/js/filemanager-page-one.js') }}"></script>
    <script>
        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [','],
            theme: "classic"
        })
    </script>
    <script>
        var url = "{{ url('/') }}";

        function changePageSlug() {
            let title = $('input[name=page_title]').val();
            var slug = convertSlug(title);
            var link = url + "/" + slug;
            $('input[name=page_slug]').val(slug);
            $('.box_slug').html(link);
            $('input[name=page_seotitle]').val(title);
        }

        function changePageDescp() {
            let desp = $('textarea[name=page_seodesc]').val();
            $('.box_desc').html(desp);
        }

        function changePageSeo() {
            let seotitle = $('input[name=page_seotitle]').val();
            $('.box_title').text(seotitle);
        }

        $(document).ready(function() {
            // Bắt sự kiện thay đổi trên trường "page_slug"
            $('input[name=page_slug]').on('input', function() {
                var slug = $(this).val();
                var fullSlug = "{{ url('') }}" + "/" + slug;
                $('.box_slug').text(fullSlug);
            });
        });
    </script>
@endsection
