<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$banner = $dados['banner'];
?>
<script type="text/javascript">
$(function(){
	$(".carousel .content .option").hide();
	$(".carousel .content .option:first").show();
    
    $(".carousel .options .option").hover(function(){	
        $(".carousel .options .option.selected").removeClass("selected");
			$(this).addClass("selected");
			$(".carousel .content .option:visible").hide();
            //alert($(".carousel .options .option.selected").attr("val"));
            $(".carousel .content .option#"+$(".carousel .options .option.selected").attr("val")).show();
	});
    
    $(".carousel .options .option:first").mouseover();
    
    window.setInterval("autobanner()", 5000);
    
    
});

function autobanner(){
    if($(".carousel .options .option.active").attr("val")=="<?= $banner[count($banner)-1]->aliasweb?>"){
        $(".carousel .options .option:first").mouseover();
    }else{
        $(".carousel .options .option.selected").next().mouseover();
    }
}
</script>
<div class="carousel">
    <div class="options">
		<?php $max = count($banner);$i=1;foreach($banner as $option): ?>
        <div class="option" val="<?= $option->aliasweb ?>" >
            <img src="<?= BO_URL::obterHrefInterno("uploads/imagens/artigos/".$option->icon) ?>" alt="<?= $option->titulo?>" />
            <a class="course_option" href="<?= BO_URL::obterHrefInterno($option->aliasweb) ?>"><?= $option->titulo?></a>
        </div>
        <hr class="carousel_division"/>
		<?php $i++; endforeach; ?>
    </div>
    <div class="content">
		<?php foreach($banner as $option): ?>
        
        <div class="option" id="<?= $option->aliasweb ?>"> 
            <a class="course_option" href="<?= BO_URL::obterHrefInterno($option->aliasweb) ?>">
            <img src="<?= BO_URL::obterHrefInterno("uploads/imagens/artigos/".$option->image2) ?>" alt="<?= $option->titulo ?>" /></a>
            <div class="promo_phrase"><?= strip_tags(html_entity_decode($option->intro)) ?></div>
        </div>
		<?php endforeach; ?>
    </div>
</div>
<div class="carouselshadow"></div>