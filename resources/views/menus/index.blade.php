@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="button_create mb-2">
            <a href="{{ route('menus.create') }}"><button type="submit" class="btn btn-primary me-2">Thêm</button></a>
        </div>
        <div class="card ">
            <h5 class="card-header">Quản lý Menu</h5>
            <div class="table-responsive text-nowrap min-cao">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tên menu</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Thời gian tạo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($menus as $key => $menu)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $menu->name }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $menu->position }}</strong>
                                </td>
                                <td>
                                    @if ($menu->status == 1)
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">UnActive</span>
                                    @endif
                                </td>
                                <td>{{ $menu->created_at }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <a class="btn btn-sm btn-icon bg-label-success"
                                            href="{{ route('menus.setting', $menu->id) }}" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                            data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Sửa menu kéo thả</span>">
                                            <i class='bx bx-calendar-edit'></i>
                                        </a>
                                        <a class="btn btn-sm btn-icon bg-label-info"
                                            href="{{ route('menus.edit', $menu->id) }}" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                            data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Sửa menu</span>">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form class="inline-block" style="display: inline-block;width: 100%;"
                                            action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                            onsubmit="confirmDeletePost(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-icon delete-record  bg-label-danger"
                                                type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                data-bs-placement="top" data-bs-html="true"
                                                data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Xóa menu</span>">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>

                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--                {{ $posts->onEachSide(5)->links() }} --}}
            </div>
            <div class="card-footer clearfix">
                <div class="float-left">
                    <div class="dataTables_info">
                        Showing {{ $menus->firstItem() }} to {{ $menus->lastItem() }} of {{ $menus->total() }} entries
                    </div>
                </div>
                <div class="float-right">
                    {{ $menus->links() }}
                </div>
            </div>
        </div>
        <script></script>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('/assets/js/sweetalert2-post.js') }}"></script>
    <script>
        // Lấy tất cả các phần tử <img> trong tài liệu
        var images = document.getElementsByTagName('img');

        // Duyệt qua từng phần tử <img>
        for (var i = 0; i < images.length; i++) {
            var image = images[i];

            // Kiểm tra xem thuộc tính alt có rỗng hay không
            if (!image.alt) {
                image.alt = 'image-alt'; // Thiết lập giá trị 'image-alt' cho thuộc tính alt
            }
        }
    </script>
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
