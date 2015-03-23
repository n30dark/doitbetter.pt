<?php
    $conf = $dados['conf'];
    $lingua = $dados['lingua'];
?>
<div class="pesquisa">
    <form>
        <input type="text" name="pesquisa" />
        <input type="submit" value="<?= $lingua->obter("pesquisar") ?>" />
    </form>
</div>
