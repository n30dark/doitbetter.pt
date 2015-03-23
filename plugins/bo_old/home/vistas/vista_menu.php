<?php
$caminho = $dados['caminho'];
$install = $dados['install'];

$QS = &new QueryString();
if(sizeof($QS->Segmentos)>2 && $QS->Segmentos[2]!=="")
	$menu = $QS->Segmentos[2];
else
	$menu = 'home';
if(sizeof($QS->Segmentos)>3 && $QS->Segmentos[3]!=="")
	$accao = $QS->Segmentos[3];
else
	$accao = 'listar';
	
switch($menu){
	case "home": $seccao="admin";break;
	case "gruposutil": $seccao="admin";break;
	case "adminutil": $seccao="admin";break;
	case "contactos": $seccao="contactos";break;
	case "guestbook": $seccao="guestbook";break;
	case "newsletter": $seccao="newsletter";break;
	case "utilizadores": $seccao="utilizadores";break;
	case "ajuda": $seccao="ajuda";break;
	default: $seccao="conteudos";break;
}

$areas = split(',', $install['Areas']['Areas']);
foreach($areas as $area){
	if($menu==$area)	
		$seccao="conteudos";
}

?>
<script type="text/javascript">
function hov(loc,cls) { 
	if(loc.className) 
	loc.className=cls; 
}
</script>


<div class="botao_cat_<?= ($seccao=="admin")? "activo":"inactivo"; ?>">&nbsp;&nbsp;Administra&ccedil;&atilde;o</div>
	<div class="botao_<?= ($menu=="home")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="home")? "activo":"inactivo"; ?>')">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo_old/home/imgs/icons/home_small.png'?>">&nbsp;Inicio</div>
	<div class="botao_<?= ($menu=="adminutil")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="adminutil")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo_old/conteudo/utilizadores_bo'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo_old/home/imgs/icons/users_small.png'?>">&nbsp;Utilizadores</div>
	<div class="botao_<?= ($menu=="adminutil")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="adminutil")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo_old/conteudo/dados_utilizadores_bo'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo_old/home/imgs/icons/users_small.png'?>">&nbsp;Dados Utilizadores</div>

<?php if($install['Configuracao']['Contactos']):?>
<div class="botao_cat_<?= ($seccao=="contactos")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_cat_activo')" onmouseout="hov(this,'botao_cat_<?= ($seccao=="contactos")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo_old/conteudo/contactos'">&nbsp;&nbsp;Contactos</div>
<?php endif;?>

<?php if($install['Configuracao']['Guestbook']):?>
<div class="botao_cat_<?= ($seccao=="guestbook")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_cat_activo')" onmouseout="hov(this,'botao_cat_<?= ($seccao=="guestbook")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo_old/conteudo/guestbook'">&nbsp;&nbsp;Guestbook</div>
<?php endif;?>

<div class="botao_cat_<?= ($seccao=="conteudos")? "activo":"inactivo"; ?>">&nbsp;&nbsp;Conte&uacute;dos</div>
	
	<?php 
	foreach($areas as $area):
	
	?>
	<div class="botao_<?= ($menu==strtolower($area))? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu==$area)? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo_old/conteudo/<?= strtolower($install[$area]['nome'])?>'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo_old/home/imgs/icons/'.$install[$area]['icon'].'_small.png'?>">&nbsp;<?=$area?></div>
	<?php
	endforeach; 
	?>

<?php if($install['Configuracao']['Registo']):?>
<div class="botao_cat_<?= ($seccao=="utilizadores")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_cat_activo')" onmouseout="hov(this,'botao_cat_<?= ($seccao=="utilizadores")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo_old/conteudo/utilizadores'">&nbsp;&nbsp;Utilizadores</div>
<?php endif;?>
	
<?php if($install['Configuracao']['Newsletter']):?>
<div class="botao_cat_<?= ($seccao=="newsletter")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_cat_activo')" onmouseout="hov(this,'botao_cat_<?= ($seccao=="newsletter")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo_old/conteudo/newsletter'">&nbsp;&nbsp;Newsletter</div>
<?php endif;?>

<div class="botao_cat_<?= ($seccao=="ajuda")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_cat_activo')" onmouseout="hov(this,'botao_cat_<?= ($seccao=="ajuda")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo_old/ajuda'">&nbsp;&nbsp;Ajuda</div>



