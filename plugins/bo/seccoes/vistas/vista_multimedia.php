<?php
$conf = $dados['conf'];
$subseccao = $dados['subseccao'];
$action = $dados['action'];

$p = new GestorPlugins();
$p->controlador = 'bo';

?>

<div>
	<iframe id="fileserver" src="<?= BO_URL::obterHrefInterno('plugins/bo/seccoes/scripts/index.php')?>" width="1020px" style="display:block;border:none;height:400px;" ></iframe>
</div>