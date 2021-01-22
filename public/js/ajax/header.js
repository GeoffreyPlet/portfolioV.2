



$('.update-header').click(function() {
    $('form').submit(function(event){
        event.preventDefault();

        var value = $(this).serialize();

        $.ajax('/ajax/view/upload/header', {
            type: 'POST',
            data: value,
        }).then(function(response){
            $('#header-view').remove();
            $('body').append(response.htmlTest);
            $('.header-view-form')[0].style.display = 'block';
            loadHeaderViewEvent();
            
        });
    });
});