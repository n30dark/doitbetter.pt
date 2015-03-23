<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
?>
<div class="contador">
    <div class="faltam"><?= $lingua->obter("faltam")?></div>
    <div class="dias">000</div> <span style="line-height: 56px;margin-left:10px;"><?= $lingua->obter("dias")?></span>
    <div class="horas"><span id="horas" style="margin-left:-10px;margin-right: 10px;">00:00:00</span> <?= $lingua->obter('horas') ?></div>
</div>
