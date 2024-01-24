@extends('frontend.layouts.app')
@section('title'){{$page->page_title}}@endsection
@section('meta-desc'){{$page->page_seodesc}}@endsection
@section('meta-title'){{$page->page_title}}@endsection
@section('content')
    <section class="detail_page template_withoutsidebar">
        <div class="banner_news">
            <div class="container container_withoutsidebar">
                <img src="{{url('/assets/img/banner-thanh-toan.png')}}" alt="thanh-toan">
            </div>
        </div>
        <div class="padding"></div>
        <div class="container">
            <div class="detail_news-content ">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 box_content">
                        <div class="title_pay">
                            <img class="pay" src="{{url('/assets/img/thanh_toan.png')}}" alt="">
                            <h2>Thanh toán bản quyền phần mềm</h2>
                        </div>
                        <div class="padding-bottom"></div>
                        <div class="text_pay">
                            Để mua được bản quyền phần mềm cũng như để đảm bảo quyền lợi của khách hàng, quý khách hàng
                            có nhu cầu mua bản quyền phần mềm do chúng tôi cung cấp vui lòng thực hiện theo quy trình
                            sau:
                            <ul>
                                <li><strong><span style="color: #ff9201; font-weight: bold;">Thanh toán tiền mặt:</span></strong>
                                    Nếu Quý khách ở Hà Nội chúng tôi sẽ đưa người đến tận nơi lắp đặt và hướng dẫn. Sau
                                    khi cài đặt xong, Quý khách vui lòng thanh toán cho nhân viên cài đặt.
                                </li>
                                <li><strong><span
                                            style="color: #ff9201; font-weight: bold;">Thanh toán chuyển khoản:</span></strong>
                                    Nếu Quý khách ở tỉnh thành khác, vui lòng thanh toán qua tài khoản Ngân hàng theo
                                    hình thức chuyển khoản. chúng tôi có tài khoản của tất cả các Ngân hàng lớn tại Việt
                                    Nam như: Vietcombank, Techcombank, Á Châu (ACB), ví momo
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <img src="2023/04/image-5.png"
                                         alt="bank-1">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <img src="2023/04/image-6.png"
                                         alt="bank-2">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <img src="2023/04/image-7.png"
                                         alt="bank-3">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <img src="2023/04/image-8.png"
                                         alt="bank-4">
                                </div>
                            </div>


                            &nbsp;
                            <p style="text-align: center;">Trong phần ghi chú nội dung chuyển tiền, bạn ghi rõ: <strong><span
                                        style="color: #ff9201; font-weight: bold;">Họ tên – SĐT – Email Mua phần mềm</span></strong>
                            </p>
                            <img class="m-auto" src="2023/04/Group-529.png"
                                 alt="" width="672" height="47"/>
                            <p style="text-align: center;"><strong><span style="color: #ff9201; font-weight: bold;">Thanh toán quốc tế:</span>
                                </strong>  Nếu Quý khách ở nước ngoài, có thể thanh toán cho chúng tôi thông qua các thẻ
                                Visa.</p>
                        </div>
                        <div class="padding"></div>
                        <div class="title_pay">
                            <img class="pay" src="{{url('/assets/img/thanh_toan_1.png')}}" alt="anh">
                            <h2>Thông tin bảo hành</h2>
                        </div>
                        <div class="padding-bottom"></div>
                        <div class="text_pay">
                            <div class="padding_pay">
                                <ul>
                                    <li>Phần mềm được Bảo hành tốt nhất, suốt quá trình sử dụng.</li>
                                    <li>Update các phiên bản mới, tính năng mới hoàn toàn miễn phí trong suốt thời giản
                                        sử dụng.
                                    </li>
                                    <li>Hỗ trợ kỹ thuật , support suốt thời gian sử dụng.</li>
                                    <li>Chúng tôi cam kết sản phẩm bán ra hoạt động tốt nhất, hỗ trợ tốt nhất, giá rẻ
                                        nhất.
                                    </li>
                                    <li>Sau khi mua hàng, Quý khách tiếp tục được Nhân viên tư vấn hướng dẫn cách thức
                                        sử dụng phần mềm sao cho hiệu quả nhất thông qua các kênh tư vấn: Tư vấn trực
                                        tiếp, Chat, Điện thoại, Team Viewer… (Thông tin hỗ trợ ở phía bên phải website).
                                    </li>
                                    <li>Trong quá trình sử dụng quý khách bị mất máy, hỏng ổ cứng hoặc cần chuyển phần
                                        mềm sang máy tính khác sẽ được chúng tôi hỗ trợ chuyển đổi bản quyền phần mềm
                                        hoàn toàn miễn phí.
                                    </li>
                                    <li>Với tính cam kết cao, Ninja mong muốn được sự tin dùng và tiếp tục ủng hộ của
                                        quý khách hàng. Đồng thời nhằm nâng cao chất lượng các dịch vụ do Ninja Team
                                        cung cấp, quý khách hàng có thắc mắc, kiến nghị, đóng góp ý kiến…vui lòng liên
                                        hệ:<span style="color: #ff9201;"> Hotline: 0967.922.911</span></li>
                                </ul>
                            </div>
                        </div>
                        {!! $contact->contact_single !!}
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.layouts.sidebar-bot-contact')
    </section>

@endsection
