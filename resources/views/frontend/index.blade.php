@extends('frontend.layouts.app')
@section('title')
    Phần mềm chấm công công nghệ AI, quản lý nhân sự với công nghệ hiện đại, chi phí tối giản
@endsection
@section('meta-desc')
    Phần mềm Ninja cung cấp giải pháp Marketing đa kênh hiệu quả: Phần mềm quảng cáo Facebook; phần mềm quảng cáo zalo, phần
    mềm quảng cáo Tiktok, phần mềm quảng cáo Telegram...
@endsection
@section('meta-title')
    Phần mềm Ninja - Giải Pháp Marketing Đa Kênh Tự Động Hóa
@endsection
@section('schema')
    <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebPage",
  "name": "Phần mềm Ninja - Giải Pháp Marketing Đa Kênh Tự Động Hóa",
  "description": "Phần mềm Ninja cung cấp giải pháp Marketing đa kênh hiệu quả: Phần mềm quảng cáo Facebook; phần mềm quảng cáo zalo, phần
  mềm quảng cáo Tiktok, phần mềm quảng cáo Telegram...",
  "url": "{{url('/')}}",
  "publisher": {
    "@type": "Organization",
    "name": "Công Ty Cổ Phần Đầu Tư & Công Nghệ Ninja"
  }
}
</script>
@endsection
@section('content')
    @php
        use Illuminate\Support\Str;
        use Carbon\Carbon;
    @endphp
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="banner-img">
                    <div class="col-lg-7 col-md-6 col-12 padding-left">
                        <div class="content">
                            <h1>Achamcong</h1>
                            <span>Tiên phong số hóa chấm công</span>
                            <p>Phần mềm chấm công công nghệ AI, quản lý nhân sự với công nghệ hiện đại, chi phí tối giản</p>
                            <div class="contact">
                                <a href="/">Liên hệ tư vấn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="video">
        <div class="container">
            <div class="title">
                <h2>Video giới thiệu phần mềm <br><span>checkin Achamcong</span></h2>
            </div>
            <div class="content-video">
                <p>Phần mềm checkin achamcong là một ứng dụng để tự động hóa quá trình chấm công. Thông qua đó, doanh nghiệp
                    có
                    thể dể dàng quản lý chấm công, theo dõi chính xác lịch làm việc, đơn từ của nhân sự công ty.</p>
                <div class="img-video">
                    <img src="./img/img-video.webp" alt="video-img">
                </div>
            </div>
        </div>

    </section>
    <section class="theme-bg feature" id="feature">
        <div class="container">
            <div class="animation-circle-inverse"><i></i><i></i><i></i></div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="text-white">Tính năng chính của <span>phần mềm checkin Achamcong</span></h2>
                        <div class="line white"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="future-box">
                        <div class="future-timeline">
                            <ul>
                                <li class="timeline">
                                    <h4 class="sub-title">Checkin check out công nghệ AI</h4>
                                    <p>Lorem Ipsum has been the industry's</p>
                                </li>
                                <li class="timeline">
                                    <h4 class="sub-title">Quản lý nhân sự chuyên nghiệp</h4>
                                    <p>Lorem Ipsum has been the industry's</p>
                                </li>
                                <li class="timeline">
                                    <h4 class="sub-title">Thông tin chi tiết, chính xác</h4>
                                    <p>Many desktop publishing packages</p>
                                </li>
                                <li class="timeline">
                                    <h4 class="sub-title">Easy File Sharing</h4>
                                    <p>Lorem Ipsum has been the industry's</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 future-mobile"><img class="img-fluid" src="img/feature-mob.png" alt="feature-mob">
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="future-box">
                        <div class="future-timeline-right">
                            <ul class="text-start">
                                <li class="timeline-right">
                                    <h4>Easy Installation</h4>
                                    <p>Lorem Ipsum has been the industry's</p>
                                </li>
                                <li class="timeline-right">
                                    <h4>Multi Platform Chat App</h4>
                                    <p>Lorem Ipsum has been the industry's</p>
                                </li>
                                <li class="timeline-right">
                                    <h4>Secure Backup & Recovery</h4>
                                    <p>Many desktop publishing packages</p>
                                </li>
                                <li class="timeline-right">
                                    <h4>Easy File Sharing</h4>
                                    <p>Lorem Ipsum has been the industry's</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="feature">
        <div class="container">
            <div class="col-md-8 offset-md-2 text-center">

                <h2><span>Tính năng chính </span>của phần mềm checkin Achamcong</h2>
                <p>
                    Achamcong là giải pháp quản lý nhân sự tiên phong sử dụng công nghệ camera AI. Hội tụ đầy đủ những tính
                    năng
                    ưu việt, cần thiết giúp người dùng tối ưu hóa bài toán quản lý nhân sự và chấm công.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-4 text-center pb-4">
                    <div class="process-box">
                        <img src="img/svg/text.webp" alt="icon">
                        <h3>Chấm công nhanh chóng</h3>
                        <p>Chấm công bằng Camera AI hoặc chấm công trên app Achamcong ở điện thoại nhanh chóng.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center pb-4">
                    <div class="process-box">
                        <img src="img/svg/OBJECT.webp" alt="icon">
                        <h3>Tiết kiệm chi phí</h3>
                        <p>Tiết kiệm chi phí nhân sự .Lắp đặt camera 1 lần sử dụng mãi mãi.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center pb-4">
                    <div class="process-box">
                        <img src="img/svg/OBJECTS.webp" alt="icon">
                        <h3>Hỗ trợ 24/7</h3>
                        <p>Achamcong có đội ngũ support khách hàng 24/7. Vì vậy, mọi vấn để sẽ được giải đáp nhanh chóng.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 text-center pb-4">
                    <div class="process-box">
                        <img src="img/svg/text.webp" alt="icon">
                        <h3>Quản lý chấm công dễ dàng</h3>
                        <p>Quản lý check in – check out, đi sớm, về muộn, xin nghỉ phép, công tác,… nhanh chóng, chính xác
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 text-center pb-4">
                    <div class="process-box">
                        <img src="img/svg/OBJECT.webp" alt="icon">
                        <h3>Bảo mật cao</h3>
                        <p>Tích hợp công nghệ AI nhận diện khuôn mặt chính xác, không thể gian lận trong chấm công.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center pb-4">
                    <div class="process-box">
                        <img src="img/svg/OBJECTS.webp" alt="icon">
                        <h3>Update mới nhất</h3>
                        <p>Chúng tôi luôn update cải thiện tính năng mới nhanh và tối ưu nhất.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="theme-bg screenshots" id="screenshots">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="text-white">Chat Loop Screen Shot</h2>
                        <div class="line white"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="swiper-screenshots-container-1 swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="img/1.png" alt="1"></div>
                            <div class="swiper-slide"><img src="img/2.png" alt="2"></div>
                            <div class="swiper-slide"><img src="img/3.png" alt="3"></div>
                            <div class="swiper-slide"><img src="img/4.png" alt="4"></div>
                            <div class="swiper-slide"><img src="img/1.png" alt="5"></div>
                            <div class="swiper-slide"><img src="img/2.png" alt="5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="question">
        <div class="container bg-quest">
            <div class="row pad-quest">
                <div class="col-lg-6 col-12">
                    <img src="img/feature-mob.png" alt="phone">
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card-quest">
                        <div class="title">
                            <h2>Phần mềm checkin Achamcong <span>giúp gì cho doanh nghiệp?</span></h2>
                        </div>
                        <div class="content">
                            <ul class="custom-list">
                                <li>Quản lý checkin check out chính xác, chặt chẽ.</li>
                                <li>Đo lường chính xác thời gian làm việc của nhân viên.</li>
                                <li>Xem, quản lý, xuất báo cáo trực tuyến nhanh chóng.Theo dõi thời gian đi sớm về muộn, ra
                                    ngoài, nghỉ
                                    phép của nhân viên.</li>
                                <li>Theo dõi thời gian đi sớm về muộn, ra ngoài, nghỉ phép của nhân viên.</li>
                                <li>Tiết kiệm thời gian trong việc quản lý chấm công và quản lý đơn từ.</li>
                                <li>Tiết kiệm chi phí, nhân sự vận hành việc quản lý nhân sự.</li>
                            </ul>
                        </div>
                        <div class="download">
                            <div class="android">
                                <img src="/img/dowload1.webp" alt="download">
                            </div>
                            <div class="apple">
                                <img src="/img/download2.webp" alt="download">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="comment">
        <div class="container">
            <div class="title">
                <h2>Cảm nhận của khách hàng <br><span>về phần mềm checkin Achamcong</span></h2>
            </div>
        </div>
        <div class="slide-comment text-center">

            <div class="container">

                <div class="row home_slider pt-4">

                    <div class="mb-5 px-3">

                        <div class="img-phay d-flex flex-row-reverse">

                            <img src="./img/phay.webp" alt="phay">

                        </div>

                        <div class="comment-card">

                            <div class="profile-comment">

                                <div class="img-comment">

                                    <img src="img/img-tuananh.webp" alt="avt">

                                </div>

                                <div class="name-comment">

                                    <span>Anh Trần Văn Hòa</span>

                                    <p>CEO phanmemninja.com</p>

                                </div>

                            </div>

                            <div class="content-comment">
                                Mình đã từng gặp rất nhiều khó khăn trong việc quản lý chấm công, đơn từ của nhân viên. Cứ
                                đến cuối
                                tháng là tình trạng phản ảnh bảng chấm công sai và các vấn đề liên quan phát sinh làm mất
                                thời gian cũng
                                như ảnh hưởng trực tiếp đến tinh thần làm việc của nhân viên. Sau khi tham gia cộng đồng
                                BNI, mình được
                                đồng nghiệp giới thiệu và sử dụng Achamcong. Tính đến thời điểm hiện tại, công ty Ninja đã
                                sử dụng ứng
                                dụng này được 3 năm và cảm thấy rất hài lòng

                            </div>

                        </div>

                    </div>

                    <div class="px-3">

                        <div class="img-phay d-flex flex-row-reverse">

                            <img src="./img/phay.webp" alt="phay">

                        </div>

                        <div class="comment-card">

                            <div class="profile-comment">

                                <div class="img-comment">

                                    <img src="img/img-tuananh.webp" alt="avt">

                                </div>

                                <div class="name-comment">

                                    <span>Chị Phương Vũ</span>

                                    <p>Co- Founder tại HATUE</p>

                                </div>

                            </div>

                            <div class="content-comment">

                                Tôi đã đăng ký dịch vụ achamcong cho công ty sử dụng được hơn 1 năm. Hiện tại, achamcong như
                                một phần
                                không thể thiếu, được Hatue sử dụng hàng ngày. Mặc dù đôi lúc chuyển giao tháng cũ và tháng
                                mới, dữ liệu
                                về hơi chậm. Tuy nhiên, khi phản hồi lên hệ thống, đội ngũ kĩ thuật achamcong xử lý vấn đế
                                rất nhanh.
                                Việc quản lý chấm công, đơn từ cũng như xuất bảng công mỗi tháng trở nên dễ dàng - tiện lợi
                                - nhanh
                                chóng. Đánh giá chung thì phần mềm checkin achamcong đáng để sử dụng!

                            </div>

                        </div>

                    </div>

                    <div class="px-3">

                        <div class="img-phay d-flex flex-row-reverse">

                            <img src="./img/phay.webp" alt="phay">

                        </div>

                        <div class="comment-card">

                            <div class="profile-comment">

                                <div class="img-comment">

                                    <img src="img/img-tuananh.webp" alt="avt">

                                </div>

                                <div class="name-comment">

                                    <span>Anh Nguyễn Thao</span>

                                    <p>Fouder & CEO tại ihunter.vn</p>

                                </div>

                            </div>

                            <div class="content-comment">

                                Trước khi sử dụng Achamcong, Ihunter đã sử dụng phần mềm khác Tuy nhiên,phần mềm đó không
                                đáp ứng được
                                nhu cầu của công ty. Sau khi biết đến và tìm hiểu về phần mềm checkin achamcong, Ihuter đã
                                đăng ký trải
                                nghiệm và khá hài lòng về tính năng chấm công AI cũng như quản lý nhân sự chuyên nghiệp. 3
                                điểm chạm mà
                                Ihunter ưng ý nhất đó chính là quản lý dễ dàng, chính xác và tự động hóa. Hy vọng, achamcong
                                sẽ thêm
                                nhiều tính năng hay nữa để doanh nghiệp có thể vận hành all in one.

                            </div>

                        </div>

                    </div>

                    <div class="px-3">

                        <div class="img-phay d-flex flex-row-reverse">

                            <img src="./img/phay.webp" alt="phay">

                        </div>

                        <div class="comment-card">

                            <div class="profile-comment">

                                <div class="img-comment">

                                    <img src="img/img-tuananh.webp" alt="avt">

                                </div>

                                <div class="name-comment">

                                    <span>Bạn Thảo Linh</span>

                                    <p>NV phần mềm Ninja</p>

                                </div>

                            </div>

                            <div class="content-comment">

                                Từ lúc công ty chuyển sang dùng phần mềm chấm công tự động AI. Em cũng như các bạn như được
                                tái sinh ở
                                mỗi buổi sáng đến công ty. Không còn sự chen lấn, không cần phải xếp hàng, chỉ cần nhìn về
                                phía camera
                                là "ting" luôn. Chấm công quá nhanh, quá tiện lợi. Lại còn có thể làm đơn từ qua app dễ
                                dàng, không
                                nhiều thủ tục như trước. Ở vị trí người trài nghiệm, em cảm thấy rất rất là hài lòng. Thật
                                hạnh phúc khi
                                từ giờ chấm công không còn là vấn nạn mỗi ngày, mỗi tháng nữa.

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
    <section class="news">
        <div class="container">
            <div class="title">
                <h2>Tin tức <span>mới nhất</span></h2>
            </div>
        </div>
        <div class="container benefit">
            <div class="row">
                <div class="col-lg-4 col-md-6-col-12 margin-bottom">
                    <div class="card-new">
                        <div class="atv-new img-hover-zoom img-hover-zoom--slowmo">
                            <a href="#"><img src="img/demo-post.webp" alt="demo"></a>
                        </div>
                        <div class="box-content">
                            <div class="title-new">
                                <p><a href="#">Hướng dẫn cách tạo page zalo trên điện thoại nâng cao hiệu quả bán
                                        hàng</a></p>
                            </div>
                            <div class="desc-new">
                                <a href="#">Trong thời đại công nghệ phát triển, việc quản lý nhân viên từ xa trở nên
                                    phổ biến hơn bao
                                    giờ hết</a>
                            </div>
                        </div>

                        <div class="more">
                            <div class="time">
                                <div class="icon">
                                    <img src="./img/Time-Circle.webp" alt="icon-time">
                                </div>
                                <div class="title">
                                    59 phút trước
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 d-flex flex-column justify-content-xl-between">
                    <div class="col-lg-12 col-12 margin-bottom">
                        <div class="card-new-right">
                            <div class="img-left img-hover-zoom img-hover-zoom--slowmo">
                                <a href="#"><img src="img/demo-post.webp" alt=""></a>
                            </div>
                            <div class="content-right">
                                <div class="box-content">
                                    <div class="title">
                                        <p><a href="#">Hướng dẫn cách lưu ảnh trên instagram đơn giản, nhanh
                                                chóng</a></p>
                                    </div>
                                    <div class="desc">
                                        Instagram là một ứng dụng mạng xã hội với nhiều hình ảnh đẹp và chất lượng cao
                                    </div>
                                    <div class="more">
                                        <div class="time">
                                            <div class="icon">
                                                <img src="./img/Time-Circle.webp" alt="icon-time">
                                            </div>
                                            <div class="title">
                                                59 phút trước
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 margin-bottom">
                        <div class="card-new-right">
                            <div class="img-left img-hover-zoom img-hover-zoom--slowmo">
                                <a href="#"><img src="img/demo-post.webp" alt=""></a>
                            </div>
                            <div class="content-right">
                                <div class="box-content">
                                    <div class="title">
                                        <p><a href="#">Hướng dẫn cách lưu ảnh trên instagram đơn giản, nhanh
                                                chóng</a></p>
                                    </div>
                                    <div class="desc">
                                        Instagram là một ứng dụng mạng xã hội với nhiều hình ảnh đẹp và chất lượng cao
                                    </div>
                                    <div class="more">
                                        <div class="time">
                                            <div class="icon">
                                                <img src="./img/Time-Circle.webp" alt="icon-time">
                                            </div>
                                            <div class="title">
                                                59 phút trước
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
