<?php
$lingua = $dados['lingua'];

?>
<div class="header">
    <?= $lingua->obter('header_finish') ?>
    <div class="buttons">
        <span class="button" id="to_step_2" link="<?= BO_URL::obterHrefInterno('install/home/index/license/').$lingua->lingua?>"><?= $lingua->obter('previous')?></span>
        <span class="button" id="to_step_2" link="<?= BO_URL::obterHrefInterno('bo')?>"><?= $lingua->obter('finish')?></span>
    </div>
</div>


<div class="inner_content">
    <div class="title"><?= $lingua->obter('finish') ?></div>
    <div class="text"><?= $lingua->obter('finish_disclaimer') ?></div>
</div>
