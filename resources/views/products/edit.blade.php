@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <form action="{{ route('products.update', $products->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xl-9">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Sửa sản phẩm</h5>
                            <input type="hidden" name="cate_type" value="2">
                            <small class="text-muted float-end">Edit</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                {!! Form::label('prod_name', 'Tên sản phẩm:') !!}
                                {!! Form::text('prod_name', old('prod_name', $products->prod_name), [
                                    'class' => 'form-control' . ($errors->has('prod_name') ? ' is-invalid' : ''),
                                    'placeholder' => 'Vui lòng nhập tiêu đề...',
                                    'onkeyup' => 'changeProductSlug()',
                                ]) !!}
                                {!! $errors->first('prod_name', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('prod_slug', 'Đường dẫn:') !!}
                                {!! Form::text('prod_slug', old('prod_slug', $products->prod_slug), [
                                    'class' => 'form-control' . ($errors->has('prod_slug') ? ' is-invalid' : ''),
                                    'placeholder' => 'Vui lòng nhập đường dẫn...',
                                ]) !!}
                                {!! $errors->first('prod_slug', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('prod_desc', 'Mô tả ngắn:') !!}
                                {!! Form::textarea('prod_desc', old('prod_desc', $products->prod_desc), [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                ]) !!}
                                {!! $errors->first('prod_desc', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('prod_excerpt', 'Trích dẫn:') !!}
                                {!! Form::textarea('prod_excerpt', old('prod_excerpt', $products->prod_excerpt), [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                ]) !!}
                                {!! $errors->first('prod_excerpt', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('prod_content', 'Nội dung:') !!}
                                {!! Form::textarea('prod_content', old('prod_content', $products->prod_content), [
                                    'class' => 'form-control ',
                                    'rows' => '10',
                                    'id' => 'editor',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 ">
                        <div class="card-header d-flex justify-content-between align-items-center ">
                            <h5 class="mb-0">Ảnh giá tiền</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 border border-1 p-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="images-price">
                                            @if ($products->prod_background == null)
                                                Chưa có ảnh được chọn.
                                            @else
                                                <div class="image">
                                                    <img src="{{ $products->prod_background }}" alt="ảnh đại diện">
                                                    <p>{{ $products->prod_background }}</p>
                                                    <input class="form-control" type="hidden" name="prod_background"
                                                        value="{{ $products->prod_background }}">
                                                </div>
                                            @endif
                                        </div>
                                        <div id="btn-price" class="btn btn-primary" style="opacity:0.2;cursor:default">Chọn
                                            ảnh
                                        </div>
                                        <div id="loading-price" style="font-size:12px">Loading file manager...</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card mb-4 ">
                        <div class="card-header d-flex justify-content-between align-items-center ">
                            <h5 class="mb-0">Ảnh banner</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 border border-1 p-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="images-banner">
                                            @if ($prodFeature !== null && count($prodFeature) > 0)
                                                @foreach ($prodFeature as $image)
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <div class="image">
                                                                <img src="{{ $image }}" alt="ảnh đại diện">
                                                                <p>{{ $image }}</p>
                                                                <input class="form-control" type="hidden"
                                                                    name="prod_feature[]" value="{{ $image }}">
                                                            </div>

                                                        </div>
                                                        <div class="col d-flex align-items-center">
                                                            <button class="btn btn-danger delete-image">-</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                Chưa có ảnh được chọn.
                                            @endif

                                        </div>
                                        <div id="btn-banner" class="btn btn-primary" style="opacity:0.2;cursor:default">
                                            Chọn ảnh
                                        </div>
                                        <div id="loading-banner" style="font-size:12px">Loading file manager...</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Tính năng của phần mềm</h5>
                                <small class="text-muted float-end">feature</small>
                            </div>
                            <div class="card-body">
                                <div id="repeater">
                                    @foreach ($result as $key => $attribute)
                                        <div class="row">
                                            <div class="col">
                                                {!! Form::label('column1', 'Left') !!}
                                                {!! Form::textarea('prod_attributes[]', $attribute[0], [
                                                    'class' => 'ckeditor_left basic-example',
                                                    // 'id' => 'editor',
                                                ]) !!}
                                            </div>
                                            <div class="col">
                                                {!! Form::label('column2', 'Right') !!}
                                                {!! Form::textarea('prod_attributes[]', $attribute[1], [
                                                    'class' => 'ckeditor_right basic-example',
                                                    // 'id' => 'editor',
                                                ]) !!}
                                            </div>
                                            <div class="col-md-1 minus">
                                                {!! Form::button('-', ['class' => 'btn btn-danger delete-row']) !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pt-5"><a class="btn btn-primary text-white" id="add-row">Add Row</a></div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Link sản phẩm</h5>
                                <small class="text-muted float-end">Link</small>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    {!! Form::label('download', 'Link tải', ['class' => 'form-label']) !!}
                                    {!! Form::text('download', old('download', $products->download), [
                                        'class' => 'form-control',
                                        'id' => 'basic-default-download',
                                    ]) !!}
                                </div>
                                <div class="mb-3">
                                    {!! Form::label('update', 'Link Update', ['class' => 'form-label']) !!}
                                    {!! Form::text('update', old('update', $products->update), [
                                        'class' => 'form-control',
                                        'id' => 'basic-default-update',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Giá tiền</h5>
                                <small class="text-muted float-end">Price</small>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    {!! Form::label('prod_price', 'Giá sản phẩm', ['class' => 'form-label']) !!}
                                    {!! Form::text('prod_price', old('prod_price', $products->prod_price), [
                                        'class' => 'form-control',
                                        'id' => 'basic-default-price',
                                    ]) !!}
                                    {!! $errors->first('prod_price', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="mb-3">
                                    {!! Form::label('prod_saleprice', 'Giảm giá', ['class' => 'form-label']) !!}
                                    {!! Form::text('prod_saleprice', old('prod_saleprice', $products->prod_saleprice), [
                                        'class' => 'form-control',
                                        'id' => 'basic-default-sale',
                                    ]) !!}
                                    {!! $errors->first('prod_saleprice', '<span class="text-danger">:message</span>') !!}

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
                                    <h2 class="box_title">{{ $products->prod_seotitle }}
                                    </h2>
                                    <div class="box_slug">
                                        {{ url('/san-pham' . '/' . $products->prod_slug) }}
                                    </div>
                                    <div class="box_desc">
                                        {{ $products->prod_seodesc }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    {!! Form::label('prod_seotitle', 'SEO Tiêu đề') !!}
                                    {!! Form::text('prod_seotitle', old('prod_seotitle', $products->prod_seotitle), [
                                        'class' => 'form-control',
                                        'onkeyup' => 'changeProductSeo()',
                                    ]) !!}
                                    {!! $errors->first('prod_seotitle', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="mb-3">
                                    {!! Form::label('prod_seodesc', 'SEO Mô tả') !!}
                                    {!! Form::textarea('prod_seodesc', old('prod_seodesc', $products->prod_seodesc), [
                                        'class' => 'form-control',
                                        'rows' => '3',
                                        'onkeyup' => 'changeProductDescp()',
                                    ]) !!}
                                    {!! $errors->first('prod_desc', '<span class="text-danger">:message</span>') !!}
                                </div>
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
                                {!! Form::label('prod_status', 'Trạng thái') !!}
                                {!! Form::select('prod_status', ['1' => 'Xuất bản', '0' => 'Nháp'], old('prod_status', $products->prod_status), [
                                    'class' => 'form-select' . ($errors->has('prod_status') ? ' is-invalid' : ''),
                                    'required',
                                ]) !!}
                                @error('prod_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                {!! Form::label('prod_template', 'Giao diện', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'prod_template',
                                    ['productSingle' => 'Chọn giao diện'] + array_combine($arrayTheme, $arrayTheme),
                                    old('prod_template', $products->prod_template),
                                    ['class' => 'form-select', 'id' => 'selectTemplate', 'aria-label' => 'Default select example'],
                                ) !!}
                            </div>
                            <div class="form-check mb-3">
                                {!! Form::checkbox('prod_spin', 1, old('prod_spin', $products->prod_spin) == 1, [
                                    'class' => 'form-check-input',
                                    'id' => 'prod_spin',
                                ]) !!}
                                {!! Form::label('prod_spin', 'Ghim bài', ['class' => 'form-check-label']) !!}
                            </div>
                            {!! Form::submit('Chỉnh sửa', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Quay lại</a>

                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Danh Mục</h5>
                            <small class="text-muted float-end">Category</small>
                        </div>
                        <div class="card-body">
                            {!! showCategoriesproduct($subP, $checkedCategories, 0) !!}
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
                                    old('updated_at', $products->updated_at) ? old('updated_at', $products->updated_at) : date('Y-m-d H:i:s'),
                                    [
                                        'class' => 'form-control',
                                        'id' => 'html5-datetime-local-input',
                                    ],
                                ) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('tags[]', 'Thẻ:') !!}
                                {!! Form::select('tags[]', $tags->pluck('tag_name', 'id'), $tag_ids_list, [
                                    'class' => 'form-control js-example-tokenizer',
                                    'multiple' => 'multiple',
                                ]) !!}
                                <small class="form-text text-muted">Nhập các thẻ cách nhau bằng dấu phẩy (,).</small>
                            </div>

                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Ảnh đại diện bài viết</h5>
                            <small class="text-muted float-end">Thumb</small>
                        </div>
                        <div class="card-body">
                            <div id="images">
                                @if ($products->prod_thumb == null)
                                    Chưa có ảnh được chọn.
                                @else
                                    <div class="image">
                                        <img src="{{ $products->prod_thumb }}" alt="ảnh đại diện">
                                        <p>{{ $products->prod_thumb }}</p>
                                        <input class="form-control" type="hidden" name="prod_thumb"
                                            value="{{ $products->prod_thumb }}">
                                    </div>
                                @endif
                            </div>
                            <div id="btn" class="btn btn-primary" style="opacity:0.2;cursor:default">Chọn ảnh
                            </div>
                            <div id="loading" style="font-size:12px">Loading file manager...</div>
                        </div>

                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Ảnh box</h5>
                            <small class="text-muted float-end">Thumb</small>
                        </div>
                        <div class="card-body">
                            <div id="images-box">
                                @if ($products->prod_library == null)
                                    Chưa có ảnh được chọn.
                                @else
                                    <div class="image">
                                        <img src="{{ $products->prod_library }}" alt="ảnh đại diện">
                                        <p>{{ $products->prod_library }}</p>
                                        <input class="form-control" type="hidden" name="prod_library"
                                            value="{{ $products->prod_library }}">
                                    </div>
                                @endif
                            </div>
                            <div id="btn-box" class="btn btn-primary" style="opacity:0.2;cursor:default">Chọn ảnh
                            </div>
                            <div id="loading-box" style="font-size:12px">Loading file manager...</div>
                        </div>

                    </div>
                </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="module" src="{{ url('/assets/js/filemanager-product-box-one.js') }}"></script>
    <script type="module" src="{{ url('/assets/js/filemanager-product-one.js') }}"></script>
    <script type="module" src="{{ url('/assets/js/filemanager-product-price.js') }}"></script>
    <script type="module" src="{{ url('/assets/js/filemanager-product-more.js') }}"></script>
    <script>
        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [','],
            theme: "classic"
        })
    </script>
    <script>
        $(document).ready(function() {
            // Thêm một hàng mới khi nhấp vào nút "Add Row"
            $('#add-row').click(function() {
                $('#repeater').append('<div class="row">' +
                    '<div class="col">' +
                    '<textarea  class="ckeditor_left basic-example"  name="prod_attributes[]"></textarea>' +
                    '</div>' +
                    '<div class="col">' +
                    '<textarea class="ckeditor_right basic-example"  name="prod_attributes[]"></textarea>' +
                    '</div>' +
                    '<div class="col-md-1 minus">' +
                    '<button class="btn btn-danger delete-row">-</button>' +
                    '</div>' +
                    '</div>');
                tinymce.init({
                    selector: 'textarea.basic-example',
                    height: 500,
                    ui: {
                        useAutoToolbar: false
                    },
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'help', 'wordcount', 'n1ed'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                        'bold italic forecolor backcolor | alignleft aligncenter ' +
                        'alignright alignjustify | bullist numlist outdent indent Image|' +
                        'blocks fontfamily fontsize',

                    document_base_url: '{{ url('') }}/files/',
                    Flmngr: {
                        apiKey: "pbALgPEI", // default free key
                        urlFileManager: '/fileManager',
                        // urlFiles: '/files',
                    },
                    // quickbars_insert_toolbar: 'Image',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
                });
            });
            tinymce.init({
                selector: 'textarea.basic-example',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                quickbars_insert_toolbar: 'Image',
                document_base_url: '{{ url('') }}/files/',
                Flmngr: {
                    apiKey: "pbALgPEI", // default free key
                    urlFileManager: '/fileManager',
                    // urlFiles: '/files',
                },
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
            // Xóa hàng khi nhấp vào nút "-"
            $(document).on('click', '.delete-row', function() {
                var confirmation = confirm("Bạn có chắc chắn muốn xóa hàng này?");
                if (confirmation) {
                    $(this).closest('.row').remove();
                }
            });
            $(document).on('click', '.delete-image', function() {
                var confirmation = confirm("Bạn có chắc chắn muốn xóa ảnh này?");
                if (confirmation) {
                    $(this).closest('.row').remove();
                }
            });
        });
    </script>
    <script>
        var url = "{{ url('/san-pham') }}";

        function changeProductSlug() {
            let title = $('input[name=prod_name]').val();
            var slug = convertSlug(title);
            var link = url + "/" + slug;
            var desc = $('textarea[name=prod_seodesc]').val();
            $('input[name=prod_slug]').val(slug);
            $('.box_slug').html(link);
            $('input[name=prod_seotitle]').val(title);
        }

        function changeProductDescp() {
            let desp = $('textarea[name=prod_seodesc]').val();
            $('.box_desc').html(desp);
        }

        function changeProductSeo() {
            let seotitle = $('input[name=prod_seotitle]').val();
            $('.box_title').text(seotitle);
        }
    </script>
@endsection
