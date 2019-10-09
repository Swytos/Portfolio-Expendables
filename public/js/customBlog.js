$('a.linkactive').on('click', function(e){
    e.preventDefault();
    $('a.linkactive').removeClass('active');
    $(this).addClass('active');
});

$('a.tag').on('click', function(e){
    e.preventDefault();
    if ($(this).hasClass('active-tag')){
        $(this).removeClass('active-tag')
    } else {
        $(this).addClass('active-tag');
    }
});