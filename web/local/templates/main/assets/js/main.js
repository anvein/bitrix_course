$(document).ready(function() {
    "use strict";

    /* === nav sticky header === */
    var navBottom = $(".menu-bottom").offset();

    $(window).on('scroll', function () {
        var w = $(window).width();
        if ($(".menu-bottom").length == 0) {
            if (w > 768) {
                if ($(this).scrollTop() > 1) {
                    $('header.menu-bottom').addClass("sticky");
                }
                else {
                    $('header.menu-bottom').removeClass("sticky");
                }
            }
        } else {
            if (w > 768) {
                if ($(this).scrollTop() > navBottom.top + 100) {
                    $('header.menu-bottom').addClass("sticky");
                }
                else {
                    $('header.menu-bottom').removeClass("sticky");
                }
            }
        }
    });

    /* TOP Menu Stick  */

    var windows = $(window);
    var sticky = $('#sticky-header');

    windows.on('scroll', function () {
        var scroll = windows.scrollTop();
        if (scroll < 160) {
            sticky.removeClass('sticky');
        } else {
            sticky.addClass('sticky');
        }
    });

    /* parallax active  */
    $('.parallax-bg').parallax("50%", 0.4);
    $('.parallax-active').parallax("50%", 0.4);



    /* mobile menu active */

    $('nav#dropdown').meanmenu({
        meanScreenWidth: "767",
        meanMenuContainer: ".mobile-menu-area .container",
    });


    /* ------------------------------------------------------------------------
       SEARCH OVERLAP
    ------------------------------------------------------------------------ */
    $('.search-open').on('click', function(){
        $('.search-inside').fadeIn();
    });
    $('.search-close').on('click', function(){
        $('.search-inside').fadeOut();
    });

    /* mixItUp active  */
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });


    /* one page nav */
    var top_offset = $('.header-area').height() - 70;  // get height of fixed navbar
    $('#nav').onePageNav({
        scrollOffset: top_offset,
        scrollSpeed: 750,
        easing: 'swing',
        currentClass: 'current',
    });

    $(".navbar-toggle").on('click',function(){
        $(".one-page-style").addClass("mobile_menu");
    });
    $(".one-page-style li a").on('click',function(){
        $(".navbar-collapse").removeClass("in");
    });




    /* mixItUp active  */
    $('#Container').mixItUp();

    /* magnificPopup active */
    $('.image-link').magnificPopup({
        type: 'image',
        gallery:{enabled:true}
    });
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });

    /* slider active  */
    $('.slider-active').owlCarousel({
        loop:true,
        /* animateOut: 'fadeOut', */
        items:1,
        nav:true,
        dots:false,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

    /* testimonial active  */
    $('.testimonial-active').owlCarousel({
            loop:true,
            items:1,
            dots:true,
            nav:false,
            navText:['<i class="zmdi zmdi-long-arrow-left"></i>','<i class="zmdi zmdi-long-arrow-right"></i>'],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        }

    )

    /* testimonial active  */
    $('.blog-carousel').owlCarousel({
        loop:true,
        items:1,
        dots:true,
        nav:true,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

    /* post active  */
    $('.post-active').owlCarousel({
        loop:true,
        items:3,
        dots:true,
        nav:false,
        navText:['<i class="zmdi zmdi-long-arrow-left"></i>','<i class="zmdi zmdi-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            768:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })

    /* brand active   */
    $('.brand-active').owlCarousel({
        loop:true,
        items:5,
        dots:false,
        nav:false,
        navText:['<i class="zmdi zmdi-long-arrow-left"></i>','<i class="zmdi zmdi-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            450:{
                items:2
            },
            767:{
                items:4
            },
            1000:{
                items:5
            }
        }
    })

    /* service-carousel   */
    $('.service-carousel').owlCarousel({
        loop:true,
        items:3,
        dots:true,
        nav:false,
        navText:['<i class="zmdi zmdi-long-arrow-left"></i>','<i class="zmdi zmdi-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })

    /* service-carousel   */
    $('.portfolio-carousel').owlCarousel({
        loop:true,
        items:2,
        dots:true,
        nav:false,
        navText:['<i class="zmdi zmdi-long-arrow-left"></i>','<i class="zmdi zmdi-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:2
            },
            1000:{
                items:2
            }
        }
    })

});

