    @extends('layouts.app')
    @section('content')
        <div class="container-p-x flex-grow-1 container-p-y">
            <div class="card ">
                <h5 class="card-header">Bảng tin liên hệ</h5>
                <div class="table-responsive text-nowrap min-cao">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tên </th>
                            <th>Số điện thoại</th>
                            <th>Nội dung</th>
                            <th>Thời gian tạo</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach ($contacts as $key => $contact)
                            <tr>
                                <td>{{++$key}}</td>
                                <td><strong>{{$contact->contact_title}}</strong></td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$contact->contact_phone}}</strong></td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$contact->contact_content}}</strong></td>
                                <td>{{$contact->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--                {{ $posts->onEachSide(5)->links() }}--}}
                </div>
                <div class="card-footer clearfix">
                    <div class="float-left">
                        <div class="dataTables_info">
                            Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }} entries
                        </div>
                    </div>
                    <div class="float-right">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
            <script>

            </script>
        </div>
    @endsection
