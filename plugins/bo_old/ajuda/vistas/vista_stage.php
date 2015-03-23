<?php
$conf = $dados['conf'];
$plug = &new GestorPlugins();
$plug->controlador = 'bo';
//$lingua = $dados['ling'];

?>
<script type="text/javascript">
function hov(loc,cls) { 
	if(loc.className) 
	loc.className=cls; 
}
</script>

<div class="container_16 bg">
	<div class="grid_16 header">
		<div class="grid_3 logo_empresa"><img src="<?= $this->Conf['Caminho']['Url'] ?>/plugins/bo/home/imgs/logo.png" width="150px" /></div>
		<div class="grid_6 push_8 menu_sup">
		Acesso Administrador | <a href="<?= BO_URL::obterHrefInterno('bo/mudar_senha') ?>">mudar senha</a>
		<br /><span class="botao_sair_up grid_3" onmouseover="hov(this, 'botao_sair_down grid_3')" onmouseout="hov(this, 'botao_sair_up grid_3')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/login'">sair</span>	
		</div>
	</div>
	<br />
	<div class="grid_3 menu_lat">
		<?php $plug->dispatch(array('home','menu')); ?>
	</div>
	
	<div class="grid_13 conteudo" style="margin-left:0px;">
		<?php $plug->dispatch(array('ajuda', 'conteudo')); ?>
	</div>
	<br />
	<div class="grid_6 push_5 copyright">
		Produzido por <a href="http://www.alverbyte.com/" target="_blank">AlverByte</a> &copy; 2009 Todos os Direitos Reservados.
	</div>
</div>