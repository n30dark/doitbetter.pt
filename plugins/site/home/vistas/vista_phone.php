<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
?>
<script type="text/javascript">
$(function(){
    $(".phone_number").hide();
    $(".phone_number:first").show();
    
    window.setInterval("autochange()", 3000);
});

function autochange(){
    if($(".phone_number:visible").attr("id")=="last"){
        $(".phone_number:visible").fadeOut();
        $(".phone_number#first").fadeIn();
    }else{
        $(".phone_number:visible").fadeOut().next().fadeIn();
    }
}
</script>

<div class="phone">
    <img src="<?= BO_URL::obterHrefInterno("") ?>estilos/site/images/phone.png" alt="Phone:" />
    <div class="content">
        <span class="phone_number" id="first"><img style="height:25px;" src="<?= BO_URL::obterHrefInterno("estilos/site/images/219575110.png")?>" alt="219 575 110" /></span>
        <span class="phone_number"><img style="height:25px;" src="<?= BO_URL::obterHrefInterno("estilos/site/images/934118655.png")?>" alt="934 118 655" /></span>
        <span class="phone_number"><img style="height:25px;" src="<?= BO_URL::obterHrefInterno("estilos/site/images/918310936.png")?>" alt="918 310 936" /></span>
        <span class="phone_number" id="last"><img style="height:25px;" src="<?= BO_URL::obterHrefInterno("estilos/site/images/969016836.png")?>" alt="969 016 836" /></span>
    </div>
</div>