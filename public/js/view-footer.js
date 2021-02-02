

/* #START [CLOSE BTN] */
$('#close-view-footer').click(function(){
    $('#view-footer').css({
        'display' : 'none',
    });
    $('#view-footer-btn').css({
        'background-color': 'transparent',
    });
    $('body').css({
        'background': 'none',
    });
})
/* #END [CLOSE BTN] */

/* #START [SHOW BTN] */
$('#view-footer-btn').click(function(){
    $('#view-footer').css({
        'display' : 'block',
    });
    $('#view-footer-btn').css({
        'background': '#d2b56c',
    });
    $('#modal-create-footer').css({
        'display': 'none',
    });
    $('#create-footer-btn').css({
        'background': 'none',
    });
    $('#view-navbar').css({
        'display' : 'none',
    });
    $('#view-navbar-btn').css({
        'background': 'none',
    });
    $('#create-header-btn').css({
        'background': 'none',
    });
    $('#view-header-btn').css({
        'background': 'none',
    });
    $('#create-maquette-btn').css({
        'background': 'none',
    });
    $('#create-navbar-btn').css({
        'background': 'none',
    });
    $('#view-navbar').css({
        'display' : 'none',
    });
    $('#modal-create-navbar').css({
        'display' : 'none',
    });
    for(let i = 0; i<$('.create-maquette').length; i++){
        $('.create-maquette')[i].style.display = 'none';
    }
    for(let i = 0; i<$('.header-view').length; i++){
        $('.header-view')[i].style.display = 'none';
    }
    for(let i = 0; i<$('.create-header').length; i++){
        $('.create-header')[i].style.display = 'none';
    }
    $('body').css({
        'background': '#788080',
    });
});
/* #END [SHOW BTN] */