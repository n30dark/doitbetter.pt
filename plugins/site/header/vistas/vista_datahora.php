<?php
    $conf = $dados['conf'];
    $lingua = $dados['lingua'];
?>
<div class="datetime"><?= $lingua->obter(date('l')) ?>, <?= date('j') ?> <?= $lingua->obter(date('F')) ?> <?= date('Y') ?> <span class="divider">|</span> <span class="hora">00:00:00</span></div>
