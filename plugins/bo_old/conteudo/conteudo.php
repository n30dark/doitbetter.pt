<?php
class conteudo_plugin extends Plugin{

	function index($parametros){
		$variaveis = &new Buffer();
		
		$this->template->adicionarCSS('estilos/bo_home.css');
		$this->template->adicionarCSS('estilos/960.css');
		$this->template->adicionarJS('plugins/bo/conteudo/scripts/funcoes.js');
		
		/**
		 $lingua = &new Lingua($this->template->lingua);
		 $lingua->carregar('home');
		 */
		
		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
		//$variaveis->adicionar('ling', $this->lingua);
		
		$vista = &new Vista('vista_stage');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$this->template->adicionarVista($vista, 'stage');
	}

	function conteudo($parametros){
		$variaveis = &new Buffer();
		
		$this->template->adicionarCSS('estilos/bo_home.css');
		$this->template->adicionarCSS('estilos/960.css');
		
		/**
		 $lingua = &new Lingua($this->template->lingua);
		 $lingua->carregar('home');
		 */
		
		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
		//$variaveis->adicionar('ling', $this->lingua);
		
		$vista = &new Vista('vista_conteudo');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$caminho = $this->caminhoBase;
		$seccao = $parametros;
		$variaveis->adicionar('caminho', $caminho);
		$variaveis->adicionar('seccao', $parametros);
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'conteudo';
		$this->template->adicionarVista($vista, 'conteudo');
		$this->template->mostrarBloco('conteudo');
	}
	
	function listar($parametros){
		$this->template->abortar=true;
		
		$variaveis = &new Buffer();
		$bd = & new BaseDados();
		
		if($parametros==null){
			$lingua = 'pt';	
		}else{		
			$lingua = $parametros[0];
		}

		

		$this->template->adicionarCSS('estilos/bo_home.css');
		$this->template->adicionarCSS('estilos/960.css');

		/**$lingua = &new Lingua($this->template->lingua);
		 $lingua->carregar('catalpha');
		 */
		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
		/*$variaveis->adicionar('ling', $this->lingua);*/

		$vista = &new Vista('listar');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'listar';
		$this->template->adicionarVista($vista, 'listar');
		$this->template->mostrarBloco('listar');
	}

	function edit($parametros){
		$this->template->abortar=true;
		//$id = intval($parametros[0]);

		$bd = &new BaseDados();
		
		$linguas = $bd->obterArrayObjectos('SELECT * FROM Linguas ORDER BY Cod');
		
		$variaveis = &new Buffer();
		//$variaveis->adicionar('item', $item);
		$variaveis->adicionar('linguas', $linguas);
		$variaveis->adicionar('install', $this->template->Instalacao);
		
		$vista = &new Vista('editar');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'editar';
		$this->template->adicionarVista($vista, 'editar');
		$this->template->mostrarBloco('editar');
	}

	function salvar($parametros){
		$this->template->abortar = true;
		
		$install = $this->template->Instalacao; 
		
		$id=intval($parametros[0]);
		
		var_dump($_POST);
		
		$tabela = $_POST['tabela'];
		$tab = $_POST['tab'];
		
		if(!isset($install[$tabela])){
 			$install = &new Instalacao();
 	 		$install->ficheiroInstall = 'default.ini';
 	 		$install = $install->load();
 		}
 		
 		$campos = split(', ', $install[$tabela]['campos']);
 		$imagens = $install[$tabela]['imagens'];
 		
 		$bd = &new Ajudante_BD;
 		
 		$bd->camposRaw = array();
 		
 		foreach($campos as $campo){
 			if($install[$tabela.'_'.$campo]['tipo']=="text"){
				array_push($bd->camposRaw, 'frm'.strtolower($install[$tabela.'_'.$campo]['nome']));
 			}
 		}
		
		
		$bd->tabela = $tabela;
		
		$err_codes = array(
                   0=>"Sem erros",
                   1=>"O ficheiro exece o tamanho maximo definido na directiva upload_max_filesize definida no ficheiro php.ini",
                   2=>" ficheiro exece o tamanho maximo definido na directiva MAX_FILE_SIZE definida no formulario HTML ",
                   3=>"Ficheiro parcialmente tranferido",
                   4=>"Nenhum ficheiro transferido",
                   6=>"Pasta temporaria em falta",
                12=>"tipo de ficheio não permitido",
               666=>"Erro de sistema operativo",
               667=>"Item não encontrado no POST"
        );
		
		include_once $this->Conf['Caminho']['SistemaFicheiros'] . '/lib/upload.php';
		$up = &new Upload();
		$up->dirbase = $this->Conf['Caminho']['SistemaFicheiros'] . "/uploads/imagens/".strtolower($tabela)."/";
		
		for($i=0; $i<$imagens; $i++){
			
			$up->nomeItemPost = 'frmimagem_'.$i;
			$up->nomeFicheiroAleatorio = true;
			
			$up->fazerUpload();
			
			$err = $up->obterErro();
			
			var_dump($err);
					
			switch($err){
				case 0:
					$ficheiro = $up->novoNomeFicheiro;
					var_dump($ficheiro);
					//@unlink($up->dirbase . '\\' . $ficheiro);
					$up->redimensionar(272, 209);
					$_POST['frmimagem_'.$i] = $up->novoNomeFicheiro;
					break;
				case 4:
					break;
				default:
					echo "Erro no upload da imagem : " . $err_codes[$err];
					exit();
					break;
			}
		}
        
		if($id > 0){
			$actualizar = true;
		}else{
			$actualizar = false;
		}
		$bd->salvar($_POST, $actualizar, $id, 'id', 'frm');
		$ultimaid = $bd->ultima_id();
		
		if($bd->num_ultimo_erro() > 0){
			echo "ERRO no upload da imagem para a BD: " . $bd->desc_ultimo_erro();
			return;
		}
		
		if($tab!=""){
			echo '<script type="text/javascript">window.location.href="'. $this->Conf['Caminho']['Url'].'/bo/conteudo/'.strtolower($tab).'/editar/'.$id.'"</script>';
		}else{
			echo '<script type="text/javascript">window.location.href="'. $this->Conf['Caminho']['Url'].'/bo/conteudo/'.strtolower($tabela).'"</script>';
		}
	}

	function remover($parametros){
		$this->template->abortar=true;
		$item = $parametros[0];
		$tabela = $parametros[1];
		
		$install = $this->template->Instalacao; 
		
		if(!isset($install[$tabela])){
 			$install = &new Instalacao();
 	 		$install->ficheiroInstall = 'default.ini';
 	 		$install = $install->load();
 		}
		
 		if($install[$tabela]['imagens']>0){
 			$imagens = $install[$tabela]['imagens'];
			$dados = $bd->obterObjecto("SELECT * FROM $tabela");
			$pasta =  strtolower($tabela);
			for($i=0; $i<$imagens; $i++){
				$imagem = "imagem_$i";
				@unlink ($this->Conf['Caminho']['SistemaFicheiros'] . "/upload/imagens/$pasta/$item->$imagem");
			}
 		}
	
		$bd = &new BaseDados();
		$bd->executar("DELETE * FROM $tabela WHERE id='$item'");
	}
}
?>
