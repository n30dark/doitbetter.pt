<?php
$caminho = $dados['caminho'];

$QS = &new QueryString();
if(sizeof($QS->Segmentos)>1 && $QS->Segmentos[1]!=="")
	$menu = $QS->Segmentos[1];
else
	$menu = 'home';
if(sizeof($QS->Segmentos)>2 && $QS->Segmentos[2]!=="")
	$accao = $QS->Segmentos[2];
else
	$accao = 'listar';
	
switch($menu){
	case "home": $seccao="admin";break;
	case "gruposutil": $seccao="admin";break;
	case "adminutil": $seccao="admin";break;
	case "contactos": $seccao="contactos";break;
	case "catalpha": $seccao="conteudos";break;
	case "catbeta": $seccao="conteudos";break;
	case "emocoes": $seccao="conteudos";break;
	case "entregas": $seccao="conteudos";break;
	case "fornecedores": $seccao="conteudos";break;
	case "regioes": $seccao="conteudos"; break;
	case "utilizadores": $seccao="conteudos"; break;
	case "newsletter": $seccao="newsletter";break;
	case "ajuda": $seccao="ajuda";break;
	default: break;
}

?>
<script type="text/javascript">
function hov(loc,cls) { 
	if(loc.className) 
	loc.className=cls; 
}
</script>


<div class="botao_cat_<?= ($seccao=="admin")? "activo":"inactivo"; ?>">&nbsp;&nbsp;Administra&ccedil;&atilde;o</div>
	<div class="botao_<?= ($menu=="home")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="home")? "activo":"inactivo"; ?>')">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/home_small.png'?>">&nbsp;Inicio</div>
	<div class="botao_<?= ($menu=="gruposutil")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="gruposutil")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/gruposutil'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/usergroups_small.png'?>">&nbsp;Grupos</div>
	<div class="botao_<?= ($menu=="adminutil")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="adminutil")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/adminutil'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/users_small.png'?>">&nbsp;Utilizadores</div>

<div class="botao_cat_<?= ($seccao=="contactos")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_cat_activo')" onmouseout="hov(this,'botao_cat_<?= ($seccao=="contactos")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/contactos'">&nbsp;&nbsp;Contactos</div>

<div class="botao_cat_<?= ($seccao=="conteudos")? "activo":"inactivo"; ?>">&nbsp;&nbsp;Conte&uacute;dos</div>
	<div class="botao_<?= ($menu=="catalpha")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="catalpha")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/catalpha'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/product_small.png'?>">&nbsp;Categorias A</div>
	<div class="botao_<?= ($menu=="catbeta")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="catbeta")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/catbeta'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/product_small.png'?>">&nbsp;Categorias B</div>
	<div class="botao_<?= ($menu=="emocoes")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="emocoes")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/emocoes'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/product_small.png'?>">&nbsp;Emo&ccedil;&otilde;es</div>
	<div class="botao_<?= ($menu=="entregas")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="entregas")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/entregas'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/product_small.png'?>">&nbsp;Entregas</div>
	<div class="botao_<?= ($menu=="fornecedores")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="fornecedores")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/fornecedores'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/product_small.png'?>">&nbsp;Fornecedores</div>
	<div class="botao_<?= ($menu=="regioes")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="regioes")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/regioes'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/product_small.png'?>">&nbsp;Regi&otilde;es</div>
	<div class="botao_<?= ($menu=="utilizadores")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_activo')" onmouseout="hov(this,'botao_<?= ($menu=="utilizadores")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/utilizadores'">&nbsp;<img class="icon" src="<?= $this->Conf['Caminho']['Url'].'/plugins/bo/home/imgs/icons/users_small.png'?>">&nbsp;Utilizadores</div>
	

<div class="botao_cat_<?= ($seccao=="newsletter")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_cat_activo')" onmouseout="hov(this,'botao_cat_<?= ($seccao=="newsletter")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/newsletter'">&nbsp;&nbsp;Newsletter</div>

<div class="botao_cat_<?= ($seccao=="ajuda")? "activo":"inactivo"; ?>" onmouseover="hov(this,'botao_cat_activo')" onmouseout="hov(this,'botao_cat_<?= ($seccao=="ajuda")? "activo":"inactivo"; ?>')" onclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/ajuda'">&nbsp;&nbsp;Ajuda</div>



