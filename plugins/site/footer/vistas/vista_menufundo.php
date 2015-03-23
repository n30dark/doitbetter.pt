<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
?>
<div class="menu">
    <a class="op" id="sitemap"><?= $lingua->obter("mapa_site") ?></a>
    <a class="op" id="politica_privacidade"><?= $lingua->obter("politica_privacidade") ?></a>
    <a class="op" id="termos_condicoes"><?= $lingua->obter("termos_condicoes") ?></a>
    <a class="op" id="contactos"><?= $lingua->obter("contactos") ?></a>
    <a class="op" id="recomendar_site"><?= $lingua->obter("recomendar_site") ?></a>
    <a class="op" id="ajuda"><?= $lingua->obter("ajuda") ?></a>
    <a class="op" id="custos"><?= $lingua->obter("custos") ?></a>
    <a class="op" id="faq"><?= $lingua->obter("faq") ?></a>
    <a class="op" id="ajudenos_melhorar"><?= $lingua->obter("ajude-nos_a_melhorar") ?></a>
</div>