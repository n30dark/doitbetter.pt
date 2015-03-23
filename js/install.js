/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){

    $(".button").hover(
        function(){
            $(this).addClass("button_hover");
        },
        function(){
            $(this).removeClass("button_hover");
        }
    );

    $(".button").click(
        function(){
            var link = $(this).attr('link');
            var lang = $('#language_select').val();
            if(lang==undefined){
                lang = "";
            }
            window.location.href = link + lang;
        }
    );

});


