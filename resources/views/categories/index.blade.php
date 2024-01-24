@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="button_create mb-2">
            <form method="GET" action="{{ route('categories.create') }}">
                <input type="hidden" name="cate_type" value="1">
                <button type="submit" class="btn btn-primary me-2" name="add_button">Thêm</button>
            </form>
        </div>
        <div class="card ">
            <h5 class="card-header">Quản lý danh mục</h5>
            <div class="table-responsive text-nowrap min-cao">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Parent</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $category->cate_title }}</strong>
                                </td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ Str::limit($category->cate_desc, 30) }}</strong>
                                </td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>
                                        @if ($category->parent)
                                            {{ $category->parent->cate_title }}
                                        @else
                                        @endif
                                    </strong></td>
                                <td>
                                    @if ($category->cate_status == 1)
                                        <span class="badge bg-label-success me-1">Xuất bản</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">Nháp</span>
                                    @endif
                                </td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <a class="btn btn-sm btn-icon bg-label-success"
                                            href="{{ url($category->cate_slug) }}" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                            data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Xem</span>">
                                            <i class="bx bx-show-alt"></i>
                                        </a>
                                        <a class="btn btn-sm btn-icon bg-label-info"
                                            href="{{ route('categories.edit', $category->id) }}" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                            data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Sửa danh mục</span>">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form class="inline-block" style="display: inline-block;width: 100%;"
                                            action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            onsubmit="confirmDeleteCategory(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-icon delete-record  bg-label-danger"
                                                type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                data-bs-placement="top" data-bs-html="true"
                                                data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Xóa danh mục</span>">
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
                        Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of
                        {{ $categories->total() }} entries
                    </div>
                </div>
                <div class="float-right">
                    {{ $categories->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('/assets/js/sweetalert2-category.js') }}"></script>
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
