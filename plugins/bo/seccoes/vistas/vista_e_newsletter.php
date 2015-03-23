<?php
$conf = $dados['conf'];
$subseccao = $dados['subseccao'];
$action = $dados['action'];
$lingua = $dados['lingua'];

if($subseccao=="emails")
    $subseccao = "nl_subscritores";
if($subseccao=="campanhas")
    $subseccao = "newsletter_avancada";

$p = new GestorPlugins();
$p->controlador = 'bo';

?>
<div class="title"><?= $lingua->obter($subseccao)?></div>
<div class="articles">
    <?= $p->dispatch(array('conteudo', $action, $subseccao)); ?>
</div>