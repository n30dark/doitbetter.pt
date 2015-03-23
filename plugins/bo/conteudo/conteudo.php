<?php
class conteudo_plugin extends Plugin{
	
	function listar($parametros){
		$this->template->abortar=true;
		
		$variaveis = &new Buffer();
		$bd = new BaseDados();
	
		$tabela = $parametros[0];
				
		$install = $this->template->Instalacao;
		$install = new Instalacao();
		$install->ficheiroInstall = "instalacao.ini";
		$install = $install->load();
		$conf = $this->Conf;
		
		//var_dump($install);
		
		$lingua = new Lingua('install','home','pt');
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "default.ini";
			$install = $install->load();
		}
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "ecommerce.ini";
			$install = $install->load();
		}

                $order_by  = "ORDER BY ".$install[$tabela]['order_by'];
		$sentido = "ASC";
		
		if(isset($_GET['order']))
			$order_by = "ORDER BY ".$_GET['order'];

		/*if(isset($_POST['searchon'])){
			
			$query = "1=1 ";
			if(isset($install[$tabela]['search_list']))$search = explode(", ", $install[$tabela]['search']);
			foreach($search as $s)
				$query .= "AND ".$s." LIKE  '%".$_POST[$s]."%' "
			
		}*/
			
                if(!isset($_POST['page']))
                    $page = 0;
                else
                    $page = $_POST['rp'];
                if(!isset($_POST['rp']))
                    $rp = 0;
                else
                    $rp = $_POST['rp'];

                if(!isset($_POST['query']))
                    $query = "";
                else
                    $query = $_POST['query'];
                if(!isset($_POST['qtype']))
                    $qtype = $install[$tabela]['order_by'];
                else
                    $qtype = $_POST['qtype'];

		$where = "";
		//if ($query) $where = $query;

		/*if (!$page) $page = 1;
		if (!$rp) $rp = 10;

		$start = (($page-1) * $rp);

		$limit = "LIMIT $start, $rp";*/
		$limit = "";

		if(isset($install[$tabela]['sentido'])){
			$sentido = $install[$tabela]['sentido'];
		}

		//echo "SELECT * FROM $tabela $where $order_by $sentido $limit";
		
		$conteudo = $bd->obterArrayObjectos("SELECT * FROM $tabela $where $order_by $sentido $limit");

		$total =  $this->contar("SELECT * FROM $tabela $where $order_by $sentido");

		$variaveis->adicionar('conf', $conf);
		$variaveis->adicionar('install', $install);
		$variaveis->adicionar('tabela', $tabela);
                $variaveis->adicionar('conteudo', $conteudo);
                $variaveis->adicionar('total', $total);
		$variaveis->adicionar('lingua', $lingua);
		
		$vista = new Vista('vista_listar');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'listar';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
	function ficheiros($parametros){
		$this->template->abortar=true;
		
		$variaveis = &new Buffer();
		$bd = new BaseDados();
				
		$conf = $this->Conf;
		
		$variaveis->adicionar('conf', $conf);
		
		$vista = new Vista('vista_ficheiros');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'ficheiros';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
	function listar_json($parameters){
		$this->template->abortar=true;
		
		$variaveis = &new Buffer();
		$bd = new BaseDados();
	
		$tabela = $parameters[0];
		
		$install = $this->template->Instalacao;
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "default.ini";
			$install = $install->load();
		}
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "ecommerce.ini";
			$install = $install->load();
		}
		
		$conf = $this->Conf;
		
		
		$order_by  = "ORDER BY ".$install[$tabela]['order_by'];
		$sentido = "ASC";
		
		$page = $_POST['page'];
		$rp = $_POST['rp'];
		
		$query = $_POST['query'];
		$qtype = $_POST['qtype'];
		
		$where = "";
		if ($query) $where = " WHERE $qtype LIKE '%$query%' ";
		
		if (!$page) $page = 1;
		if (!$rp) $rp = 10;

		$start = (($page-1) * $rp);
		
		$limit = "LIMIT $start, $rp";
		
		if(isset($install[$tabela]['sentido'])){
			$sentido = $install[$tabela]['sentido'];
		}
		
		$conteudo = $bd->obterArrayObjectos("SELECT * FROM $tabela $where $order_by $sentido $limit");
		
		$total =  $this->contar("SELECT * FROM $tabela $where $order_by $sentido");
		
		$campos = explode(", ", $install[$tabela]['campos']);
		
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
		header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
		header("Cache-Control: no-cache, must-revalidate" );
		header("Pragma: no-cache" );
		header("Content-type: text/x-json");
		$json = "";
		$json .= "{\n";
		$json .= "page: $page,\n";
		$json .= "total: $total,\n";
		$json .= "rows: [";
		$rc = false;
		
		foreach($conteudo as $cont){
			
			if($rc) $json .= ",";
			$json .= "\n{";
			$json .= "id: '$cont->id',";
			$json .= "cell:['$cont->id',";
			foreach($campos as $campo){	
				if($install[$tabela.'_'.$campo]['classe']!="texto"){
					$json .= "'".addslashes($cont->$campo)."',";
				}
			}
			if(isset($install[$tabela]['log']) && $install[$tabela]['log']==1){
				$json .= "'".addslashes($cont->data_criacao)."',";
				$json .= "'".addslashes($cont->criado_por)."',";
				$json .= "'".addslashes($cont->data_edicao)."',";
				$json .= "'".addslashes($cont->editado_por)."',";
			}
			$json .= "'".addslashes($cont->cod)."']";
			$json .= "}";
			$rc = true;
		}
		
		$json .= "]\n";
		$json .= "}";
		echo $json;
	}
	
	function contar($sql) {
		$bd = new BaseDados();
		$dados = $bd->obterArrayObjectos($sql);
		return $bd->contar();
	}
	
	function add($parametros){
		$this->template->abortar=true;
		
		$variaveis = new Buffer();
		$bd = new BaseDados();
	
		$tabela = $parametros[0];
		
		$install = $this->template->Instalacao;
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "default.ini";
			$install = $install->load();
		}
		
		$lingua = new Lingua('install','home','pt');
		
		$validations = new Config();
		$validations->ficheiroConfig = "validations.ini";
		$validations = $validations->load();
		
		$conf = $this->Conf;
		
		$id = -1;
		
		$item = false;
		$json = false;
		
		$item->imagens = "";
		
		$camp = explode(', ', $install[$tabela]['campos']);
		
		$campos = Array();
		
		/**foreach($camp as $campo){
			if(!isset($campos[$install[$tabela.'_'.$campo]['seccao']]) || !is_array($campos[$install[$tabela.'_'.$campo]['seccao']]))
				$campos[$install[$tabela.'_'.$campo]['seccao']] = Array();
			array_push($campos[$install[$tabela.'_'.$campo]['seccao']], $campo);
		}*/
                $campos = split(', ', $install[$tabela]['campos']);
			
		if($id>0){
			$form = "frmedit";			
		}else{
			$form = "frmnew";
		}
		$submit = "save_data";
		$form_action = BO_URL::obterHrefInterno("bo/conteudo/save/$tabela/$id");
			
		$formulario = new Formulario($form, $submit);
		
		foreach($camp as $campo){
			
			$ref = "";
			
			if(isset($install[$tabela.'_'.$campo]['ref'])){
				$t_ref = $install[$tabela.'_'.$campo]['ref'];
				$ref->dados = $bd->obterArrayObjectos("SELECT * FROM $t_ref ORDER BY nome");
				$ref->nome = $install[$tabela.'_'.$campo]['nome'];
				$ref->label = $install[$tabela.'_'.$campo]['nome'];
				if(isset($install[$tabela.'_'.$campo]['default']))
					$ref->default = $install[$tabela.'_'.$campo]['default'];
			}else{
				$ref = false;
			}
			$formulario->novoCampo($install[$tabela.'_'.$campo]['nome'], $install[$tabela.'_'.$campo]['nome'], $install[$tabela.'_'.$campo]['classe'], "", $ref);
		}
		
		$variaveis->adicionar('conf', $conf);
		$variaveis->adicionar('install', $install);
		$variaveis->adicionar('id', $id);
		$variaveis->adicionar('tabela', $tabela);
		$variaveis->adicionar('validations', $validations);
		$variaveis->adicionar('item', $item);
		$variaveis->adicionar('json', $item);
		$variaveis->adicionar('campos', $campos);
		$variaveis->adicionar('form', $form);
		$variaveis->adicionar('form_action', $form_action);
		$variaveis->adicionar('formulario', $formulario);
		$variaveis->adicionar('lingua', $lingua);
		
		$vista = new Vista('vista_editar');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'editar';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
	function edit($parametros){
		$this->template->abortar=true;
		
		$variaveis = new Buffer();
		$bd = new BaseDados();
	
		$QS = new QueryString();
		$segs = $QS->Segmentos;
	
		$tabela = $parametros[0];
		
		$install = $this->template->Instalacao;
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "default.ini";
			$install = $install->load();
		}
		
		$lingua = new Lingua('install','home','pt');
		
		$validations = new Config();
		$validations->ficheiroConfig = "validations.ini";
		$validations = $validations->load();
		
		$conf = $this->Conf;
		
		$id = $segs[count($segs)-1];
		
		$item = $bd->obterObjecto("SELECT * FROM $tabela WHERE id='$id'");
		
		$json = false;
		
		$aux = $bd->obterArrayObjectos("SELECT * FROM ".$tabela."_imagens WHERE parent='$id'");
		
		$item->imagens = "";
		
		foreach($aux as $imagem){
			$item->imagens.= $imagem->imagem .", ";
		}
		$item->imagens = substr($item->imagens, 0, -2);
		
		$camp = explode(', ', $install[$tabela]['campos']);
		
		$campos = Array();
		
		/**foreach($camp as $campo){
			if(!isset($campos[$install[$tabela.'_'.$campo]['seccao']]) || !is_array($campos[$install[$tabela.'_'.$campo]['seccao']]))
				$campos[$install[$tabela.'_'.$campo]['seccao']] = Array();
			array_push($campos[$install[$tabela.'_'.$campo]['seccao']], $campo);
		}*/
                $campos = split(', ', $install[$tabela]['campos']);
			
		if($id>0){
			$form = "frmedit";			
		}else{
			$form = "frmnew";
		}
		$submit = "save_data";
		$form_action = BO_URL::obterHrefInterno("bo/conteudo/save/$tabela/$id");
			
		$formulario = new Formulario($form, $submit);
		
		foreach($camp as $campo){
			
			$ref = "";
			
			if(isset($install[$tabela.'_'.$campo]['ref'])){
				$t_ref = $install[$tabela.'_'.$campo]['ref'];
				$ref->dados = $bd->obterArrayObjectos("SELECT * FROM $t_ref ORDER BY nome");
				$ref->nome = $install[$tabela.'_'.$campo]['nome'];
				$ref->label = $install[$tabela.'_'.$campo]['nome'];
				if(isset($install[$tabela.'_'.$campo]['default']))
					$ref->default = $install[$tabela.'_'.$campo]['default'];
			}else{
				$ref = false;
			}
			$formulario->novoCampo($install[$tabela.'_'.$campo]['nome'], $install[$tabela.'_'.$campo]['nome'], $install[$tabela.'_'.$campo]['classe'], $item->$campo, $ref);
		}
		
		$variaveis->adicionar('conf', $conf);
		$variaveis->adicionar('install', $install);
		$variaveis->adicionar('id', $id);
		$variaveis->adicionar('tabela', $tabela);
		$variaveis->adicionar('validations', $validations);
		$variaveis->adicionar('item', $item);
		$variaveis->adicionar('json', $item);
		$variaveis->adicionar('campos', $campos);
		$variaveis->adicionar('form', $form);
		$variaveis->adicionar('form_action', $form_action);
		$variaveis->adicionar('formulario', $formulario);
		$variaveis->adicionar('lingua', $lingua);
		
		$vista = new Vista('vista_editar');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'editar';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
	function save($parametros){
		$tabela = $parametros[0];
		$id = intval($parametros[2]);
		$seccao = $parametros[1];
		
		$install = $this->template->Instalacao;
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "default.ini";
			$install = $install->load();
		}
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "ecommerce.ini";
			$install = $install->load();
		}

		$bd = new Ajudante_BD();
		$bd->tabela = $tabela;
                $bd->camposRaw = Array();

                $campos = explode(', ', $install[$tabela]["campos"]);

                foreach($campos as $campo){
                    if($install[$tabela.'_'.$campo]['classe']=="multiselect"){
                        $_POST[$campo] = implode(',', $_POST[$campo]);
                    }
                    if($install[$tabela.'_'.$campo]['tipo']=="varchar" || $install[$tabela.'_'.$campo]['tipo']=="text"){
                        array_push($bd->camposRaw, $_POST[$campo]);
                    }
                }
		
		if($id>0){
			$actualizar = true;
			$aux = $bd->obterObjecto("SELECT * FROM $tabela WHERE id='$id'");
			$_POST['cod'] = $aux->cod;
		}else{
			$actualizar = false;
			$id = 0;
			if(isset($_POST['aliasweb']) && $_POST['aliasweb']!="")
				$_POST['cod'] = $_POST['aliasweb'];
			else
				$_POST['cod'] = BO_TEXTO::codificar($_POST[$install[$tabela.'_'.$campos[0]]['nome']]);
		}
		
		//BO_JAVASCRIPT::alert("teste");
		
		if(!isset($_POST['idioma'])){
			$_POST['idioma'] = $this->Conf['Site']['Lingua'];
                }
		
		//echo "<script>alert('cod: ".$_POST['cod']."');</script>";
		
		$imagens = $install[$tabela]['images'];
		$images = Array();
		//echo "<script>alert('cod: ".$_GET['images']."');</script>";
		if($imagens==true && isset($_GET['images'])){
			$images = explode(',', urldecode($_GET['images']));
		}
		
		
		
		
		
		if(isset($install[$tabela]['log']) && $install[$tabela]['log']==1){
			$aux = $bd->obterObjecto("SELECT * FROM utilizadores_bo_temp WHERE codigo='".$_COOKIE['utilizadores_bo']."'");
			$user = $aux->utilizador;
			if($actualizar){
				$_POST['editado_por'] = $user;
				$_POST['data_edicao'] = date("Y-m-d H:i:s");
			}else{
				$_POST['criado_por'] = $user;
				$_POST['data_criacao'] = date("Y-m-d H:i:s");
			}
		} 
		
		//BO_JAVASCRIPT::alert("a salvar...");

                if(isset($_GET['reup']) && $_GET['reup']==1 && !$actualizar){
                    $lastid = $bd->obterObjecto("SELECT id FROM $tabela ORDER BY id DESC");

                    $bd->executar("DELETE FROM $tabela WHERE id='$lastid->id'");
                }

                if(isset($_POST['password_confirm']))
                    unset($_POST['password_confirm']);

                if(isset($_POST['password']))
                    $_POST['password'] = md5($_POST['password']);

		$bd->salvar($_POST, $actualizar, $id);

		$lastid = $bd->obterObjecto("SELECT id FROM $tabela ORDER BY id DESC");
		foreach($images as $imagem){
			//echo "{'message':'ERRO: $imagem', 'value':'-1'}";
                        if(isset($imagem) && $imagem!="" && (($actualizar==false && isset($_GET['reup']) && $_GET['reup']==1) || $actualizar=true)){
                            $bd->executar("INSERT INTO ".$tabela."_imagens (imagem , parent) values ('$imagem',$lastid->id)");
							//echo "{'message':'ERRO: ".$bd->desc_ultimo_erro()."', 'value':'-1'}";
							if($bd->num_ultimo_erro()>0){
								$json = "{'message':'ERRO: ".$bd->desc_ultimo_erro()."', 'value':'-1'}";
							}
						}
		}
                //BO_JAVASCRIPT::alert("sql: $bd->desc_ultimo_erro()");
		
		if($bd->num_ultimo_erro()>0){
			$json = "{'message':'ERRO: ".$bd->desc_ultimo_erro()."', 'value':'-1'}";
		}else{
			$json = "{'message':'".$bd->desc_ultimo_erro()."', 'value':'0'}";
                        /*$last = $bd->obterObjecto("SELECT id FROM $tabela ORDER BY id DESC");
						                        $newconf = $this->Conf;
						
                        if($tabela=='paginas'){
                            $newconf['modificacoes']['paginas'] = $last;
                        }
                        if($tabela=='artigos'){
                            $newconf['modificacoes']['artigos'] = $last;
                        }
                        if($tabela=='produtos'){
                            $newconf['modificacoes']['produtos'] = $last;
                        }

                        $config = &new Config();
                        $config->save($newconf);*/
		}
	

		BO_JAVASCRIPT::location_href(BO_URL::obterHrefInterno('bo/home/index/'.$seccao.'/'.$tabela));		
//		echo $json;
		return;
	}
	
	function delete($parametros){
		$item = $parametros[1];
		$tabela = $parametros[0];
		
		$bd = &new BaseDados();
		
		$install = $this->template->Instalacao;
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "default.ini";
			$install = $install->load();
		}
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "ecommerce.ini";
			$install = $install->load();
		}
		
		if($install[$tabela]['images']){
			$dados = $bd->obterObjecto("SELECT * FROM imagens_".$tabela." WHERE parent='$item'");
			foreach($dados as $dado){
				$imagem = "imagem";
				@unlink ($this->Conf['Caminho']['SistemaFicheiros'] . "/upload/imagens/$tabela/$dado->$imagem");			
				$bd->executar("DELETE FROM imagens_".$tabela." WHERE id='".$dado->id."'");
			}
		}

		$bd->executar("DELETE FROM $tabela WHERE id='$item'");        
	}
	
	function moveup($parametros){
		$id = $parametros[1];
		$tabela = $parametros[0];
		
		$bd = new BaseDados();
		
		$install = $this->template->Instalacao;
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "default.ini";
			$install = $install->load();
		}
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "ecommerce.ini";
			$install = $install->load();
		}
		
		$item = $bd->obterObjecto("SELECT * FROM $tabela WHERE id='$id'");
		$ordem = $item->ordem+1;
		
		$bd->executar("UPDATE $tabela SET ordem='$ordem' WHERE id='$id'");

                echo $bd->sql;
	}
	
	function movedown($parametros){
		$id = $parametros[1];
		$tabela = $parametros[0];
		
		$bd = new BaseDados();
		
		$install = $this->template->Instalacao;
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "default.ini";
			$install = $install->load();
		}
		
		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "ecommerce.ini";
			$install = $install->load();
		}
		
		$item = $bd->obterObjecto("SELECT * FROM $tabela WHERE id='$id'");
		$ordem = $item->ordem-1;
		
		$bd->executar("UPDATE $tabela SET ordem='$ordem' WHERE id='$id'");

                echo $bd->sql;
	}

        function configuracao($parametros){
		$this->template->abortar=true;

                $validations = new Config();
		$validations->ficheiroConfig = "validations.ini";
		$validations = $validations->load();

		$variaveis = new Buffer();
		$conf = $this->Conf;
		$json = false;

		$campos = Array("Titulo", "Lingua", "Desc", "PalavrasChave", "Categoria", "Autor", "Copyright", "Email", "Twitter", "Hi5", "Facebook", "Paypal");
                $campos_label = Array("Título", "Língua", "Descrição", "Palavras Chave", "Categoria", "Autor", "Copyright", "Email", "Twitter", "Hi5", "FaceBook", "Paypal");
                $campos_classe = Array("nome", "nome", "simpletext", "simpletext", "simpletext", "dados", "dados", "email", "dados", "dados", "dados", "email");

		$tabs = "";

		$form = "frmedit";
		$submit = "save_config";
		$form_action = BO_URL::obterHrefInterno("bo/conteudo/save_config");

		$formulario = new Formulario($form, $submit);

		for($i=0; $i<count($campos); $i++){

			$ref = false;
			$valor = $conf["Site"][$campos[$i]];

			$formulario->novoCampo($campos[$i], $campos_label[$i], $campos_classe[$i], $valor, $ref);
		}

		$variaveis->adicionar('conf', $conf);
		$variaveis->adicionar('validations', $validations);
		$variaveis->adicionar('json', $json);
		$variaveis->adicionar('campos', $campos);
		$variaveis->adicionar('form', $form);
		$variaveis->adicionar('form_action', $form_action);
		$variaveis->adicionar('formulario', $formulario);

		$vista = new Vista('vista_configuracao');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();

		$bloco = 'configuracao';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}

        function save_config(){

            $config = new Config();
            $items = $config->load();
            $ini = $config->ini;

            $items["Site"]["Titulo"] = $_POST["Titulo"];
            $items["Site"]["Lingua"] = $_POST["Lingua"];
            $items["Site"]["Desc"] = $_POST['Desc'];
            $items["Site"]["PalavrasChave"] = $_POST['PalavrasChave'];
            $items["Site"]["Categoria"] = $_POST['Categoria'];
            $items["Site"]["Autor"] = $_POST["Autor"];
            $items["Site"]["Copyright"] = $_POST["Copyright"];
            $items["Site"]["Email"] = $_POST["Email"];
            $items["Site"]["Twitter"] = $_POST["Twitter"];
            $items["Site"]["Hi5"] = $_POST["Hi5"];
            $items["Site"]["Facebook"] = $_POST["Facebook"];
            $items["Site"]["Paypal"] = $_POST["Paypal"];

            $ini->items = $items;
            $ini->salvar();
        }

        function upload_file(){
            $caminho = $this->Conf['Caminho']['SistemaFicheiros']."uploads\\ficheiros\\".basename( $_FILES['uploadedfile']['name']);
            if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
                echo "The file ".  basename( $_FILES['uploadedfile']['name']).
                " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }

        }

        function delete_file(){
            @unlink ($this->Conf['Caminho']['SistemaFicheiros'].$_POST['ficheiro']);
            echo "File deleted";
        }

        function aprovar_curriculo($parametros){
                $item = $parametros[1];

		$bd = new BaseDados();

                $aux = $bd->obterObjecto("SELECT * FROM utilizadores_bo_temp WHERE codigo='".$_COOKIE['utilizadores_bo']."'");
                $user = $aux->utilizador;

		$bd->executar("UPDATE  curriculos SET aprovacao='aprovado', editado_por='$user', data_edicao=NOW() WHERE id='$item'");

                echo $bd->sql;

                $aluno = $bd->obterObjecto("SELECT * FROM curriculos WHERE id='$item'");

                $to = $aluno->email;
                $subject = "Curriculo Informania 2010";
                $body = "<p>Olá $aluno->nome!</p>
                        <p>O teu currículo foi aceite para a Informania 2010. Será entregue junto com os restantes às empresas participantes.</p>
                        <p>Obrigado por participares.</p>
                        <p>A organização da Informania 2010,<br />CADI FCUL</p>";
                if (mail($to, $subject, $body)) {
                    //echo("<p>Message successfully sent!</p>");
                } else {
                    //echo("<p>Message delivery failed...</p>");
                }
        }

        function rejeitar_curriculo($parametros){
                $item = $parametros[1];

		$bd = new BaseDados();

                $aux = $bd->obterObjecto("SELECT * FROM utilizadores_bo_temp WHERE codigo='".$_COOKIE['utilizadores_bo']."'");
                $user = $aux->utilizador;

		$bd->executar("UPDATE curriculos SET aprovacao='rejeitado', editado_por='$user', data_edicao=NOW() WHERE id='$item'");

                $aluno = $bd->obterObjecto("SELECT * FROM curriculos WHERE id='$item'");

                $to = $aluno->email;
                $subject = "Curriculo Informania 2010";
                $body = "<p>Olá $aluno->nome!</p>
                        <p>O teu currículo não foi aceite para a Informania 2010. Por favor verifica se os dados enviados estão correctos.</p>
                        <p>Obrigado por participares.</p>
                        <p>A organização da Informania 2010,<br />CADI FCUL</p>";
                if (mail($to, $subject, $body)) {
                    //echo("<p>Message successfully sent!</p>");
                } else {
                    //echo("<p>Message delivery failed...</p>");
                }
        }

	function exportar_contactos(){
		$item = $parametros[1];
		$tabela = $parametros[0];
		$bd = new BaseDados();
		/**header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=contactos.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		*/

		$fh = fopen("uploads/contactos.csv", "w");
		fputs($fh, "Email\n");
		$contactos = $bd->obterArrayObjectos('SELECT * FROM nl_subscritores');
		foreach($contactos as $contacto){
			$email = $contacto->email;
			fputs($fh, $email."\n");
		}
		fclose($fh);

                header("Pragma: public"); // required
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false); // required for certain browsers
                header("Content-Type: application/octet-stream");
                // change, added quotes to allow spaces in filenames, by Rajkumar Singh
                header("Content-Disposition: attachment; filename=\"".basename("uploads/contactos.csv")."\";" );
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: ".filesize("uploads/contactos.csv"));
                readfile("uploads/contactos.csv");
                exit();
		echo '<script type="text/javascript">window.open("'. $this->Conf['Caminho']['Url'].'/uploads/contactos.csv");</script>';
		echo "{'message':'Newsletter enviada com sucesso!', 'value':'0'}";
		return;
	}

	function importar_contactos(){
		$this->template->abortar=true;
		$item = $parametros[1];
		$tabela = $parametros[0];

                $bd = new BaseDados();

		$csvfile = $_FILES[csvfile]["tmp_name"];
		$csvfile = stripslashes($csvfile);
		if($csvfile != "") {
		$fh = fopen($csvfile,"r");
		$nr_registos = 0;
		while ($line = fgetcsv($fh,5000,",")){
			$email = $line[0];
			if ($email != 'Email') {

                            if($bd->obterUm("SELECT count(id) FROM nl_subscritores WHERE email='$email'")==0){

                                $sql = "
					insert into nl_subscritores (email)
					values ('$email')
				";
				mysql_query($sql);
				$nr_registos++;
                            }
			}
		}
		echo "{'message':'Foram importados $nr_registos registos.', 'value':'0'}";
		fclose($fh);

	} else {
		echo "{'message':'O ficheiro não foi encontrado.', 'value':'0'}";
	}


	}

        function ver_curriculo($parametros){
                $item = $parametros[1];

		$bd = new BaseDados();

                $aluno = $bd->obterObjecto("SELECT * FROM curriculos WHERE id='$item'");

                //echo "<script>window.open('".BO_URL::obterHrefInterno("uploads/imagens/curriculos/$aluno->numero.pdf")."', 'Curriculo de $aluno->nome')</script>";

                header("Pragma: public"); // required
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false); // required for certain browsers
                header("Content-Type: application/pdf");
                // change, added quotes to allow spaces in filenames, by Rajkumar Singh
                header("Content-Disposition: attachment; filename=\"".basename("uploads/imagens/curriculos/$aluno->numero.pdf")."\";" );
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: ".filesize("uploads/imagens/curriculos/$aluno->numero.pdf"));
                readfile("uploads/imagens/curriculos/$aluno->numero.pdf");
                exit();
		return;
        }
        
        
}