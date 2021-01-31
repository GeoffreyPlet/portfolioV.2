function loadEventNavbar(){
    /* #DEBUT [CSS FOR SHOW AND DISPLAY TOOLS] */
    $('#close-view-navbar').click(function(){
        $('#view-navbar').css({
            'display' : 'none',
        });
        $('#view-navbar-btn').css({
            'background': 'none',
        });
        $('#form-navbar').html('');
    });
    $('#view-navbar-btn').click(function(){
        $(this).css({
            'background': '#fed778c7',
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
            'display' : 'block',
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
    /* #FIN [CSS FOR SHOW AND DISPLAY TOOLS] */


    /**
     * #DEBUT [AJAX REQUEST FOR SELECT NAVBAR]
     *
     */


    $('nav').click(function(event){
    let value =  $(event.currentTarget).attr('id').split('-')[1];
        value = parseInt(value);
    $.ajax('/ajax/view/navbar/select/'+value, {
        type: 'GET',
       
    }).then(function(response) {
        
            $('#form-navbar').html(response.html);
            
            /* #DEBUT [EVENT FOR DYNAMIQUE RESPONSE] */
                $('input:file').change(function(){
                    $('#view-navbar #navbar_name').val($('#view-navbar #navbar_logo').val().split('\\').pop());
                });

                $('#view-navbar #navbar_name').keyup(function() {
                    $('#view-navbar #navbar_logo').val(null);
                });
                loadEventUtils();
                
                
                 
                


            /* #FIN [EVENT FOR DYNAMIQUE RESPONSE] */

        });
   
    });
    /**
     * #FIN [AJAX REQUEST FOR SELECT NAVBAR]
     *
     */
    

}

function loadEventUtils(){
    /* #DEBUT [AJAX DELETE NAVBAR] */
    $('#delete-navbar').click(function(){
        var value =  $('input[name="navbar-relation"]').val();
        $.ajax('/ajax/view/navbar/delete/navbar', {
            type: 'POST',
            data: {'id': value},
        }).then(function(response){
             $('#view-navbar').html(response.html);
             loadEventUtils();
        });
     });
 /* #FIN [AJAX DELETE NAVBAR] */

 /* #DEBUT [AJAX UPDATE NAVBAR] */
 $('#update-navbar').click(function(){
     var value = $('input[name="navbar-relation"]').val();
     var name = $('#form-navbar #navbar_name').val();
     $.ajax('/ajax/view/navbar/update/navbar', {
         type: 'POST',
         data: {'id': value,
                 'name': name},
     }).then(function(response){
         $('#view-navbar').html(response.htmlNavbarView);
         $('#form-navbar').html(response.html);
         loadEventUtils();
     });
 });
 /* #FIN [AJAX UPDATE NAVBAR] */

 /* #DEBUT [AJAX ADD ROUTE FOR NAVBAR] */
 $('#form-navbar form').submit(function(event){

    event.preventDefault();
    var value = $(this).serialize();
            

    $.ajax('/ajax/view/navbar/add/route', {
        type: 'POST',
        data: value,
            
    }).then(function(response){
        $('#view-navbar').html(response.htmlNavbarView);
        $('#form-navbar').html(response.html);
        loadEventUtils();
                
    });
});
/* #FIN [AJAX ADD ROUTE FOR NAVBAR] */

/* #DEBUT [AJAX ADD NAVBAR FOR HEADER] */
$('#btn-add-navbar-header').click(function(){
        
    var value = $('input[name="navbar-relation"]').val();

    $.ajax('/ajax/view/navbar/add/header/'+value, {
        type: 'GET',
            
    }).then(function(response){
        let html = response.html;
        $('#header').prepend(html);
        loadEventUtils();
                
    });
});
/* #FIN [AJAX ADD NAVBAR FOR HEADER] */
loadEventNavbar();
}
loadEventNavbar();
loadEventUtils();
