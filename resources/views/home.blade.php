@extends('layouts.app')

@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4 ">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="avatar-lg flex-shrink-0 me-3">
                                <div class="badge badge-demo bg-label-primary p-3 rounded mb-3">
                                    <i class="bx bx-layout fs-3"></i>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h4 class="mb-0">Bài viết</h4>
                                    <small class="text-muted">Tổng số bài viết</small>
                                </div>
                                <div class="user-progress">
                                    <h2 class="fw-semibold m-auto">{{ $count_post }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl">
                <div class="card mb-4 ">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="avatar-lg flex-shrink-0 me-3">
                                <div class="badge bg-label-info p-3 rounded mb-3">
                                    <i class='bx bx-box fs-3'></i>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h4 class="mb-0">Sản phẩm</h4>
                                    <small class="text-muted">Tổng số sản phẩm</small>
                                </div>
                                <div class="user-progress">
                                    <h2 class="fw-semibold m-auto">{{ $count_product }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl">
                <div class="card mb-4 ">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="avatar-lg flex-shrink-0 me-3">
                                <div class="badge bg-label-success p-3 rounded mb-3">
                                    <i class='bx bx-user fs-3'></i>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h4 class="mb-0">Tài khoản</h4>
                                    <small class="text-muted">Tổng số tài khoản</small>
                                </div>
                                <div class="user-progress">
                                    <h2 class="fw-semibold m-auto">{{ $count_user }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4 ">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Bài viết</h5>
                        <small class="text-muted float-end">Latest</small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Tác giả</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td><a href="{{ $post->post_slug }}"><img
                                                        src="{{ $post->post_thumb ? url($post->post_thumb) : url('assets/img/default.jpg') }}"
                                                        alt="anh" width="80px"></a></td>
                                            <td><a href="{{ $post->post_slug }}">{{ $post->post_title }}</a></td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{--                {{ $posts->onEachSide(5)->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4 ">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Liên hệ</h5>
                        <small class="text-muted float-end">Contact</small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($contacts as $key => $contact)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $contact->contact_title }}</td>
                                            <td>{{ $contact->contact_phone }}</td>
                                            <td>{{ $contact->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{--                {{ $posts->onEachSide(5)->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
