<form method="get" id="searchform" role="search" action="">
    <!-- Các trường input ẩn -->
    <div class="container">
        <div class="row">
            <div class="col-sm">
                {!! Form::select('rec_department', ['' => 'Chọn phòng ban', 'Phòng Dev' => 'Phòng Dev', 'Phòng HCNS' => 'Phòng HCNS', 'Phòng kinh doanh' => 'Phòng kinh doanh', 'Phòng Marketing' => 'Phòng Marketing', 'Phòng Support' => 'Phòng Support'], null, ['class' => 'form-select', 'aria-label' => 'Default select example']) !!}
            </div>
            <div class="col-sm">
                {!! Form::select('rec_time', ['' => 'Chọn văn phòng', 'Văn phòng Hà Nội' => 'Văn phòng Hà Nội','Văn phòng Hồ Chí Minh'=>'Văn phòng Hồ Chí Minh'], null, ['class' => 'form-select', 'aria-label' => 'Default select example']) !!}
            </div>
            <div class="col-sm">
                {!! Form::select('rec_time', [''=>'Chọn ca','Toàn thời gian' => 'Toàn thời gian', 'Theo ca' => 'Theo ca'], null, ['class' => 'form-select','aria-label' => 'Default select example']) !!}
            </div>
            <div class="col-sm-1 pr_btn1" type="submit" id="searchsubmit">
                <button type="submit">Tìm</button>
            </div>
        </div>
    </div>
</form>
