<?php
	$conf = $dados['conf'];
	$lingua = $dados['lingua'];
        $passo = $dados['passo'];
?>
<div class="steps">
    <h1><?= $lingua->obter('steps')?></h1>
    <div class="<?= ($passo=='idioma')?'step_on':'step_off';?>"><?= $lingua->obter('language_step')?></div>
    <div class="<?= ($passo=='preinstall')?'step_on':'step_off';?>"><?= $lingua->obter('preinstall_step')?></div>
    <div class="<?= ($passo=='license')?'step_on':'step_off';?>"><?= $lingua->obter('license_step')?></div>
    <div class="<?= ($passo=='bd')?'step_on':'step_off';?>"><?= $lingua->obter('bd_step')?></div>
    <div class="<?= ($passo=='mainconf')?'step_on':'step_off';?>"><?= $lingua->obter('mainconf_step')?></div>
    <div class="<?= ($passo=='finish')?'step_on':'step_off';?>"><?= $lingua->obter('finish_step')?></div>
</div>