@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        {!! Form::open(['route' => 'categories.store']) !!}
            @csrf
        <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <div class="col-xxl-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Thêm Danh mục</h5>
                            <small class="text-muted float-end">Add New Category</small>
                        </div>
                        <div class="card-body">
                            @if($cate_type == "2")
                                <input type="hidden" name="cate_type" value="{{$cate_type}}">
                            @else
                                <input type="hidden" name="cate_type" value="1">
                            @endif

                            <div class="row mb-3">
                                {!! Form::label('cate_title', 'Tên Danh Mục', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('cate_title', null, ['class' => 'form-control', 'placeholder' => '','onkeyup' => 'changePostSlug()']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                {!! Form::label('cate_slug', 'Đường dẫn', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('cate_slug', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                {!! Form::label('cate_parent', 'Danh mục cha', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="cate_parent">
                                        <option value="0">-- Chọn danh mục --</option>
                                        {!! showCategories($categories) !!}
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                {!! Form::label('cate_desc', 'Mô tả', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('cate_desc', null, ['class' => 'form-control', 'rows' => '6', 'aria-describedby' => 'basic-icon-default-message2']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Đăng</h5>
                            <small class="text-muted float-end">New</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                {!! Form::label('created_at', 'Ngày đăng:') !!}
                                {!! Form::text('created_at', old('created_at') ? old('created_at') : date('Y-m-d H:i:s'), ['class' => 'form-control flatpickr', 'required']) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('cate_status', 'Trạng thái') !!}
                                {!! Form::select('cate_status', ['1' => 'Active', '0' => 'Draft'], '1', ['class' => 'form-select', 'required']) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('cate_template', 'Giao diện', ['class' => 'form-label']) !!}
                                @php
                                    $templateOptions = ($cate_type=== '2')? ['productCate' => 'Chọn giao diện']: ['postCate' => 'Chọn giao diện'];
                                @endphp
                                {!! Form::select('cate_template', $templateOptions + array_combine($arrayTheme, $arrayTheme), old('page_templates'), ['class' => 'form-select', 'id' => 'selectTemplate', 'aria-label' => 'Default select example']) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::submit('Tạo', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Quay lại</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection
@section('scripts')
    <script>
        function changePostSlug() {
            let title = $('input[name=cate_title]').val();
            var slug = convertSlug(title);
            $('input[name=cate_slug]').val(slug);
        }
    </script>
@endsection
