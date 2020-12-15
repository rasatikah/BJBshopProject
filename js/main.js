jQuery(document).ready(function($){
    
    // jQuery sticky Menu
    var sPageURL = window.location.href;           

    if (sPageURL.indexOf('?') > -1)
    {
        $('.profileIcon').css("display", "block"); 
        $(".login-bar").css("display", "none");

        var url = document.location.href;
        var params = url.split('?')[1];        
    
        if(params[0] == "a"){
            $("#myAcct").css("display", "none");
            $("#mySeller").css("display", "none");
            $("#myReport").css("display", "block");
            $("#myPurchase").css("display", "none");
            $("#login-bar").css("display", "none"); 
        }
        else if (params[0] == "s"){
            $("#myAcct").css("display", "none");
            $("#mySeller").css("display", "block");
            $("#myReport").css("display", "none");
            $("#myPurchase").css("display", "none");
            $("#login-bar").css("display", "block");                      
        }
        else if (params[0] == "u"){
            $("#myAcct").css("display", "block");
            $("#mySeller").css("display", "none");
            $("#myReport").css("display", "none");
            $("#myPurchase").css("display", "block");
            $("#login-bar").css("display", "none");                      
        }
        else {
            $("#myAcct").css("display", "block");
            $("#mySeller").css("display", "none");
            $("#myReport").css("display", "none");
            $("#myPurchase").css("display", "block");
            $("#login-bar").css("display", "none");                      
        }     
    }        
    else{
        $(".dropbtn").css('display','block');
        $(".dropdownnew.dropdownnew-content").css('display','block !important');
        $('.profileIcon').css("display", "block"); 
        $(".login-bar").css('display','block');
    }
    
    $( "a[href*='html']" ).click(function(){   
        if($(this).attr("id") != "logout"){
            if (sPageURL.indexOf('?') > -1)
            {
                var oldUrl = $(this).attr("href");            

                if(params[0] == "a"){
                    $(this).attr("href", oldUrl + "?admin");
                }
                else if (params[0] == "s"){
                    $(this).attr("href", oldUrl + "?seller");
                }
                else {
                    $(this).attr("href", oldUrl + "?user");
                }                           
            }
        }                   
    });

	$(".mainmenu-area").sticky({topSpacing:0});
    
    
    $('.product-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
    });  
    
    $('.related-products-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:2,
            },
            1200:{
                items:3,
            }
        }
    });  
    
    $('.brand-list').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    });    
    
    
    // Bootstrap Mobile Menu fix
    $(".navbar-nav li a").click(function(){
        $(".navbar-collapse").removeClass('in');                
    });    
    
    // jQuery Scroll effect
    $('.navbar-nav li a, .scroll-to-up').bind('click', function(event) {
        var $anchor = $(this);
        var headerH = $('.header-area').outerHeight();
        $('html, body').stop().animate({
            scrollTop : $($anchor.attr('href')).offset().top - headerH + "px"
        }, 1200, 'easeInOutExpo');

        event.preventDefault();
    });    
    
    // Bootstrap ScrollPSY
    $('body').scrollspy({ 
        target: '.navbar-collapse',
        offset: 95
    })                      
});

