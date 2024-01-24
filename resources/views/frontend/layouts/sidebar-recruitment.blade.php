<div class="sidebar">
    <div class="box_sidebar">

        <div class="support">
            <div class="title">
                <p>Số lượng tuyển dụng:</p>
                <h4>{{$recruitment->rec_quantity}}</h4>

            </div>
            <div class="padding-bottom"></div>
            <div class="wages">
                <p>Mức lương:</p>
                <h4>{{$recruitment->rec_money}}</h4>
                <h6>(chưa bao gồm thưởng hiệu suất công việc, thưởng doanh số, thưởng tháng lương thứ 13, thưởng hiệu suất của năm….)</h6>
            </div>
            <div class="padding-bottom"></div>
            <div class="working-from">
                <p>Hình thức làm việc:</p>
                <h4>{{$recruitment->rec_time}}</h4>
            </div>
            <div class="padding-bottom"></div>
            <div class="work_location">
                <p>Địa điểm làm việc:</p>
                <h4>{{$recruitment->rec_address}}</h4>
            </div>
        </div>
        <div class="support">
<!--            <div class="padding-bottom"></div>-->
            <div class="wages">
                <h6>Liên hệ: 0246 660 9469</h6>
<!--                <div class="padding-bottom"></div>-->
                <h6>Email: tuyendungninjateam@gmail.com</h6>
<!--                <div class="padding-bottom"></div>-->
                <h6>Hoặc nộp hồ sơ trực tiếp qua link dưới đây</h6>
            </div>
<!--            <div class="padding-bottom"></div>-->
            <div class="btn_hso">
                <button type="button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Nộp hồ sơ ứng tuyển
                </button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade set-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content content">
            <div class="modal-header">
                <h5 class="modal-title fs-5 h4" id="staticBackdropLabel">Nộp hồ sơ trực tuyến</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body excerpt-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        {!! Form::label('name', 'Họ và tên *') !!}
                        {!! Form::text('fullname', null, ['id' => 'name', 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col-md-12 form-group">
                        {!! Form::label('apply', 'Vị trí ứng tuyển *') !!}
                        {!! Form::text('apply', null, ['id' => 'apply', 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col-md-12 form-group">
                        {!! Form::label('email', 'Địa chỉ email *') !!}
                        {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        {!! Form::label('phone', 'Số điện thoại *') !!}
                        {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group insert-file">
                        {!! Form::label('your-file', 'Hồ sơ ứng tuyển *') !!}
                        {!! Form::file('your-file', ['id' => 'formFileMultiple', 'class' => 'form-control', 'accept' => '.docx,.pdf', 'required']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        {!! Form::label('link', 'Link hồ sơ') !!}
                        {!! Form::text('link', null, ['id' => 'link', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group pr_btn">
                        {!! Form::submit('Nộp hồ sơ ứng tuyển', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div class="bottom-excerpt-body">
                    <p>Lưu ý:</p>
                    <p>(*) là các trường thông tin bắt buộc.<br>
                        Chỉ cho phép tải lên tệp word, pdf với dung lượng không quá 10Mb.</p>
                </div>
            </div>
        </div>
    </div>
</div>

