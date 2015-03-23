<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];

?>

<div class="apps">
    <div class="iphone">
        <div class="imagem" id="iphone"></div>
        <div class="descricao"><?= $lingua->obter('ibercup_apps')?><br />iPhone</div>
        <div class="logo" id="iphone"></div>
    </div>
    <div class="android">
        <div class="imagem" id="android"></div>
        <div class="descricao"><?= $lingua->obter('ibercup_apps')?><br />Smartphone</div>
        <div class="logo" id="android"></div>
    </div>
</div>
