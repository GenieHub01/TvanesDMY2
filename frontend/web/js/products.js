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
        
        $(this).scrollTop() > 400 ? $('.navbar-light').addClass('navfixed') : $('.navbar-light').removeClass('navfixed');
        
        $(this).scrollTop() > 700 ? $('.car-up .carr').css('bottom', '5%') : $('.car-up .carr').css('bottom', '100%');
        
    });

    
    $('.car-up .carr').on('click', function () {
       
        $('html,body').animate({
            
            scrollTop: $('.header').offset().top
            
        }, 500);
        
        $(this).css('bottom', '100%');
        
        
    });
    
    
    
    //
    

    
    
    

    $(".search-filter .filter-sear").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".search-results .the-products p").filter(function () {
            
            if ($(this).text().toLowerCase().indexOf(value) > -1) {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                $('.not-found').hide();

            } else {
                
                $('.search-results .the-products p').hide();
                $('.not-found').show();
            }
            
        });
    });
    
    $('body').click(function () {
        $('.search-results').hide();
    });
    
    $('.search-filter .filter-sear').click(function (e) {
        e.stopPropagation();
    });
    
    
    
    $(".search-filter .filter-sear").on("click", function () {
        $('.search-results').show();
    });
    
    $('body').click(function () {
        $('.all-sort .the-sorts').slideUp(200);
        $('.updown-ico').addClass('fa-angle-down').removeClass('fa-angle-up');
    });
    
    $('.all-sort').click(function (e) {
        e.stopPropagation();
    });

    $('.all-sort .show-sort').click(function () {
        $('.all-sort .the-sorts').slideToggle(200);
        $('.updown-ico').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
    });
    
    $('.all-sort .the-sorts li').click(function () {
        $('.all-sort .the-sorts').slideToggle(200);
        $('.updown-ico').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
        $('.all-sort .show-sort span').text($(this).text());
        
    });
    
    $('.all-products .eac-card .to-cart').on('click', function () {
        
        $(this).addClass('loading-c');
        
    });
    
    
    
    
});