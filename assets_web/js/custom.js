"use strict"; // Start of use strict


$(document).ready(function () {

    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");

    //navber
    var navbar = $('.navbar-default');
    var menuTop = navbar.offset().top;
    $(window).scroll(function () {
        if ($(window).scrollTop() > menuTop) {
            navbar.css({
                position: 'fixed',
                top: '0px'
            });
        } else {
            navbar.css({
                position: 'static',
                top: '0px'
            });
        }
    });

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').on('click', function (event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed',
        offset: 100
    });
    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 50
        }
    });
 
    //datepicker
    $(".datepicker").datepicker({
        dateFormat: "dd-mm-yy"
    }); 
    $( ".datepicker-avaiable-days" ).datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: false,
        minDate: 0,  
        // beforeShowDay: DisableDays 
     });


    //Doctor Carousel
    $("#owl-doctor").owlCarousel({
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsTabletSmall: false,
        itemsMobile: [479, 1],
        lazyLoad: true,
        navigation: true,
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });


    //owl carousel
    $("#owl-slider").owlCarousel({
        autoPlay: 5000,
        navigation: true,
        pagination: false,
        singleItem: true,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-arrow-right'></i>",
            "<i class='fa fa-arrow-left'></i>"
        ],
        eforeInit: function (elem) {
            //Parameter elem pointing to $("#owl-demo")
            random(elem);
        }
    }); 

    //Testimonial Carousel
    var owl = $("#owl-testimonial");
    owl.owlCarousel({
        navigation: false,
        singleItem: true,
        transitionStyle: "backSlide"
    });

    //tab
    $("div.bhoechie-tab-menu>div.list-group>a").on('click',function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });

    //back to top
    $('body').append('<div id="toTop" class="btn btn-top"><span class="glyphicon glyphicon-chevron-up"></span></div>');
    $(window).scroll(function () {
        if ($(this).scrollTop() !== 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').on('click',function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    }); 
 

    /***** *********** ****/
    /***** COMMENT FORM ***/
    /***** *********** ****/
    var form   = $('#createComment');
    var target = $('.alert');

    form.on('submit', function(e) {
        e.preventDefault();
        var formdata = form.serialize();

        $.ajax({
            url      : form.attr('action'),
            type     : form.attr('method'),
            dataType : 'json',
            data     : formdata,
            success  : function(data) {
                if (data.message) {
                    target.removeClass('alert-danger');
                    target.addClass('alert-info');
                    target.html(data.message);

                    setInterval(function(){ 
                        history.go(0);
                    }, 1500);
                    
                } else {
                    target.removeClass('alert-info');
                    target.addClass('alert-danger');
                    target.html(data.exception);
                }
            },
            error    : function(exc) {
                alert('failed');
            }
        });
    }); 

    /***** *********** ****/
    /***** ENQUIRY FORM ***/
    /***** *********** ****/
    var enquiry = $('#enquiryForm'); 
    var output  = $(".output");
    enquiry.on('submit',function(e) {
        e.preventDefault();
        var formdata = enquiry.serialize();

        $.ajax({
            url      : enquiry.attr('action'),
            type     : enquiry.attr('method'),
            dataType : 'json',
            data     : formdata,
            success  : function(data) {
                if(data.enquiry_success) {
                    output.addClass("alert-success");
                    output.removeClass("alert-danger hide");
                    output.html(data.enquiry_success);

                    setInterval(function(){
                        history.go(0);
                    },1500);

                } else {
                    output.addClass("alert-danger");
                    output.removeClass("alert-success hide");
                    output.html(data.enquiry_exception);
                } 
            },
            error    : function(exc) {
                alert('failed');
            }
        });
    });

});// End of use strict


//print a div
function printContent(el){
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
}
 