$(function(){
    
    $(".contact").hover(function(){
        $(this).animate({
            opacity: 0.7
        }, 500);
    },
    function(){
        $(this).animate({
            opacity: 1.0
        }, 500);
    });

    $(".menu ul > li").click(function(){
        window.location.href = path + "/" + $(this).attr('seccao');
    });

    $(".subheader .button").click(function(){
        window.location.href = path + "/curriculos";
    });

    $(".navigation ul > li").click(function(){
        window.location.href = path + "/" + $(this).attr('seccao');
    });

    $(".contact").click(function(){
       window.location.href = path + "/contactos";
    });

});