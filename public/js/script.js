

/************************************************ */
loadToolsEvent();
loadHeaderCreateEvent();
loadHeaderViewEvent();
loadCreateMaquette();
loadUploadSiteEvent();
/********************************************* */

/***
 * #loadCreateMaquette Function for load event for create maquette
 * 
 * @close-create-maquette Event for hidden create-maquette
 * @create-maquette Event for add a maquette ( ajax request )
 * @selecting-maquette Event for select a maquette for start building view
 * @delete-maquette Event for delete a maquette 
 * 
 */
function loadCreateMaquette(){
    /**
     *  @close-create-maquette
     */
    $('#close-create-maquette').click(function(){
        //Style CSS for tools bar
        $('#create-maquette-btn').css({
            'background': 'none',
        });
        for(let i = 0; i<$('.create-maquette').length; i++ ){
            $('.create-maquette')[i].style.display = 'none';
        }
        $('body').css({
            'background': 'none',
        });
    });

    /**
     * @create-maquette
     * [AJAX Request]
     */
    $('#create-maquette').click(function(){
        $.ajax('/ajax/add/maquette', {
            type: 'POST',
        }).then(function(response) {
            $('.create-maquette')[0].remove();
            $('body').append(response.html);
            loadCreateMaquette();
        });
    });

    /**
     * @selecting-maquette
     * [AJAX Request]
     * type:POST
     * change data of selecting 
     */
    $('.my-maquette').click(function(){
        let value = new Object;
        value['id'] = $(this).attr('id').split('-').pop();

        $.ajax('/ajax/select/maquette', {
            type: 'POST',
            data: value,
        }).then(function(response) {
            
            $('.create-maquette')[0].remove();
            $('body').append(response.html);

            $('#header').remove();
            $('#view').append(response.htmlView);
            $('#header').prepend('<div id="navbar"></div>');
            $('#navbar').html(response.htmlNavbar); 
            loadCreateMaquette();
        });
    });

    /**
     * @delete-maquette
     * [AJAX Request]
     * type:POST
     * Delete a maquette
     */
    $('.maquette .footer span').click(function(){

        let value = new Object;
        value['id'] = $(this).attr('id').split('-').pop();

        $.ajax('/ajax/delete/maquette', {
            type : 'POST',
            data : value,
        }).then(function(response) {
            $('.create-maquette')[0].remove();
            $('body').append(response.html);
            loadCreateMaquette();
        });
    });
    
}

/**
 * #loadToolsEvent Function for load all event for tools
 * 
 * @show-create-header Event for show create tools
 * @show-view-header Event for show view tools
 * @show-create-maquette
 * @show-create-navbar
 * @show-create-tools
 * @show-view-tools
 */
function loadToolsEvent(){

        /**
         * @show-create-tools
         */
        $('#btn-show-create-tool').click(function() {

            for(let i = 0; i < $('#list-create li').length; i++){
                $($('#list-create li')[i]).toggle();
            }
            if($('#list-create li')[0].style.display == 'list-item'){
                $('#list-create').css({
                    'border' : '1px solid #d2b56c',
                    
                });
                $('#btn-show-create-tool').css({
                    'background-color' : '#d2b56c',
                });
            }
            else{
                $('#list-create').css({
                    'border' : '1px solid transparent',
                    
                });
                $('#btn-show-create-tool').css({
                    'background-color' : 'transparent',
                });
            }
        });

        /**
         * @show-view-tools
         */
        $('#btn-show-view-tool').click(function() {

            for(let i = 0; i < $('#list-view li').length; i++){
                $($('#list-view li')[i]).toggle();
            }
            if($('#list-view li')[0].style.display == 'list-item'){
                $('#list-view').css({
                    'border' : '1px solid #d2b56c',
                    
                });
                $('#btn-show-view-tool').css({
                    'background-color' : '#d2b56c',
                });
            }
            else{
                $('#list-view').css({
                    'border' : '1px solid transparent',
                    
                });
                $('#btn-show-view-tool').css({
                    'background-color' : 'transparent',
                });
            }
        });

        /**
         * @show-creat-header
         */
        $('#create-header-btn').click(function (){
            //Style css for tools bar
            $(this).css({
                'background': '#fed778c7',
            });
            $('#view-footer').css({
                'display' : 'none',
            });
            $('#view-footer-btn').css({
                'background-color': 'transparent',
            });
            $('#create-maquette-btn').css({
                'background': 'none',
            });
            $('#view-header-btn').css({
                'background': 'none',
            });
            $('#create-navbar-btn').css({
                'background': 'none',
            });
            $('#view-navbar-btn').css({
                'background': 'none',
            });
            $('#modal-create-footer').css({
                'display': 'none',
            });
            $('#create-footer-btn').css({
                'background-color': 'transparent',
            });
            for(let i = 0; i<$('.create-header').length; i++ ){
                $('.create-header')[i].style.display = 'block';
            }
            for(let i = 0; i<$('.header-view').length; i++){
                $('.header-view')[i].style.display = 'none';
            }
            for(let i = 0; i<$('.create-maquette').length; i++){
                $('.create-maquette')[i].style.display = 'none';
            }
            $('#modal-create-navbar').css({
                'display' : 'none',
            });
            $('#view-navbar').css({
                'display' : 'none',
            });
            $('body').css({
                'background': '#788080',
            });
        });
    
    
    
        /**
         * @show-view_header
         */
        $('#view-header-btn').click(function(){
            $(this).css({
                'background': '#fed778c7',
            });
            $('#view-footer').css({
                'display' : 'none',
            });
            $('#view-footer-btn').css({
                'background-color': 'transparent',
            });
            $('#modal-create-footer').css({
                'display': 'none',
            });
            $('#create-footer-btn').css({
                'background-color': 'transparent',
            });
            $('#create-maquette-btn').css({
                'background': 'none',
            });
            $('#create-header-btn').css({
                'background': 'none',
            });
            $('#create-navbar-btn').css({
                'background': 'none',
            });
            $('#view-navbar-btn').css({
                'background': 'none',
            });
            for(let i = 0; i<$('.header-view').length; i++){
                $('.header-view')[i].style.display = 'block';
            }
            for(let i = 0; i<$('.create-header').length; i++){
                $('.create-header')[i].style.display = 'none';
            }
            for(let i = 0; i<$('.create-maquette').length; i++){
                $('.create-maquette')[i].style.display = 'none';
            }
            $('#modal-create-navbar').css({
                'display' : 'none',
            });
            $('#view-navbar').css({
                'display' : 'none',
            });
            $('body').css({
                'background': '#788080',
            });
        });

        /**
         *  @show-create-maquette
         */
        $('#create-maquette-btn').click(function(){
            //Style css for tools bar
            $(this).css({
                'background': '#fed778c7',
            });
            $('#view-footer').css({
                'display' : 'none',
            });
            $('#view-footer-btn').css({
                'background-color': 'transparent',
            });
            $('#modal-create-footer').css({
                'display': 'none',
            });
            $('#create-footer-btn').css({
                'background-color': 'transparent',
            });
            $('#create-header-btn').css({
                'background': 'none',
            });
            $('#view-header-btn').css({
                'background': 'none',
            });
            $('#create-navbar-btn').css({
                'background': 'none',
            });
            $('#view-navbar-btn').css({
                'background': 'none',
            });
            for(let i = 0; i<$('.create-maquette').length; i++){
                $('.create-maquette')[i].style.display = 'block';
            }
            for(let i = 0; i<$('.header-view').length; i++){
                $('.header-view')[i].style.display = 'none';
            }
            for(let i = 0; i<$('.create-header').length; i++){
                $('.create-header')[i].style.display = 'none';
            }
            $('#modal-create-navbar').css({
                'display' : 'none',
            });
            $('#view-navbar').css({
                'display' : 'none',
            });
            $('body').css({
                'background': '#788080',
            });
        });

        /**
         * @show-create-navbar
         */
        $('#create-navbar-btn').click(function(){
            //Style css for tools bar
            $(this).css({
                'background': '#fed778c7',
            });
            $('#view-footer').css({
                'display' : 'none',
            });
            $('#view-footer-btn').css({
                'background-color': 'transparent',
            });
            $('#modal-create-footer').css({
                'display': 'none',
            });
            $('#create-footer-btn').css({
                'background-color': 'transparent',
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

            $('#modal-create-navbar').css({
                'display' : 'block',
            });
            $('#view-navbar').css({
                'display' : 'none',
            });
            $('#view-navbar-btn').css({
                'background': 'none',
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
}

/******************************************************************************** */

/**
 * #loadHeaderCreateEvent Function for load all event for header-create
 * Load all event and function for do create header
 * 
 * @close-create-header Event for close create-header
 * @error-create-header Event for say errors formulaire
 * 
 */
function loadHeaderCreateEvent(){
    /**
     * Hidde the formulaire for create header
     */
    $('#close-create-header').click(function (){
        $('#create-header-btn').css({
            'background':'none',
        });
        for(let i = 0; i<$('.create-header').length; i++ ){
            $('.create-header')[i].style.display = 'none';
        }
        $('body').css({
            'background': 'none',
        });
    });
}



/************************************************************************************************ */


/**
 * #loadHeaderViewEvent Function for load all event for #header-view
 * Load all event and function for do header_view
 * 
 * @close-header-view Event for close hedaer-view
 * @select-header-view Event for css effect
 * @hover-header-view Event for css efect
 * @mouseover-header-view Event for css
 * #getActive Function for check which header-view is selected
 * @ajax-get-formulair Ajax function for load header-view formulaire
 */
function loadHeaderViewEvent(){

        /**
         * @close-header-view
         */
        $('#close-header-view').click(function (){
            $('#view-header-btn').css({
                'background':'none',
            });
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
            $('body').css({
                'background': 'none',
            });
            $('#active-boby').html('');
            getActive();
            
        });

        /**
         * @select-hearder-view
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

        /**
         *  @hover-header-view
         */
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

        /**
         *  @mouseover-header-view
         */
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

        /**
         *  #getActive
         */
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

       

    /**
     * @ajax-get-formulaire
     */
    $('.header-view-item').click(function(event) {
        let value = $($(event.currentTarget).children()[1]).val();

        //Do en ajax call in symfony route
        $.ajax('/ajax/view/header/'+value, {
            type: 'GET',
        }).then(function(response) {
            let html = response.html+'<div class="add-view-header" id="add-'+value+'"><span class="m-0">ajouter sur le header</span></div>';
            $('#active-boby').html(html);

            /**
             * @add-view-header
             */
            $('.add-view-header').click(function(event){
                let value2 = $(event.currentTarget).attr('id').split('-').pop();

                
                $.ajax('/ajax/add/view/header/'+value2, {
                    type: 'GET',
                }).then(function(response){
                    let html = response.html;
                    $('#view').html(html);
                });
                

            });
        });
    });
}

/************************************************************************************************ */
function loadUploadSiteEvent(){
    $('#upload-site-btn').click(function(){

        let image = $($('#header').children()[2]).attr('class');

        /* #DEBUT HEAD */
            $('#header').prepend('<head> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> </head>');
            $('#header').append('<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>');
        /* #FIN HEAD */
        let html = $('#header').html();

        
        html = html.replace('url(/img/uploads/'+image+')','url(img/uploads/'+image+')');
      

        /**
         * JE doit faire une requete ajax en post avec les différent composant donc ici
         * le header 
         */
        /* Create a object for give it in the post ajx request */
        let value = new Object();
        value["header"] = html;

         $.ajax('/ajax/upload/site', {
             type : 'POST',
             data : value,
         }).then(function(response) {
            window.location('/create');
         });
    });
}

