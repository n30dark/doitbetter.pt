<?php
    $conf = $dados['conf'];
    $lingua = $dados['lingua'];

    $plug = new GestorPlugins();
    $plug->controlador = 'site';		
?>
    <div class="content">
        <div class="center">
            <?= $plug->dispatch(Array("home", "logo", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "banner", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "extras", $area, $lingua->lingua)); ?>
        </div>      
        <div class="right">
            <?= $plug->dispatch(Array("home", "phone", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "courses", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "promos", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "legal", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "newsletter", $area, $lingua->lingua)); ?>
        </div>  
    </div>