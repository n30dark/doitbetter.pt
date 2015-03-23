<?php
    $lingua = $dados['lingua'];
    $linguas = $dados['linguas'];
?>
<div class="header">
    <?= $lingua->obter('header_idioma');?>
    <div class="buttons">
        <span class="button" id="to_step_2" link="<?= BO_URL::obterHrefInterno('install/home/index/preinstall/')?>"><?= $lingua->obter('next');?></span>
    </div>
</div>


<div class="inner_content">
    <div class="title"><?= $lingua->obter('idioma');?></div>
    <div class="text">
        <div class="disclaimer">
            <?= $lingua->obter('idioma_disclaimer');?>
        </div>
        <div class="install">
            <select name="language_select" id="language_select" size="10">
                <?php foreach($linguas as $lingua): ?>
                <option value="<?= $lingua['codigo'] ?>" <?= ($lingua['codigo']==='pt')?"selected":"";?>><?= $lingua['descricao'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>