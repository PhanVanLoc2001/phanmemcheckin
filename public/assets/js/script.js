jQuery(document).ready(function ($) {
    $(".home_slider").slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $(".posts_slider").slick({
        dots: false,
        infinite: true,
        arrows: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $(".slider_par").slick({
        dots: false,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.news_slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        arrows: false,
    });

    //Check to see if the window is top if not then display button
    $(window).scroll(function () {
        // Show button after 100px
        const showAfter = 100;
        if ($(this).scrollTop() > showAfter) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
    /* Navbar toggler */
    const toggleBtn = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector(".navbar-nav");
    const navCloseBtn = document.querySelector(".btn-nav-close");

    toggleBtn.addEventListener("click", () => {
        navbarNav.classList.toggle("active");
    });
    navCloseBtn.addEventListener("click", () => {
        navbarNav.classList.remove("active");
    });

    /* Add icon on .nav-item if dropdown exists */
    const navItems = document.querySelectorAll(".nav-item");
    navItems.forEach((item) => {
        const hasDropdowns = item.querySelector(".dropdown") !== null;
        if (hasDropdowns) {
            item.classList.add("icon");
        }
    });
    $(window).scroll(function() {
        if ($(window).scrollTop() > 500) {
            $('.header_class').addClass('header_fixed');
        } else {
            $('.header_class').removeClass('header_fixed');
        }
    });
});
$(document).ready(function() {
    if ($("#top").length > 0) {
        $("#top").click(function() {
            $('body,html').animate({
                scrollTop: 0
            });
        });
    }
});
$(document).ready(function() {
    $('.parent-checkbox').click(function() {
        var isChecked = $(this).prop('checked');
        $(this).closest('.col-4').find('.child-checkbox').prop('checked', isChecked);
        updateParentCheckboxes();
    });

    $('.child-checkbox').click(function() {
        var parentCheckbox = $(this).closest('.col-4').find('.parent-checkbox');
        var childCheckboxes = $(this).closest('.col-4').find('.child-checkbox');
        var isAllChecked = childCheckboxes.length === childCheckboxes.filter(':checked').length;
        parentCheckbox.prop('checked', isAllChecked);
        updateParentCheckboxes();
    });

    function updateParentCheckboxes() {
        $('.parent-checkbox').each(function() {
            var parentCheckbox = $(this);
            var childCheckboxes = parentCheckbox.closest('.col-4').find('.child-checkbox');
            var isAllChecked = childCheckboxes.length === childCheckboxes.filter(':checked').length;
            parentCheckbox.prop('checked', isAllChecked);
        });
    }

    // Khởi tạo trạng thái ban đầu của các checkbox
    updateParentCheckboxes();
});
