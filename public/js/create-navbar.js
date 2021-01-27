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