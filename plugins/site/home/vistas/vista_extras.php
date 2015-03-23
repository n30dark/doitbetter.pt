<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$seccoes = $dados['seccoes'];
?>
<div class="center_options">
    <?php $i=1;foreach($seccoes as $seccao): ?>
    <div class="option" id="option<?= $i?>">
        <img src="<?= BO_URL::obterHrefInterno("uploads/imagens/paginas/".$seccao->image) ?>" alt="<?= $seccao->titulo ?>" />
        <div class="titulo"><?= $seccao->titulo ?></div>
        <div class="more">
            <a href="<?= BO_URL::obterHrefInterno($seccao->aliasweb) ?>" >Saiba mais</a>
        </div>   
        <div class="extrashadow"></div>                         
    </div>
    
    <?php $i++; endforeach; ?>
</div>