@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="button_create mb-2">
            <a href="{{ route('products.create') }}"><button type="submit" class="btn btn-primary me-2">Thêm</button></a>
        </div>
        <div class="card ">
            <input type="hidden" name="cate_type" value="1">
            <h5 class="card-header">Quản lý sản phẩm</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ảnh bài viết</th>
                            <th>Tiêu đề</th>
                            <th>Tác giả</th>
                            <th>Trạng thái</th>
                            <th>Giá tiền</th>
                            <th>Thời gian tạo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><img src="{{ $product->prod_thumb ? url($product->prod_thumb) : url('assets/img/default.jpg') }}"
                                        alt="anh" style="max-width: 60px;"> </td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $product->prod_name }}</strong>
                                </td>
                                <td>
                                    @if (isset($product->user->name))
                                        {{ $product->user->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($product->prod_status == 1)
                                        <span class="badge bg-label-success me-1">Đã xuất bản</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">Bản nháp</span>
                                    @endif
                                </td>
                                <td>{{ $product->prod_price }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <a class="btn btn-sm btn-icon bg-label-success"
                                            href="{{ url('san-pham/' . $product->prod_slug) }}">
                                            <i class="bx bx-show-alt"></i>
                                        </a>
                                        <a class="btn btn-sm btn-icon bg-label-info"
                                            href="{{ route('products.edit', $product->id) }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form class="inline-block" style="display: inline-block;width: 100%;"
                                            action="{{ route('products.destroy', $product->id) }}" method="POST"
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
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                        entries
                    </div>
                </div>
                <div class="float-right">
                    {{ $products->links() }}
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
