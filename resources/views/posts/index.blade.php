@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="button_create mb-2">
            <a href="{{ route('posts.create') }}"><button type="submit" class="btn btn-primary me-2">Thêm</button></a>
        </div>
        <div class="card ">
            <h5 class="card-header">Quản lý bài viêt</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Ảnh</th>
                            <th style="width: 20%;">Tiêu đề</th>
                            <th style="width: 15%;">Tác giả</th>
                            <th style="width: 15%;">Trạng thái</th>
                            <th style="width: 20%;">Thời gian tạo</th>
                            <th style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach (isset($post_search) ? $post_search : $posts as $key => $post)
                            <tr>
                                <td><img src="{{ $post->post_thumb ? url($post->post_thumb) : url('assets/img/default.jpg') }}"
                                        alt="anh" width="100px"></td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{!! Str::limit($post->post_title, 40) !!}</strong>
                                </td>
                                <td>
                                    @if (isset($post->user->name))
                                        {{ $post->user->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($post->post_status == 1)
                                        <span class="badge bg-label-success me-1">Đã xuất bản</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">Bản nháp</span>
                                    @endif
                                </td>
                                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <a class="btn btn-sm btn-icon bg-label-success" href="{{ url($post->post_slug) }}"
                                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                            data-bs-html="true"
                                            data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Xem</span>">
                                            <i class="bx bx-show-alt"></i>
                                        </a>
                                        <a class="btn btn-sm btn-icon bg-label-info"
                                            href="{{ route('posts.edit', $post->id) }}" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                            data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Sửa bài viết</span>">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form class="inline-block" style="display: inline-block;width: 100%;"
                                            action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            onsubmit="confirmDeletePost(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-icon delete-record  bg-label-danger"
                                                type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                data-bs-placement="top" data-bs-html="true"
                                                data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Xóa bài viết</span>">
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
                @if (isset($post_search))
                    <div class="float-left">
                        <div class="dataTables_info">
                            Showing {{ $post_search->firstItem() }} to {{ $post_search->lastItem() }} of
                            {{ $post_search->total() }} entries
                        </div>
                    </div>
                    <div class="float-right">
                        {{ $post_search->links() }}
                    </div>
                @else
                    <div class="float-left">
                        <div class="dataTables_info">
                            Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }}
                            entries
                        </div>
                    </div>
                    <div class="float-right">
                        {{ $posts->links() }}
                    </div>
                @endif
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
