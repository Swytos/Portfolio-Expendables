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
