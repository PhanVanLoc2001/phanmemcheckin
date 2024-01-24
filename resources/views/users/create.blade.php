@extends('layouts.app')
@section('content')
    <!-- general form elements -->
    <div class="container-p-x flex-grow-1 container-p-y">
        {!! Form::open(['route' => 'users.store', 'id' => 'formAccountSettings']) !!}
            @csrf
            <div class="row">
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Thêm người dùng</h5>
                            <small class="text-muted float-end">New</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="post_title">Họ và tên:</label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'firstName', 'autofocus']) !!}
                            </div>
                            <div class="mb-3">
                                <label for="post_title">E-mail:</label>
                                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="mb-3">
                                <label for="post_content">Mật khẩu:</label>
                                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="mb-3">
                                <label for="post_content">Nhập lại mật khẩu:</label>
                                {!! Form::password('confirm-password', ['class' => 'form-control', 'id' => 'confirm-password']) !!}
                                <span class="text-danger">{{ $errors->first('confirm-password') }}</span>
                            </div>
                            <div class="mb-3">
{{--                                <label for="post_content">Vai trò:</label>--}}
{{--                                {!! Form::select('roles[]', $roles,[], array('value' => '{{ old("roles") }}', 'class' => 'form-select','multiple')) !!}--}}
{{--                                {!! Form::select('roles[]', $roles,[], array('value' => '{{ old("roles") }}', ['class' => 'form-control js-example-tokenizer', 'multiple' => 'multiple']) !!}--}}
                                {!! Form::label('roles', 'Vai trò') !!}
                                {!! Form::select('roles[]', $roles,[], array('value' => '{{ old("roles") }}', 'class' => 'form-control js-example-tokenizer','multiple')) !!}                                <span class="text-danger">{{ $errors->first('roles') }}</span>
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
                                <button id="create-user" class="btn btn-primary me-2">Thêm</button>
                                <button type="reset" class="btn btn-outline-secondary"><a href="{{route('users.index')}}">Hủy</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    <script src="{{url('/assets/js/sweetalert2-user.js')}}"></script>
    <script>
        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [','],
            theme: "classic"
        })
    </script>
@endsection
