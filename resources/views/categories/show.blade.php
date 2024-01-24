@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="button_create mb-2">
            <form method="GET" action="{{ route('categories.create') }}">
                <input type="hidden" name="cate_type" value="2">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {{--                    @dd($listCategory) --}}
                        @foreach ($listCategory as $key => $category)
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
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">UnActive</span>
                                    @endif
                                </td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form class="inline-block" style="display: inline-block;width: 100%"
                                                action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                onsubmit="confirmDeleteCategory(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button id="delete-button" type="submit" class="dropdown-item "><i
                                                        class="bx bx-trash me-1"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
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
                        Showing {{ $listCategory->firstItem() }} to {{ $listCategory->lastItem() }}
                        of {{ $listCategory->total() }} entries
                    </div>
                </div>
                <div class="float-right">
                    {{ $listCategory->links() }}
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
