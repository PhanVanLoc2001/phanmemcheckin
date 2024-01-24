@extends('layouts.app')
@section('content')
    <!-- general form elements -->
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="card ">
            <div class="card-header">
                <h5 class="card-header">Tạo vai trò</h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card ">
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
            <div class="card-body">
                <div class="tab-pane" id="settings">
                    <div class="form-horizontal">
                        <div class="form-group">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-2 col-form-label">Vai trò</label>
                            <div class="col-md-10">
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="inputPermission" class="col-md-2 col-form-label">Quyền</label>
                            <div class="col-md-10">

                                <div class="row">
                                    @foreach($parents as $parent)
                                        <div class="col-4">
                                            <div class="form-check form-switch mb-2">
                                                <input type="checkbox" id="check-{{ $parent->id }}" class="form-check-input parent-checkbox">
                                                <label for="check-{{ $parent->id }}">{{ $parent->show_name }}</label>
                                            </div>
                                            <ul>
                                                @foreach($permission as $permission_0)
                                                    @if($permission_0->parents == $parent->id)
                                                        <li style="list-style-type: none">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input child-checkbox parent-{{ $parent->id }}" type="checkbox" id="check-{{ $permission_0->id }}" name="permission[]" value="{{ $permission_0->id }}">
                                                                <label class="form-check-label" for="check-{{ $permission_0->id }}">{{ $permission_0->show_name }}</label>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.tab-pane -->

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tạo</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Quay lại</a>

            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('scripts')
            <script>
                $(document).ready(function() {
                    $('.parent-checkbox').click(function() {
                        var isChecked = $(this).prop('checked');
                        $(this).closest('.col-4').find('.child-checkbox').prop('checked', isChecked);
                    });

                    $('.child-checkbox').click(function() {
                        var parentCheckbox = $(this).closest('.col-4').find('.parent-checkbox');
                        var childCheckboxes = $(this).closest('.col-4').find('.child-checkbox');
                        var isAllChecked = childCheckboxes.filter(':checked').length === childCheckboxes.length;
                        parentCheckbox.prop('checked', isAllChecked);
                    });
                });
            </script>
@endsection
