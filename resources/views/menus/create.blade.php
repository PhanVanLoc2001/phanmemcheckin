@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        {!! Form::open(['route' => 'menus.store', 'method' => 'POST', 'class' => 'form-floating']) !!}
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thêm Menu</h5>
                        <small class="text-muted float-end">New</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            {!! Form::label('name', 'Tên menu:') !!}
                            {!! Form::text('name', old('name'), [
                                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                'placeholder' => 'Vui lòng nhập tiêu đề...',
                            ]) !!}
                            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::label('position', 'Vị trí:') !!}
                            {!! Form::select(
                                'position',
                                [
                                    '' => 'Vị trí',
                                    'header-left' => 'header-left',
                                    'header-top' => 'header-top',
                                    'header-center' => 'header-center',
                                    'header-right' => 'header-right',
                                    'footer-left' => 'footer-left',
                                    'footer-right' => 'footer-right',
                                    'footer-top' => 'footer-top',
                                    'footer-bottom' => 'footer-bottom',
                                    'footer-center' => 'footer-center',
                                    'sidebar-left' => 'sidebar-left',
                                    'sidebar-right' => 'sidebar-right',
                                    'content-center' => 'content-center',
                                ],
                                null,
                                ['class' => 'form-select', 'id' => 'defaultSelect', 'aria-invalid' => 'true'],
                            ) !!}
                            <div class="invalid-feedback">
                                {!! $errors->first('position', '<span class="text-danger">:message</span>') !!}
                            </div>
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
                            {!! Form::label('status', 'Trạng thái') !!}
                            {!! Form::select('status', ['1' => 'Active', '0' => 'Draft'], old('status'), [
                                'class' => 'form-select' . ($errors->has('status') ? ' is-invalid' : ''),
                                'required',
                            ]) !!}
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
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
