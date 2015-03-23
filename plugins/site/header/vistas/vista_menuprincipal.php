<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
?>
<div class="menuprincipal">
    <div class="opcao" id="selected"><?= $lingua->obter('home')?></div>
    <div class="opcao"><?= $lingua->obter('informacoes') ?></div>
    <div class="opcao"><?= $lingua->obter('agenda') ?></div>
    <div class="opcao"><?= $lingua->obter('cidade') ?></div>
    <div class="opcao"><?= $lingua->obter('multimedia') ?></div>
    <div class="opcao"><?= $lingua->obter('contactos') ?></div>
</div>
