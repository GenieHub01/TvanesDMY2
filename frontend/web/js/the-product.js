/*global $, alert , console */

$(function () {
    'use strict';
    
    $('.navbar-light .navbar-nav .nav-item').on('mouseenter', function () {
       
        $(this).children('.down-menu').fadeIn(300);
        
    });
    

    $('.navbar-light .navbar-nav .nav-item').on('mouseleave', function () {
       
        $(this).children('.down-menu').fadeOut(300);
        
    });
    
    $('.shop-cartt .remove-prod').on('click', function () {
       
        $(this).parents('.eac-prod').addClass('disp-no');
        
    });
    
    $('.search-on').on('click', function () {
       
        $(this).children('.search-menu').fadeToggle(300);

        
    });
    
    $('.search-menu').on('click', function (e) {
        e.stopPropagation();
    });
    
    $(".search-on .want-buy").on('click', function () {
               
        if ($(".search-on .want-buy").val() === "") {
            $(".search-on .search-ico").show();
        }
        
    });
    
    $(".search-on .want-buy").keydown(function () {
        $(".search-on .search-ico").hide();
    });
    
    $(".search-on .want-buy").keyup(function () {
        if ($(".search-on .want-buy").val() === "") {
            $(".search-on .search-ico").show();
        }
    });
    
    $('.search-on').on('click', function () {
       
        $('.th-search').toggleClass('fa-search');
        $('.th-search').toggleClass('fa-times');
        
    });
    
    $(".navbar-light .navbar-toggler").click(function () {
        $('.toggle-menuu').toggleClass("active");
    });

    
   
    
    
    //making navbar fixed 
    
    $(window).on('scroll', function () {
        
        $(this).scrollTop() > 400 ? $('nav').addClass('navfixed') : $('nav').removeClass('navfixed');
        
        $(this).scrollTop() > 700 ? $('.car-up .carr').css('bottom', '5%') : $('.car-up .carr').css('bottom', '100%');
        
    });

    
    $('.car-up .carr').on('click', function () {
       
        $('html,body').animate({
            
            scrollTop: $('.header').offset().top
            
        }, 500);
        
        $(this).css('bottom', '100%');
        
        
    });
    
    
    
    //
    
    
        
    if ($(window).width() > 767) {
        $('#hov-img').zoom();
    } else {
        
        $('body').on('click', function () {
            $('#hov-img').trigger('zoom.destroy');
        });
        
        $('#hov-img').on('click', function (e) {
            e.stopPropagation();
        });
        
        
        
        $('#hov-img').on('click', function () {
            $('#hov-img').zoom();
        });

    }
    
    $('#hov-img .remove-ico').on('click', function () {
            $('#hov-img').hide();
        });
    
    $(window).on('resize', function () {
        if ($(window).width() > 767) {
            $('#hov-img').zoom();
        } else {

            $('body').on('click', function () {
                $('#hov-img').trigger('zoom.destroy');
            });

            $('#hov-img').on('click', function (e) {
                e.stopPropagation();
            });



            $('#hov-img').on('click', function () {
                $('#hov-img').zoom();
            });

        }

    });

    
    
    $('.all-about .eac-cate').on('click', function () {
       
        $(this).addClass('active').siblings().removeClass('active');
        
    });
    
    $('.all-about .eac-cate.description').on('click', function () {
       
        $('.inner-ab').addClass('disp-no');
        $('.inner-ab.description').removeClass('disp-no');
        
    });
    
    $('.all-about .eac-cate.additional').on('click', function () {
       
        $('.inner-ab').addClass('disp-no');
        $('.inner-ab.additional').removeClass('disp-no');
        
    });
    
    $('.all-about .eac-cate.reviews').on('click', function () {
       
        $('.inner-ab').addClass('disp-no');
        $('.inner-ab.reviews').removeClass('disp-no');
        
    });
    
    

    
});