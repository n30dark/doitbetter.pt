<?php
$lingua = $dados['lingua'];
$license = $dados['license'];
?>

<div class="header">
    <?= $lingua->obter('header_license') ?>
    <div class="buttons">
        <span class="button" id="to_step_2" link="<?= BO_URL::obterHrefInterno('install/home/index/preinstall/').$lingua->lingua?>"><?= $lingua->obter('previous')?></span>
        <span class="button" id="to_step_4" link="<?= BO_URL::obterHrefInterno('install/home/index/bd/').$lingua->lingua?>"><?= $lingua->obter('next')?></span>
    </div>
</div>


<div class="inner_content">
    <div class="title"><?= $lingua->obter('license')?></div>
    <div class="text">
        <iframe class="license_text" src="<?= $license?>">
        </iframe>
    </div>
</div>
