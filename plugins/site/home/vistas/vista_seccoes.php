<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
?>
<div class="seccoes">
            <div class="fotos">
                <div class="titulo">>><?= $lingua->obter('fotos') ?></div>
                <div class="imagem" id="fotos"></div>
            </div>
            <div class="videos">
                <div class="titulo">>><?= $lingua->obter('videos')?></div>
                <div class="imagem" id="videos"></div>
            </div>
            <div class="catalogo">
                <div class="titulo">>><?= $lingua->obter('catalogo_2012')?></div>
                <div class="imagem" id="catalogo"></div>
            </div>
        </div>