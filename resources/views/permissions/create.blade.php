@extends('layouts.app')
@section('content')
    <!-- general form elements -->
    <div class="container-p-x flex-grow-1 container-p-y">
        {!! Form::open(['route' => 'permissions.store', 'id' => 'formAccountSettings']) !!}@csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thêm quyền</h5>
                        <small class="text-muted float-end">New</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="post_title">Tên hiển thị:</label>
                            {!! Form::text('show_name', null, ['class' => 'form-control','id'=>'show_name-input', 'autofocus']) !!}
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="post_title">Đường dẫn:</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name-input', 'autofocus']) !!}
                        </div>
                        <div class="mb-3">
                            <label for="parents" class="form-label">Parent</label>
                            <select id="defaultSelect" class="form-select" name="parents">
                                <option value="0">---Select Permission---</option>
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->show_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Action</h5>
                        <small class="text-muted float-end">action</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="post_date">Ngày tạo:</label>
                            <input type="text" class="form-control flatpickr" id="post_date" name="user_date"
                                   value="{{ old('user_date') ? old('user_date') : date('Y-m-d H:i:s') }}" required>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary me-2">Thêm</button>
                            <button type="reset" class="btn btn-outline-secondary"><a href="{{route('permissions.index')}}">Cancel</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection


