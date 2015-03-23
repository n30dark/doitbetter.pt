<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$opcoes = $dados['opcoes'];
$pagina = $dados['pagina'];
?>
<script type="text/javascript">
    $(function(){
        $(".menu .option#<?= $pagina?>").addClass('active');
    });
</script>

<div class="menu">
    <?php foreach($opcoes as $opcao):?>
        <a href="<?= BO_URL::obterHrefInterno($opcao->aliasweb)?>" class="option" id="<?= $opcao->aliasweb ?>"><?= $opcao->titulo ?></a>|<?php endforeach; ?>
</div>