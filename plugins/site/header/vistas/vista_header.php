<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];

$plug = new GestorPlugins();
$plug->controlador = 'site';
?>
<div class="header">
    <div class="top">
        <?= $plug->dispatch(Array("header", "social", $area, $lingua->lingua)); ?>
    </div>
    <div class="bottom">
        <?= $plug->dispatch(Array("header", "menu", $area, $lingua->lingua)); ?>
    </div>
</div>
