@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <form action="{{ route('menus.process_menu', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thiết lập</h5>
                        <textarea id="w3review" name="data" rows="4" cols="50" hidden></textarea>
                        <input type="text" hidden name="menu_id" value="{{ $menu->id }}">
                        <small class="text-muted float-end">setting</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col mb-3">
                                {!! Form::label('name', 'Tên menu:') !!}
                                {!! Form::text('name_menu', old('name', $menu->name), [
                                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                    'placeholder' => 'Vui lòng nhập tiêu đề...',
                                    'disabled',
                                ]) !!}
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="col mb-3">
                                {!! Form::label('position', 'Vị trí:') !!}
                                {!! Form::select(
                                    'position',
                                    [
                                        '0' => 'Vị trí',
                                        'header-left' => 'header-left',
                                        'header-top' => 'header-top',
                                        'header-center' => 'header-center',
                                        'header-right' => 'header-right',
                                        'footer-left' => 'footer-left',
                                        'footer-right' => 'footer-right',
                                        'footer-top' => 'footer-top',
                                        'footer-bottom' => 'footer-bottom',
                                        'footer-center' => 'footer-center',
                                        'sidebar-left' => 'sidebar-left',
                                        'sidebar-right' => 'sidebar-right',
                                    ],
                                    $menu->position,
                                    ['class' => 'form-select', 'id' => 'defaultSelect', 'aria-invalid' => 'true', 'disabled' => true],
                                ) !!}
                                <div class="invalid-feedback">
                                    {!! $errors->first('position', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col mb-3 d-flex align-items-end justify-content-between">
                                {{ Form::submit('Lưu lại', ['type' => 'button', 'class' => 'btn btn-secondary']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Thêm menu</h5>
                                <small class="text-muted float-end">add new</small>
                            </div>
                            <div class="card-body">
                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#accordionOne"
                                                aria-expanded="false" aria-controls="accordionOne">
                                                Bài viết
                                            </button>
                                        </h2>
                                        <div id="accordionOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <input type="text" class="form-control mb-3" id="searchInput"
                                                    placeholder="Tìm kiếm bài viết">
                                                @foreach ($posts as $post)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $post->id }}" data-slug="{{ $post->post_slug }}"
                                                            data-item-id="{{ $post->id }}"
                                                            data-table="{{ $post->getTable() }}"
                                                            id="defaultCheck{{ $post->id }}">
                                                        <label class="form-check-label"
                                                            for="defaultCheck{{ $post->id }}"> {{ $post->post_title }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <div class="m-3 float-end">
                                                    <a class="btn btn-primary text-white" type="submit">Thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#accordionTwo"
                                                aria-expanded="false" aria-controls="accordionTwo">
                                                Danh mục bài viết
                                            </button>
                                        </h2>
                                        <div id="accordionTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                {!! showCategoriesindex($category_post, []) !!}
                                                <div class="m-3 float-end">
                                                    <a class="btn btn-primary text-white" type="submit">Thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#accordionThree"
                                                aria-expanded="false" aria-controls="accordionThree">
                                                Trang
                                            </button>
                                        </h2>
                                        <div id="accordionThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample"
                                            style="">
                                            <div class="accordion-body">
                                                @foreach ($pages as $page)
                                                    <div class="form-check">
                                                        <input class="form-check-input" data-slug="{{ $page->page_slug }}"
                                                            data-table="{{ $page->getTable() }}" type="checkbox"
                                                            value="{{ $page->id }}"
                                                            id="defaultCheck{{ $page->id }}">
                                                        <label class="form-check-label"
                                                            for="defaultCheck{{ $page->id }}">
                                                            {{ $page->page_title }}
                                                        </label>
                                                        <input type="hidden" name="slug"
                                                            value="{{ $page->slug }}">
                                                    </div>
                                                @endforeach
                                                <div class="m-3 float-end">
                                                    <a class="btn btn-primary text-white" type="submit">Thêm</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#accordionFour"
                                                aria-expanded="false" aria-controls="accordionFour">
                                                Sản phẩm
                                            </button>
                                        </h2>
                                        <div id="accordionFour" class="accordion-collapse collapse"
                                            aria-labelledby="headingFour" data-bs-parent="#accordionExample"
                                            style="">
                                            <div class="accordion-body">
                                                @foreach ($products as $product)
                                                    {{-- @dd($product) --}}
                                                    <div class="form-check">
                                                        <input class="form-check-input checkbox-input"
                                                            data-slug="{{ $product->prod_slug }}"
                                                            data-table="{{ $product->getTable() }}" type="checkbox"
                                                            value="{{ $product->id }}"
                                                            id="defaultCheck{{ $product->id }}">
                                                        <label class="form-check-label"
                                                            for="defaultCheck{{ $product->id }}">{{ $product->prod_name }}</label>
                                                    </div>
                                                @endforeach
                                                <div class="m-3 float-end">
                                                    <a class="btn btn-primary text-white" type="submit">Thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#accordionFive"
                                                aria-expanded="false" aria-controls="accordionFive">
                                                Danh mục sản phẩm
                                            </button>
                                        </h2>
                                        <div id="accordionFive" class="accordion-collapse collapse"
                                            aria-labelledby="headingFive" data-bs-parent="#accordionExample"
                                            style="">
                                            <div class="accordion-body">
                                                {!! showCategoriesproduct($category_product, []) !!}
                                                <div class="m-3 float-end">
                                                    <a class="btn btn-primary text-white" type="submit">Thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#accordionSix"
                                                aria-expanded="false" aria-controls="accordionSix">
                                                Link
                                            </button>
                                        </h2>
                                        <div id="accordionSix" class="accordion-collapse collapse"
                                            aria-labelledby="headingSix" data-bs-parent="#accordionExample"
                                            style="">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="addInputSlug">Tên</label>
                                                        <input type="text" class="form-control" id="addInputSlug">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-slug">Đường
                                                            dẫn</label>
                                                        <input type="text" class="form-control"
                                                            id="basic-default-slug">
                                                    </div>
                                                    <div class="m-3 float-end">
                                                        <a id="menu-add-link" class="btn btn-primary text-white"
                                                            type="submit">Thêm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Chỉnh sửa và sắp xếp</h5>
                                <small class="text-muted float-end">Edit and Organize</small>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="dd nestable" id="nestable">
                                        <ol class="dd-list">
                                            @foreach ($items as $item)
                                                {!! renderMenuItem($item) !!}
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                                <input type="hidden" class="input_id">
                                <input type="hidden" class="input_table">
                                <input type="hidden" class="input_item_id">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Tiêu đề</label>
                                    <input type="text" id="nameWithTitle" class="form-control" name="name"
                                        value="" />
                                </div>
                                <div class="col mb-3">
                                    <label for="iconWithTitle" class="form-label">Icon</label>
                                    <input type="text" id="iconWithTitle" class="form-control" name="icon" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary save-changes" data-bs-dismiss="modal">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js"
        integrity="sha512-a3kqAaSAbp2ymx5/Kt3+GL+lnJ8lFrh2ax/norvlahyx59Ru/1dOwN1s9pbWEz1fRHbOd/gba80hkXxKPNe6fg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('/assets/js/menu-drag-and-drop.js') }}"></script>
    <script>
        $(document).ready(function() {
            function updateTextarea() {
                let data = $('.dd').nestable('serialize');
                $('textarea[name="data"]').val(JSON.stringify(data)).trigger('input');
            }

            function deleteItem(itemId, ownerTable) {
                const item = $('.dd').find('[data-id="' + itemId + '"][data-table="' + ownerTable + '"]');
                item.remove();
                updateTextarea();
            }
            $(".js-example-tokenizer").select2({
                tags: true,
                tokenSeparators: [','],
                theme: "classic"
            })

            $('.dd').on('change', updateTextarea);
            $(document).ready(function() {
                updateTextarea();

                $('.dd').trigger('change'); // Tự động kích hoạt sự kiện 'change'
            });
            $(document).on('click', '.button-delete', function() {
                const itemId = $(this).data('owner-id');
                const ownerTable = $(this).data('owner-table');
                if (itemId && ownerTable) {
                    deleteItem(itemId, ownerTable);
                }
            });
            $('.save-changes').on('click', function() {
                const newName = $('#nameWithTitle').val();
                const data = JSON.parse($('textarea[name="data"]').val());
                const id = $('.input_id').val();
                const table = $('.input_table').val();
                console.log(table);

                if (data && data.length > 0) {
                    let updated = false;

                    const updateItem = (items) => {
                        for (let i = 0; i < items.length; i++) {
                            const item = items[i];
                            // console.log(item);
                            if (item.id === parseInt(id) && item.table === table) {
                                item.name = newName;
                                updated = true;
                                break;
                            }
                            if (item.children && item.children.length > 0) {
                                updateItem(item.children);
                                if (updated) {
                                    break;
                                }
                            }
                        }
                    };

                    updateItem(data);

                    if (updated) {
                        $('textarea[name="data"]').val(JSON.stringify(data));
                    }
                }

                $('#modalCenter').modal('hide');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#searchInput").on("input", function() {
                var searchValue = $(this).val()
                    .toLowerCase(); // Lấy giá trị tìm kiếm và chuyển thành chữ thường

                $(".form-check-input").each(function() {
                    var postTitle = $(this).next().text()
                        .toLowerCase();
                    var parentDiv = $(this).closest(".form-check");

                    if (postTitle.includes(searchValue)) {
                        parentDiv
                            .show();
                    } else {
                        parentDiv
                            .hide();
                    }
                });
            });
        });
    </script>
@endsection
