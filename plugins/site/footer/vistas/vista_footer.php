<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];

$plug = new GestorPlugins();
$plug->controlador = 'site';
?>
<div class="footer">       
    <?= $plug->dispatch(Array("footer", "copyright", $area, $lingua->lingua)); ?>    
</div>