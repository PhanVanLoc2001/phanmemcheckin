@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="button_create mb-2">
            <a href="{{ route('pages.create') }}"><button type="submit" class="btn btn-primary me-2">Thêm</button></a>
        </div>
        <div class="card ">
            <h5 class="card-header">Quản lý bài viêt</h5>
            <div class="table-responsive text-nowrap min-cao">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ảnh Trang</th>
                            <th>Tiêu đề</th>
                            <th>Trạng thái</th>
                            <th>Thời gian tạo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($pages as $key => $page)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><img src="@if ($page->page_thumb) {{ $page->page_thumb }} @else {{ url('assets/img/default.jpg') }} @endif"
                                        alt="anh" style="width: 140px;"> </td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $page->page_title }}</strong>
                                </td>
                                <td>
                                    @if ($page->page_status == 1)
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">UnActive</span>
                                    @endif
                                </td>
                                <td>{{ $page->created_at }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <a class="btn btn-sm btn-icon bg-label-success" href="{{ url($page->page_slug) }}">
                                            <i class="bx bx-show-alt"></i>
                                        </a>
                                        <a class="btn btn-sm btn-icon bg-label-info"
                                            href="{{ route('pages.edit', $page->id) }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form class="inline-block" style="display: inline-block;width: 100%;"
                                            action="{{ route('pages.destroy', $page->id) }}" method="POST"
                                            onsubmit="confirmDeletePost(event)">
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
                {{--                {{ $posts->onEachSide(5)->links() }} --}}
            </div>
            <div class="card-footer clearfix">
                <div class="float-left">
                    <div class="dataTables_info">
                        Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} entries
                    </div>
                </div>
                <div class="float-right">
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
        <script></script>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('/assets/js/sweetalert2-post.js') }}"></script>
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
