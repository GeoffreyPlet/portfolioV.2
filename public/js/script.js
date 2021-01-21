
/* #START SCRIPT FOR CREATE HEADER */
    /**
     * Display the formulair for create header
     */
    $('#create-header-btn').click(function (){
        for(let i = 0; i<$('.create-header').length; i++ ){
            $('.create-header')[i].style.display = 'block';
        }
        $('html').css({
            'background': '#788080',
        });
    });

    /**
     * Hidde the formulaire for create header
     */
    $('#close-create-header').click(function (){
        for(let i = 0; i<$('.create-header').length; i++ ){
            $('.create-header')[i].style.display = 'none';
        }
        $('html').css({
            'background': 'none',
        });
    });

    /**
     * Show component add view header
     */
    $('#view-header-btn').click(function(){
        for(let i = 0; i<$('.header-view').length; i++){
            $('.header-view')[i].style.display = 'block';
        }
        $('html').css({
            'background': '#788080',
        });
    });

     /**
      * Hidde the formulaire for add header view
      */
     $('#close-header-view').click(function (){
        for(let i = 0; i<$('.header-view').length; i++ ){
            $('.header-view')[i].style.display = 'none';
        }
        for(let i = 0; i<$('.header-view-item').length; i++){
            $($('.header-view-item')[i]).css({
                'height' : '50px',
                'order' : '0'
            });
            $($('.header-view-item')[i]).removeClass('active-item');
        }
        $('html').css({
            'background': 'none',
        });
        $('#active-boby').html('');
        getActive();
        
    });

    /**
     * Select header view
     */
    $('.header-view-item').click(function(event) {

        for(let i = 0; i<$('.header-view-item').length; i++){
            $($('.header-view-item')[i]).css({
                'height' : '50px',
                'order' : '0'
            });
            $($('.header-view-item')[i]).removeClass('active-item');
        }

        $(event.currentTarget).css({
            'height' : '400px',
            'order' : '-1'
        });
        $(event.currentTarget).addClass('active-item');
        getActive();
    });

    $('.header-view-item').hover(function(event){
        
        if($(event.currentTarget).css('height').split('px').shift() > 50){
            $(event.currentTarget).css({
                'transform' : 'scale(1)'
            });
            
        } else
        {
            $(event.currentTarget).css({
                'transform' : 'scale(1.1)'
            });
        }
    });
    $('.header-view-item').mouseout(function(event){
        
        if($(event.currentTarget).css('height').split('px').shift() > 50){
            $(event.currentTarget).css({
                'transform' : 'scale(1)'
            });
            
        } else
        {
            $(event.currentTarget).css({
                'transform' : 'scale(1)'
            });
        }
    });
    function getActive(){
        if($('.header-view-item').length > 0){
            for(let i = 0; i < $('.header-view-item').length; i ++){
                if($($('.header-view-item')[i]).hasClass('active-item')){
                    $('.active-item ').children()[0].style.display = 'flex';
                }
                else{
                    $($('.header-view-item')[i]).children()[0].style.display = 'none';
                }
            }
        }
    }
    
/* #END SCRIPT FOR CREATE HEADER */

$('.header-view-item').click(function(event) {
    let value = $($(event.currentTarget).children()[1]).val();
    //console.log(value);

    //Do en ajax call in symfony route
    $.ajax('/ajax/view/header/'+value, {
        type: 'GET'
    }).then(function(response) {
        console.log(response.html);
        $('#active-boby').html(response.html);
    });
});