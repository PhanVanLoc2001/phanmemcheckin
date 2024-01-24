@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Sửa Danh mục</h5>
                            <small class="text-muted float-end">Add New Category</small>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Tên Danh Mục</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-name" name="cate_title"
                                            placeholder="" value="{{ old('cate_title', $category->cate_title) }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Đường dẫn</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-company"
                                            name="cate_slug" placeholder=""
                                            value="{{ old('cate_slug', $category->cate_slug) }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Danh mục cha</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="exampleFormControlSelect1"
                                            aria-label="Default select example" name="cate_parent">
                                            <option value="0">-- Chọn danh mục --</option>
                                            {!! showCategories($cateParent, $category->cate_parent) !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">Mô tả</label>
                                    <div class="col-sm-10">
                                        <textarea id="basic-default-message" class="form-control" rows="6" name="cate_desc"
                                            aria-describedby="basic-icon-default-message2">{{ old('cate_desc', $category->cate_desc) }}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Basic with Icons -->
                <div class="col-xxl-4">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Đăng</h5>
                            <small class="text-muted float-end">blog</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="created_at">Ngày đăng:</label>
                                <input type="text" class="form-control flatpickr" id="created_at" name="created_at"
                                    value="{{ old('created_at') ? old('created_at') : date('Y-m-d H:i:s') }}">
                            </div>
                            <div class="mb-3">
                                <label for="cate_status">Trạng thái<span class="required">*</span></label>
                                <select id="cate_status" name="cate_status" class="form-select">
                                    <option value="1"
                                        {{ old('cate_status', $category->cate_status) == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0"
                                        {{ old('cate_status', $category->cate_status) == 0 ? 'selected' : '' }}>Draft
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                {!! Form::select(
                                    'cate_template',
                                    $category->cate_type == 1
                                        ? ['postCate' => 'Chọn giao diện']
                                        : ['postProduct' => 'Chọn giao diện'] + array_combine($arrayTheme, $arrayTheme),
                                    old('cate_template', $category->cate_template),
                                    ['class' => 'form-select', 'id' => 'selectTemplate', 'aria-label' => 'Default select example'],
                                ) !!}
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
