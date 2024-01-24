@extends('layouts.app')

@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="button_create mb-2">
            <button type="button" id="addTagBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                Thêm Tag
            </button>
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="addTagForm" action="{{ route('tags.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Thêm tag mới</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="addTagErrorMsg" class="alert alert-danger" style="display:none;"></div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Tên tag</label>
                                        <input type="text" class="form-control" id="tag_name" name="tag_name" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Tên tag</label>
                                        <input type="text" class="form-control" id="tag_slug" name="tag_slug" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div class="modal fade" id="editTagModal" tabindex="-1" aria-labelledby="editTagModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTagModalLabel">Sửa Tag</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Tag</label>
                                    <input type="text" class="form-control" id="tag_name" name="tag_name">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Tag</label>
                                    <input type="text" class="form-control" id="tag_slug" name="tag_slug">
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="card">
            <h5 class="card-header">Quản lý Tags</h5>
            <div class="table-responsive text-nowrap min-cao">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tên tag</th>
                            <th>Ngày tạo</th>
                            <th width="20%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($tags as $key => $tag)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $tag->tag_name }}</td>
                                <td>{{ $tag->created_at }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <form class="inline-block" style="display: inline-block;width: 100%;"
                                            action="{{ route('tags.destroy', ['tag' => $tag->id]) }}" method="POST"
                                            onsubmit="confirmDeleteTag(event)">
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
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('/assets/js/sweetalert2-tag.js') }}"></script>
    {{-- <script>
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
            sessionStorage.removeItem('success');
        });
    </script> --}}
@endsection
