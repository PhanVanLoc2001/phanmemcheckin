@extends('layouts.app')

@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">Edit Permission</h2>
                <div class="card-tools">
                    <a class="btn btn-success" href="{{ route('users.index') }}"><i
                            class="fas fa-angle-double-left"></i> Back To User List</a>
                </div>
            </div>
    <div class="card ">
        {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update_permissions', $user->id]]) !!}
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
                        <label for="inputName" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="inputPermission" class="col-md-2 col-form-label">Permission</label>
                        <div class="col-md-10">

                            <div class="row">
                                @foreach($parents as $parent)
                                    <div class="col-4">
                                        <div class="parent">
                                            <input type="checkbox" id="check-{{ $parent->id }}" class="parent-checkbox">
                                            <label for="check-{{ $parent->id }}">{{ $parent->show_name }}</label>
                                        </div>
                                        <ul>
                                            @foreach($permissions as $permission_0)
                                                @if($permission_0->parents == $parent->id)
                                                    <li style="list-style-type: none">
                                                        {{ Form::checkbox('permissions[]', $permission_0->id, in_array($permission_0->id, $userPermissions) ? true : false, array('id' => 'check-' . $permission_0->id, 'class' => 'child-checkbox parent-' . $parent->id)) }}
                                                        <label for="check-{{ $permission_0->id }}">{{ $permission_0->show_name }}</label>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
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

                    // Khởi tạo trạng thái ban đầu của các checkbox
                    @foreach($parents as $parent)
                    var parentCheckboxes = $('.parent-{{$parent->id}}');
                    var isAllChecked = parentCheckboxes.filter(':checked').length === parentCheckboxes.length;
                    $('#check-{{$parent->id}}').prop('checked', isAllChecked);
                    @endforeach
                });
            </script>
@endsection
