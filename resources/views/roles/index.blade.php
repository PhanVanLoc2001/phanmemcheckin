@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="button_create mb-2">
            @can('role-create')
                <a href="{{ route('roles.create') }}"><button type="submit" class="btn btn-primary me-2">Thêm</button></a>
            @endcan
        </div>
        <div class="card ">
            <h5 class="card-header">Quản lý vai trò</h5>
            <div class="table-responsive text-nowrap min-cao">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tên vai trò</th>
                        <th>Ngày tạo</th>
                        <th width="15%">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{++$key}}</td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$role->name}}</strong></td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$role->created_at}}</strong></td>
                            <td>
                                <div class="d-inline-block text-nowrap">
                                        <a class="btn btn-sm btn-icon bg-label-info"
                                            href="{{ route('roles.edit', $role->id) }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form class="inline-block" style="display: inline-block;width: 100%;"
                                            action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                            onsubmit="confirmDeleteRole(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-icon delete-record  bg-label-danger"
                                                type="submit">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-left">
                    <div class="dataTables_info">
                        Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} entries
                    </div>
                </div>
                <div class="float-right">
                    {{ $roles->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{url('/assets/js/sweetalert2-role.js')}}"></script>
    <script>
        $(document).ready(function() {
            const success = {!! json_encode(session('success')) !!};
            if (success) {
                Swal.fire({
                    title: 'Success!',
                    text: success,
                    icon: 'success',
                    confirmButtonText: 'Tuyệt vời !!!'
                });
            }
            // Remove the success message from session flash
            sessionStorage.removeItem('success');
        });
    </script>
@endsection
