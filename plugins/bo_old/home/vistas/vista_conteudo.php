<?php
$conf = $dados['conf'];
$install = $dados['install'];

$plug = &new GestorPlugins();
$plug->controlador = 'bo';
//$lingua = $dados['ling'];

$areas = split(',', $install['QuickMenu']['Areas']);
$icons = split(',', $install['QuickMenu']['Icons']);

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
<div class="grid_12 titulo">.Inicio</div>
<br style="margin-top:30px;"/>
<div class="grid_9 dados_seccao">
	<?php for($i=0; $i<3; $i++):?>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/'.$areas[$i].'/editar/-1')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/add_'.$icons[$i].'.png'?>" style="margin-top:15px;"></div>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/'.$areas[$i].'/listar')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/remove_'.$icons[$i].'.png'?>" style="margin-top:15px;"></div>
	<div class="grid_3 qbotao_inactivo" onmouseover="hov(this,'grid_3 qbotao_activo')" onmouseout="hov(this,'grid_3 qbotao_inactivo')" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/'.$areas[$i].'/listar')?>'"><img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/edit_'.$icons[$i].'.png'?>" style="margin-top:15px;"></div>
	<div class="grid_9">&nbsp;&nbsp;Adicionar <?= $areas[$i]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remover <?= $areas[$i]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alterar <?= $areas[$i]?></div>
	<?php endfor;?>
</div>
<div class="grid_3 qajuda" style="margin-left:0px;">
gydigscjkjfkashfjkdh
	<?php //$plug->dispatch(array('ajuda', 'ajuda_rapida')); ?>
</div>

