<?php
 $htmlid = md5(microtime());
 $QS = &new QueryString();
 if(sizeof($QS->Segmentos)>4 && $QS->Segmentos[4]!=="")
	$id = $QS->Segmentos[4];
else
	$id = -1;
 
 $install = $dados['install'];
 $linguas = $dados['linguas'];
 
 
 $tabela = ucfirst($QS->Segmentos[2]); 
 if(!isset($install[$tabela]['campos'])){
 	 	$install = &new Instalacao();
 	 	$install->ficheiroInstall = 'default.ini';
 	 	$install = $install->load();
 }
 
 if(isset($install[$tabela]['tabs'])){
 	$tabs = split(',', $install[$tabela]['tabs']);
 	$tab = $tabs[0];
 }
 
 if(isset($install[$tabela]['tabof'])){
 	$tabof = $install[$tabela]['tabof'];
 	$tabs = split(',', $install[$tabela][$tabof]);
 	
 	foreach($tabs as $t){
 		if($t==$install[$tabela]['nome']){
 			$tab = $t;
 		}
 	}
 	
 }
 
 $campos = split(', ', $install[$tabela]['campos']);
 
 if(isset($install[$tabela]['tipo']) && $install[$tabela]['tipo']=='leitura'){
 	$disabled = "disabled";
 }else{
 	$disabled = "";
 }
 
 $bd = &new BaseDados();
 if($id>0){
 	$item = $bd->obterObjecto("SELECT * FROM $tabela WHERE id=$id");
 }else{
 	$item->id = -1;
 	foreach($campos as $campo){
 		switch($install[$tabela.'_'.$campo]['tipo']){
				case "varchar": $item->$campo = "";break;
				case "text": $item->$campo = "";break;
				case "date": $item->$campo = "";$type_close = "/>";break;
				case "int": $item->$campo = 0;$type_close = "/>";break;
				default: $item->$campo = "";break;
			}
 	}
	$item->Lingua = "pt";
 }
 
 $conf = &new Config();
 $conf = $conf->load();
 $caminhoBase = $conf['Caminho']['Url'];
?>

<form action="<?= $caminhoBase .'/bo/conteudo/salvar/'.$tabela.'/'. $item->id ?>" method="post" enctype="multipart/form-data" style="margin-left:10px;">
	<br style="margin-top:5px;"/>
	<?php 
		foreach($campos as $campo):
			
			$nome = $install[$tabela.'_'.$campo]['nome'];
			$valor = $item->$nome;
			
			switch($install[$tabela.'_'.$campo]['tipo']){
				
				case "varchar": $type = "<input type='text' ";$type_close = "/>";break;
				case "text": $type = "<textarea ";$type_close = ">$valor</textarea>";break;
				case "date": $type = "<input type='text' ";$type_close = "/>";break;
				case "int": $type = "<input type='text' ";$type_close = "/>";break;
				default: $type = "<input type='text' ";$type_close = "/>";break;
			}
			
			if(isset($install[$tabela.'_'.$campo]['tamanho'])){
				$tamanho = $install[$tabela.'_'.$campo]['tamanho'];
				$js = "onkeypress='js:verificarTamanho(this, $tamanho);'";
			}
			
			if(isset($install[$tabela.'_'.$campo]['classe'])){
				switch($install[$tabela.'_'.$campo]['classe']){
					
					case "password": $type = "<input type='password' ";$js = "onkeypress='verificarForca(this);'";break;
					case "telefone": $js = "onkeypress='verificaTelefone(this);'";break;
					case "user": $js= "onkeypress='verificaUser(this, '$caminhoBase');"; break;
					case "preco": $js = "onkeypress='verificaPreco(this);'";break;				}
			}
			
			if(isset($install[$tabela.'_'.$campo]['status']) && $install[$tabela.'_'.$campo]['status']=='hidden'){
				$css = "style='display:none:'";
			}else{
				$css = "";
			}
			
			
	?>
	<div style="margin-top:10px;"></div>
	<span class="label"><?= $nome?>: </span> 
	<?= "$type class='campos' name='frm$nome' id='frm$nome' value='$valor' $css $js $disabled $type_close" ?><br />
	
	<?php endforeach;?>
	<input type="text" name="tabela" value="<?= $tabela?>" style="display:none;" />
	
	<input type="text" name="tabs" value="<?= $tab?>" style="display:none" />
	
	<?php 
		for($i=1; $i<=$install[$tabela]['imagens']; $i++):
			$thumbfolder = $conf['Caminho']['Url'].'/uploads/imagens/'.strtolower($tabela).'/thumb/';
			$uploadfolder =	$conf['Caminho']['Url'].'/uploads/imagens/'.strtolower($tabela).'/';	
	?>
	<div style="margin-top:10px;"></div>
	<div style="height:50px;width:450px;">
	<div id="imgform<?=$i?>" style="display:none">
		<input type="hidden" name="thumb_<?=$i?>" value="<?= $thumbfolder?>" />
		<input type="hidden" name="upload_<?=$i?>" value="<?= $uploadfolder?>" />
		<div class="label" title="fazer upload de nova imagem">Imagem:</div>
		<input id="myUploadFile" class="myUploadFile file" type="file" name="frmimagem_<?=$i?>" onchange="" />
		<div class="responseMsg"></div>
		<ul id="response"></ul>
	</div>
	<a class="add_image" href="#" onclick="add_image(this, 'imgform<?=$i?>')" style="display:auto;">adicionar imagem</a>
	</div>
	<?php 
		endfor;
	?>
	
	<div style="margin-top:10px;"></div>
	<span class="label">Lingua: </span> 
	<select class="campos" style="width:40px;" name="frmling" id="frmling">
		<?php 
		foreach($linguas as $l){
			echo '<option value="'.$l->id.'">'.$l->cod.'</option>';
		}
		?>
	</select> <br />

	<input type="submit" value="<?= (isset($tab))?"Seguinte":"Guardar";?>">

</form>