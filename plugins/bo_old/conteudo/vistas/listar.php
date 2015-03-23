<?php
	$htmlid = md5(microtime());
	$plug = &new GestorPlugins();
	$plug->controller = 'bo';
	
	$install = $dados['install'];
	
	$QS = &new QueryString();
	$tabela = ucfirst($QS->Segmentos[2]);
	 
 	if(!isset($install[$tabela]['campos'])){
 	 	$install = &new Instalacao();
 	 	$install->ficheiroInstall = 'default.ini';
 	 	$install = $install->load();
 }
	
	$campos = split(',', $install[$tabela]['campos']);
	
	$bd = &new BaseDados();
	
	$item = $bd->obterArrayObjectos("SELECT * FROM $tabela ORDER BY id");
?>
<SCRIPT LANGUAGE="JAVASCRIPT">
function edit()
   {
   var w = document.myform.sel_list.selectedIndex;
   window.location.href='<?= BO_URL::obterHrefInterno('bo/conteudo/'.$QS->Segmentos[2].'/editar/')?>'+w;
   }
</SCRIPT>

<FORM id="myform" name="myform">
	<SELECT id="sel_list" name="sel_list" ondblclick="window.location.href='<?= $this->Conf['Caminho']['Url'] ?>/bo/conteudo/<?=$QS->Segmentos[2]?>/editar/' + this.value" class="selection_grid" size="30" style="background-color:#ededed; border:none; width:500px; margin-top:10px;">
		<?php
			$j = 1;
			foreach($item as $i){
				echo '<option value="'.$i->id.'">'. $j .' - '.$i->$campos[1].'</option>';
				$j = $j + 1;
			}
		
		?>
	</SELECT>
</FORM>
<br />
