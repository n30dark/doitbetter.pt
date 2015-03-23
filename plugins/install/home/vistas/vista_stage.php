<?php 
	$p = new GestorPlugins();
	$p->controlador = 'install';

	$conf = $dados['conf'];
	$lingua = $dados['lingua'];
        $passo = $dados['passo'];
?>
<div class="main_header">
    <div class="logo"></div>
    <div class="version"></div>
</div>

<div class="content">
    <?= $p->dispatch(Array('home', 'steps', $passo, $lingua->lingua)); ?>
    <div class="right">
        <div class="rightpad">
            <?= $p->dispatch(Array('home', $passo, $lingua->lingua)); ?>
        </div>
        <div class="copyright">
            <?= $lingua->obter('copyright'); ?>
        </div>
    </div>
</div>

