
/* #START SCRIPT FOR CREATE HEADER */
    /**
     * Display the formulair for create header
     */
    $('#create-header-btn').click(function (){
        for(let i = 0; i<$('.create-header').length; i++ ){
            $('.create-header')[i].style.display = 'block';
        }
    });

    /**
     * Hidde the formulaire for create header
     */
    $('#close-create-header').click(function (){
        for(let i = 0; i<$('.create-header').length; i++ ){
            $('.create-header')[i].style.display = 'none';
        }
    });

    /**
     * Show component add view header
     */
    $('#view-header-btn').click(function(){
        for(let i = 0; i<$('.header-view').length; i++){
            $('.header-view')[i].style.display = 'block';
        }
    });

     /**
      * Hidde the formulaire for add header view
      */
     $('#close-header-view').click(function (){
        for(let i = 0; i<$('.header-view').length; i++ ){
            $('.header-view')[i].style.display = 'none';
        }
    });
    
/* #END SCRIPT FOR CREATE HEADER */