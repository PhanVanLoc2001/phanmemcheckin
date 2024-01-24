@extends('layouts.app')
@section('content')
    <div class="container-p-x flex-grow-1 container-p-y">
        <form action="{{ route('settings.update', ['setting' => 1]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Sửa thông tin</h5>
                            <small class="text-muted float-end">Edit</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                {!! Form::label('phone_number', 'Số điện thoại:') !!}
                                {!! Form::text('phone_number', old('phone_number', $contact->phone_number), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Vui lòng nhập số điện thoại...',
                                ]) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('phone_link', 'Link số điện thoại:') !!}
                                {!! Form::text('phone_link', old('phone_link', $contact->phone_link), [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                ]) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('facebook_link', 'Link facebook:') !!}
                                {!! Form::text('facebook_link', old('facebook_link', $contact->facebook_link), [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                ]) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('code_header', 'Link Header:') !!}
                                {!! Form::textarea('code_header', old('zalo_link', $contact->code_header), [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Sửa thông tin</h5>
                            <small class="text-muted float-end">Edit</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                {!! Form::label('tiktok_link', 'Link tiktok:') !!}
                                {!! Form::text('tiktok_link', old('tiktok_link', $contact->tiktok_link), [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('zalo_link', 'Link zalo:') !!}
                                {!! Form::text('zalo_link', old('zalo_link', $contact->zalo_link), [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('youtube_link', 'Link youtube:') !!}
                                {!! Form::text('youtube_link', old('youtube_link', $contact->youtube_link), [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                ]) !!}
                            </div>
                            <div class="mb-3">
                                {!! Form::label('code_footer', 'Link Script:') !!}
                                {!! Form::textarea('code_footer', old('code_footer', $contact->code_footer), [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Đăng</h5>
                            <small class="text-muted float-end">Đăng</small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                {!! Form::label('created_at', 'Ngày đăng:', ['class' => 'col-form-label']) !!}
                                <div class="">
                                    {!! Form::input('datetime-local', 'created_at', old('created_at') ? old('created_at') : date('Y-m-d H:i:s'), [
                                        'class' => 'form-control',
                                        'id' => 'html5-datetime-local-input',
                                    ]) !!}
                                </div>
                            </div>
                            {!! Form::submit('Sửa', ['class' => 'btn btn-primary btn_upload']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ảnh banner trang chính</h5>
                        <small class="text-muted float-end">Number</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 border border-1 p-3">
                            <div class="card">
                                <div class="card-body">
                                    <div id="images-banner">
                                        @if (json_decode($contact->banner) !== null && count(json_decode($contact->banner, true)))
                                            @foreach (json_decode($contact->banner, true) as $image)
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="image">
                                                            <img src="{{ $image['image'] }}" alt="ảnh đại diện">
                                                            <p>{{ $image['image'] }}</p>
                                                            <input class="form-control" type="hidden" name="banner[]"
                                                                value="{{ $image['image'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 d-flex flex-column justify-content-center">
                                                        <label>Link Banner:</label>
                                                        <input class="form-control" name="banner[]" type="text"
                                                            value="{{ $image['value'] }}">
                                                    </div>
                                                    <div class="col d-flex align-items-center">
                                                        <button class="btn btn-danger delete-image">-</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            Chưa có ảnh được chọn.
                                        @endif

                                    </div>
                                    <div id="btn-banner" class="btn btn-primary" style="opacity:0.2;cursor:default">
                                        Chọn ảnh
                                    </div>
                                    <div id="loading-banner" style="font-size:12px">Loading file manager...</div>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            {!! Form::label('list_phone', 'Danh sách số điện thoại:') !!}
                            {!! Form::textarea('list_phone', old('list_phone', $contact->list_phone), [
                                'class' => 'form-control',
                                'rows' => '10',
                                'id' => 'editor',
                            ]) !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::label('contact_single', 'Thông tin liên lạc:') !!}
                            {!! Form::textarea('contact_single', old('contact_single', $contact->contact_single), [
                                'class' => 'form-control',
                                'rows' => '10',
                                'id' => 'editor',
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="module" src="{{ url('/assets/js/filemanager-contact-more.js') }}"></script>
    <script>
        $(document).on('click', '.delete-image', function() {
            var confirmation = confirm("Bạn có chắc chắn muốn xóa ảnh này?");
            if (confirmation) {
                $(this).closest('.row').remove();
            }
        });
    </script>
@endsection
