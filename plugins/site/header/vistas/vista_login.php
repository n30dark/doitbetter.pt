<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
?>
<div class="login">
    <form>
        <label for="username"><?= $lingua->obter('username')?>:</label>
        <input type="text" name="username" />
        <label for="password"><?= $lingua->obter('password')?>:</label>
        <input type="password" name="password" />
        <input type="submit" value="<?= $lingua->obter('entrar')?>" />
    </form>
</div>