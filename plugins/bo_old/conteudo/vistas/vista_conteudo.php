<?php
$conf = $dados['conf'];
$install = $dados['install'];

$plug = &new GestorPlugins();
$plug->controlador = 'bo';
//$lingua = $dados['ling'];

$QS = &new QueryString();
if(sizeof($QS->Segmentos)>3 && $QS->Segmentos[3]!=="")
	$accao = $QS->Segmentos[3];
else
	$accao = 'listar';

if(!isset($install[ucfirst($QS->Segmentos[2])])){
	$install = &new Instalacao();
 	$install->ficheiroInstall = 'default.ini';
 	$install = $install->load();
}
	
$area = $install[ucfirst($QS->Segmentos[2])];

$nome = $area['nome'];

	
?>
<script type="text/javascript">
function hov(loc,cls) { 
	if(loc.className) 
	loc.className=cls; 
}

function sel_edit()
{
var w = document.myform.sel_list.selectedIndex;
if(w==-1){
	alert("Seleccione um item para alterar.");
	return;
}
window.location.href='<?= BO_URL::obterHrefInterno('bo/conteudo/'.strtolower($nome).'/editar/')?>'+w;
}

function sel_rmv()
{
var w = document.myform.sel_list.selectedIndex;
if(w==-1){
	alert("Aten&ccedil;&atilde;","Seleccione um item para remover.");
	return;
}
window.location.href='<?= BO_URL::obterHrefInterno('bo/conteudo/'.strtolower($nome).'/remover/')?>'+w;
}
</script>

<div class="sub_menu">
	<div class="grid_3 linguagem">Idioma corrente: Portugu&ecirc;s</div>
	<?php if($accao==='listar'):?>
	<div class="grid_4" style="text-align:center">
		<?php if($nome!='Utilizadores' || $nome!='Contactos'):?>
			<img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/add_product.png'?>" class="small_ico" onclick="window.location.href='<?= BO_URL::obterHrefInterno('bo/conteudo/'.strtolower($nome).'/editar/-1')?>'">&nbsp;&nbsp;&nbsp;
		<?php endif;?>
		<img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/edit_product.png'?>" class="small_ico" onclick="sel_edit()" >&nbsp;&nbsp;&nbsp;
		<img src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/remove_product.png'?>" class="small_ico"  onclick="sel_rmv()" ></div>
	<?php endif;?>
	<div class="grid_5 <?= ($accao==='listar')? "push_1":"push_5";?> home_data"><a href="<?= BO_URL::obterHrefInterno('bo/'); ?>">Home</a> | ter&ccedil;a-feira, 18 de Agosto de 2009<?= ''//obter_data('pt') ?></div>
</div>
<br style="margin-top:30px;"/>
<div class="grid_12 titulo"><?= $nome?></div>
<br style="margin-top:30px;"/>
<div class="grid_9 dados_seccao">
	<?php 
		switch($accao){
			
			case 'listar': $plug->dispatch(array('conteudo', 'listar'));break;
			case 'editar': $plug->dispatch(array('conteudo', 'edit'));break;
			case 'remover': $plug->dispatch(array('conteudo', 'remover'));break;
			default: $plug->dispatch(array('conteudo', 'listar'));break;
		}
	?>	
</div>
<div class="grid_3 qajuda" style="margin-left:0px;">
gydigscjkjfkashfjkdh
	<?php //$plug->dispatch(array('ajuda', 'ajuda_rapida')); ?>
</div>

