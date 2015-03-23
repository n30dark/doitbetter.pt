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

<div class="sub_menu">
	<div class="grid_3 linguagem">Idioma corrente: Portugu&ecirc;s</div>
	<div class="grid_5 push_5 home_data"><a href="<?= BO_URL::obterHrefInterno('bo/'); ?>">Home</a> | ter&ccedil;a-feira, 18 de Agosto de 2009<?= ''//obter_data('pt') ?></div>
</div>
<br style="margin-top:30px;"/>
<div class="grid_12 titulo">.Inicio</div>
<br style="margin-top:30px;"/>
<div class="grid_9 dados_seccao">
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/catalpha/editar/-1')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/add_product.png'?>" style="margin-top:15px;"></div>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/catalpha/listar')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/remove_product.png'?>" style="margin-top:15px;"></div>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/catalpha/listar')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/edit_product.png'?>" style="margin-top:15px;"></div>
	<div class="grid_9">&nbsp;&nbsp;Adicionar Cat. Alpha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remover Cat. Alpha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alterar Cat. Alpha</div>
	
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/emocoes/editar/-1')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/add_product.png'?>" style="margin-top:15px;"></div>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/emocoes/listar')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/remove_product.png'?>" style="margin-top:15px;"></div>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/emocoes/listar')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/edit_product.png'?>" style="margin-top:15px;"></div>
	<div class="grid_9">&nbsp;&nbsp;Adicionar Emo&ccedil;&atilde;o &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remover Emo&ccedil;&atilde;o &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alterar Emo&ccedil;&atilde;o</div>
	
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/newsletter/editar/-1')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/new_newsletter.png'?>" style="margin-top:15px;"></div>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/newsletter/listar')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/remove_newsletter.png'?>" style="margin-top:15px;"></div>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/newsletter/listar')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/edit_newsletter.png'?>" style="margin-top:15px;"></div>
	<div class="grid_9">&nbsp;&nbsp;Adicionar Newsletter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remover Newsletter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alterar Newsletter</div>
</div>
<div class="grid_4 qajuda">
	<?php $plug->dispatch(array('ajuda', 'ajuda_rapida')); ?>
</div>

