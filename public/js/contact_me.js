    $('body').on('click', '#sendMessageButton', function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $("#contactForm").attr("action"),
            data: $("#contactForm").serialize(),
        }).done( function(response){
            $('#success').html('');
            $('#error').hide();
            $('#success').hide();
            $('#contactForm').find("input[type=text], input[type=email], textarea").val('');
            if(response.success === true){
                $('#success').show();
                $('#success').append('<h3><i class="fas fa-envelope"></i> Message sent</h3>');
            }
        }).fail(function(response){
            $('#success').hide();
            $('#error').show();
            $("#error_list").html("<ul></ul>");
            $.each(response.responseJSON.errors, function( index, value ) {
                $("#error_list ul").append("<li>"+value+"</li>");
            });
        });
    });
    var filtered = false;

    $('.js-filter').on('click', function(){
        if (filtered === false) {
            $('.filtering').slick('slickFilter',':even');
            $(this).text('Unfilter Slides');
            filtered = true;
        } else {
            $('.filtering').slick('slickUnfilter');
            $(this).text('Filter Slides');
            filtered = false;
        }
    });

    /*When clicking on Full hide fail/success boxes */
    $('#name, #email, #company, #message').focus(function() {
      $('#success').hide();
      $('#error').hide();
    });

    /* Project slick carousel*/
    $('.projects').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false
    });

    /* Project slick carousel*/
    $('.sl').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1150,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    var adaptiveSticky = function() {
        if($(window).width() < 1000){
            $('div#sticky_name').removeClass('sticky-top');
            $('div#sticky_image').removeClass('image');
        } else if($(window).width() > 1000) {
            $('div#sticky_name').addClass('sticky-top');
            $('div#sticky_image').addClass('image');
        }
    }
    adaptiveSticky();
    $(window).resize(adaptiveSticky);
    // Collapse Navbar
    var navbarCollapse = function() {
        if ($(document).scrollTop() > 100) {
            $('div#sticky_name').removeClass('col-lg-12');
            $('div#sticky_name').addClass('col-lg-6');
        } else if ($(document).scrollTop() < 100){
            $('div#sticky_name').removeClass('col-lg-6');
            $('div#sticky_name').addClass('col-lg-12');
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);




