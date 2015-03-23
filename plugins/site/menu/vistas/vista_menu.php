<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$artigos = $dados['artigos'];
?>
<div class="menu">
    <div class="logo"></div>
    <div class="menulateral">
        <?php foreach($artigos as $artigo): ?>
        <div class="opcao"><?= $artigo->titulo ?></div>
        <?php endforeach; ?>
    </div>
</div>