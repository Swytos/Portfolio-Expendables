$( document ).ready(function() {

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


});

/*When clicking on Full hide fail/success boxes */
$('#name, #email, #company, #message').focus(function() {
  $('#success').hide();
  $('#error').hide();
});

