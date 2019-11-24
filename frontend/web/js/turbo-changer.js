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
    
    
    /*features inner-feat height */
    
    $('.features .inner-feat').css('height', 'auto');
    
    
    $('.features .inner-feat').height($('.features .inner-feat').height());
    
    $(window).on('resize', function () {
        
        $('.features .inner-feat').css('height', 'auto');
       
        $('.features .inner-feat').height($('.features .inner-feat').height());
        
    });
    
    /**/
    
    $('.products .eac-bt').on('click', function () {
       
        $(this).addClass('active').siblings().removeClass('active');
        
    });
    
    $('.products .eac-bt.featured').on('click', function () {
        $('.products .inner-o').addClass('disp-no');
        $('.products .featured-products').removeClass('disp-no');
        $('.products .paginationn li.featured').addClass('active').siblings().removeClass('active');
        
    });
    
    $('.products .eac-bt.recent').on('click', function () {
        $('.products .inner-o').addClass('disp-no');
        $('.products .recent-products').removeClass('disp-no');
        $('.products .paginationn li.recent').addClass('active').siblings().removeClass('active');
        
    });
    
    $('.products .eac-bt.categories').on('click', function () {
        $('.products .inner-o').addClass('disp-no');
        $('.products .categories-products').removeClass('disp-no');
        $('.products .paginationn li.categories').addClass('active').siblings().removeClass('active');
        
    });
    
    
    $('.products .paginationn li').on('click', function () {
       
        $(this).addClass('active').siblings().removeClass('active');
        
        
        $('html,body').animate({
            
            scrollTop: $('.products').offset().top
            
        }, 500);
        
        
    });
    
    $('.products .paginationn li.featured').on('click', function () {
       
        $('.products .inner-o').addClass('disp-no');
        $('.products .featured-products').removeClass('disp-no');
        $('.products .eac-bt.featured').addClass('active').siblings().removeClass('active');
        
    });
    
    $('.products .paginationn li.recent').on('click', function () {
       
        $('.products .inner-o').addClass('disp-no');
        $('.products .recent-products').removeClass('disp-no');
        $('.products .eac-bt.recent').addClass('active').siblings().removeClass('active');
        
    });
    
    $('.products .paginationn li.categories').on('click', function () {
       
        $('.products .inner-o').addClass('disp-no');
        $('.products .categories-products').removeClass('disp-no');
        $('.products .eac-bt.categories').addClass('active').siblings().removeClass('active');
        
    });
    
    
    /**/
     
    /* loading card btn */
    
    $('.products .to-cart').on('click', function () {
        
        $(this).addClass('loading-c');
        
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
    
});
          
