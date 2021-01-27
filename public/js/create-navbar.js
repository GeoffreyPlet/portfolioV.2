$("input[type='radio']").change(function(event){
    value = $(event.currentTarget).val();
    inputName = $('#modal-create-navbar form').children()[0];
    inputLogo = $('#modal-create-navbar form').children()[1];
    if( value === 'logo'){
        inputName.hidden = true;
        inputLogo.hidden = false;
    }else{
        inputName.hidden = false;
        inputLogo.hidden = true;
    }
});
$('#close-create-navbar').click(function(){
    $('#modal-create-navbar').css({
        'display' : 'none',
    });
    $('#create-navbar-btn').css({
        'background': 'none',
    });
});
