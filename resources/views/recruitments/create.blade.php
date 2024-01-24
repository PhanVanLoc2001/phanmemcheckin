@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        {!! Form::open(['route' => 'recruitments.store', 'method' => 'POST', 'class' => 'form-floating']) !!}
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thêm tuyển dụng</h5>
                        <small class="text-muted float-end">New</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            {!! Form::label('rec_title', 'Tiêu đề:') !!}
                            {!! Form::text('rec_title', old('rec_title'), ['class' => 'form-control' . ($errors->has('rec_title') ? ' is-invalid' : ''), 'placeholder' => 'Vui lòng nhập tiêu đề...', 'onkeyup' => 'changePostSlug()']) !!}
                            {!! $errors->first('rec_title', '<span class="text-danger">:message</span>') !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_slug', 'Đường dẫn:') !!}
                            {!! Form::text('rec_slug', old('rec_slug'), ['class' => 'form-control' . ($errors->has('rec_slug') ? ' is-invalid' : ''), 'placeholder' => 'Vui lòng nhập đường dẫn...']) !!}
                            {!! $errors->first('rec_slug', '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_desc', 'Mô tả ngắn:') !!}
                            {!! Form::textarea('rec_desc', old('post_desc'), ['class' => 'form-control', 'rows' => '3', 'onkeyup' => 'changePostDescp()']) !!}
                            {!! $errors->first('rec_desc', '<span class="text-rec_seotitledanger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_content', 'Nội dung:') !!}
                            {!! Form::textarea('rec_content', old('rec_content'), ['class' => 'form-control my-editor__', 'rows' => '10', 'id' => 'my-editor']) !!}
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
                                {{url('/gioi-thieu-ve-phan-mem-ninja.html')}}
                            </div>
                            <div class="box_desc">
                                Phần mềm Ninja là đơn vị cung cấp các Giải pháp công nghệ, Hệ thống Phần mềm
                                Marketing hàng đầu tại Việt Nam. Sản phẩm của chúng tôi mang đến sự tiện lợi cho
                                khách hàng doanh nghiệp, cá nhân có hoạt động kinh doanh thương mại điện tử…
                            </div>
                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_seotitle', 'SEO Tiêu đề') !!}
                            {!! Form::text('rec_seotitle', old('rec_seotitle'), ['class' => 'form-control']) !!}
                            {!! $errors->first('rec_seotitle', '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_seodesc', 'SEO Mô tả') !!}
                            {!! Form::textarea('rec_seodesc', old('rec_seodesc'), ['class' => 'form-control', 'rows' => '3']) !!}
                            {!! $errors->first('rec_seodesc', '<span class="text-danger">:message</span>') !!}
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
                            {!! Form::label('rec_status', 'Trạng thái') !!}
                            {!! Form::select('rec_status', ['1' => 'Active', '0' => 'Draft'], old('rec_status'), ['class' => 'form-select' . ($errors->has('rec_status') ? ' is-invalid' : ''), 'required']) !!}
                            @error('rec_status')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_template', 'Giao diện', ['class' => 'form-label']) !!}
                            {!! Form::select('rec_template', ['recruitmentSingle' => 'Chọn giao diện']+ array_combine($arrayTheme, $arrayTheme), old('rec_template'), ['class' => 'form-select', 'id' => 'selectTemplate', 'aria-label' => 'Default select example']) !!}
                        </div>
                        <div class="form-check mb-3">
                            {!! Form::checkbox('rec_spin', '1', old('rec_spin'), ['class' => 'form-check-input', 'id' => 'rec_spin']) !!}
                            {!! Form::label('rec_spin', 'Ghim bài', ['class' => 'form-check-label']) !!}
                        </div>
                        {!! Form::submit('Thêm', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Quay lại</a>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Cài đặt</h5>
                        <small class="text-muted float-end">View</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            {!! Form::label('rec_quantity', 'Số lượng') !!}
                            {!! Form::text('rec_quantity', old('rec_quantity'), ['class' => 'form-control']) !!}
                            {!! $errors->first('rec_quantity', '<span class="text-danger">:message</span>') !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_money', 'Mức lương') !!}
                            {!! Form::text('rec_money', old('rec_money'), ['class' => 'form-control']) !!}
                            {!! $errors->first('rec_money', '<span class="text-danger">:message</span>') !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_department', 'Phòng ban') !!}
                            {!! Form::select('rec_department', [''=>'Chọn phòng ban','Phòng Dev' => 'Phòng Dev', 'Phòng HCNS' => 'Phòng HCNS', 'Phòng kinh doanh' => 'Phòng kinh doanh', 'Phòng Marketing' => 'Phòng Marketing', 'Phòng Support' => 'Phòng Support'], old('rec_department'), ['class' => 'form-select' . ($errors->has('rec_department') ? ' is-invalid' : ''), 'required']) !!}
                            @error('rec_department')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_time', 'Ca làm việc') !!}
                            {!! Form::select('rec_time', [''=>'Chọn ca','Toàn thời gian' => 'Toàn thời gian', 'Theo ca' => 'Theo ca'], old('rec_time'), ['class' => 'form-select' . ($errors->has('rec_time') ? ' is-invalid' : ''), 'required']) !!}
                            @error('rec_time')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_workplace', 'Văn phòng') !!}
                            {!! Form::select('rec_workplace', ['' => 'Chọn văn phòng', 'Văn phòng Hà Nội' => 'Văn phòng Hà Nội','Văn phòng Hồ Chí Minh'=>'Văn phòng Hồ Chí Minh'], old('rec_workplace'), ['class' => 'form-select' . ($errors->has('rec_workplace') ? ' is-invalid' : ''), 'required']) !!}
                            @error('rec_workplace')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {!! Form::label('rec_address', 'Văn phòng') !!}
                            {!! Form::select('rec_address', ['' => 'Chọn địa chỉ', 'Công ty Phần mềm Ninja – Tòa nhà GMA Building, 307/6 Nguyễn Văn Trỗi, Phường 1, Quận Tân Bình, TP.HCM' => 'Công ty Phần mềm Ninja – Tòa nhà GMA Building, 307/6 Nguyễn Văn Trỗi, Phường 1, Quận Tân Bình, TP.HCM','Công ty Phần mềm Ninja – 62 Nguyễn Huy Tưởng, Thanh Xuân, Hà Nội'=>'Công ty Phần mềm Ninja – 62 Nguyễn Huy Tưởng, Thanh Xuân, Hà Nội'], old('rec_workplace'), ['class' => 'form-select' . ($errors->has('rec_workplace') ? ' is-invalid' : ''), 'required']) !!}
                            @error('rec_address')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ảnh đại diện</h5>
                        <small class="text-muted float-end">Thumb</small>
                    </div>
                    <div class="card-body">
                        <div id="holder_thumb" style="margin-bottom:15px;"></div>
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail_thumb" data-preview="holder_thumb"
                                       class="btn btn-primary btn_upload">
                                        <i class="fa fa-picture-o"></i> Upload ảnh</a></span>
                            <input id="thumbnail_thumb" class="form-control" type="hidden" name="rec_thumb">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.0/tinymce.min.js"
            integrity="sha512-e6EdqJ92oqMqtStGx+mkt4+HrtuyC1Y3FFoq8fHgh6kwWoI1Jz62esALsobk27iRI9tv3U0KkUnCAfJgi6HpZw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        initTinyMce()

        function initTinyMce() {
            var editor_config = {
                path_absolute: "/",
                selector: "textarea.my-editor__",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                height: 600,
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist forecolor outdent indent | link image media",
                relative_urls: false,
                file_browser_callback: function (field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }
                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no"
                    });
                }
            };

            tinymce.init(editor_config)
        }

    </script>
    <script>
        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [','],
            theme: "classic"
        })
    </script>
    <script>
        var url = "{{url('/')}}";
        $('#lfm').filemanager('image');
        $('#lfm_bg').filemanager('image');

        function changePostSlug() {
            let title = $('input[name=rec_title]').val();
            var slug = convertSlug(title);
            var link = url + "/" + slug;
            var desc = $('textarea[name=rec_desc]').val();
            $('input[name=rec_slug]').val(slug);
            $('.box_title').html(title);
            $('.box_slug').html(link);
            $('.box_desc').html(desc)
            $('input[name=rec_seotitle]').val(title);
        }

        function changePostDescp() {
            let desp = $('textarea[name=rec_desc]').val();
            $('textarea[name=rec_seodesc]').val(desp);
        }
    </script>
@endsection
