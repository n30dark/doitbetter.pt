<?php
class home_plugin extends Plugin{
	
	function index($parameters){
		$variaveis = new Buffer();

                $this->template->adicionarCSS('estilos/reset.css');
		$this->template->adicionarCSS('estilos/install.css');
                $this->template->adicionarCSS('estilos/jquery.checkbox.css');

                $this->template->adicionarJS('js/jquery-1.3.2.min.js');
                $this->template->adicionarJS('js/install.js');
                $this->template->adicionarJS('js/jquery.checkbox.min.js');

                if(isset($parameters[0])){
                    $passo = $parameters[0];
                }else{
                    $passo = "idioma";
                }

                if(isset($parameters[1])){
                    $lingua = new Lingua('install','home',$parameters[1]);
                }else{
                    $lingua = new Lingua('install','home', 'pt');
                    
                    //var_dump($lingua);                    
                }

		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
                $variaveis->adicionar('lingua', $lingua);
                $variaveis->adicionar('passo', $passo);
		
		$vista = new Vista('vista_stage');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$this->template->adicionarVista($vista, 'stage');
	}

        function steps($parameters){
            $variaveis = new Buffer();

            if(isset($parameters[0])){
                    $passo = $parameters[0];
                }else{
                    $passo = "idioma";
                }

            if(isset($parameters[1])){
                    $lingua = new Lingua('install','home',$parameters[1]);
            }else{
                    $lingua = new Lingua('install','home', 'pt');
            }

            $variaveis->adicionar('conf', $this->Conf);
            $variaveis->adicionar('install', $this->template->Instalacao);
            $variaveis->adicionar('lingua', $lingua);
            $variaveis->adicionar('passo', $passo);

            $vista = new Vista('vista_steps');
            $vista->caminhoBase = $this->caminhoBase . '/vistas';
            $vista->variaveis = $variaveis->toArray();

            $bloco = "steps";
            $this->template->adicionarVista($vista, $bloco);
            $this->template->mostrarBloco($bloco);
        }

        function idioma($parameters){
            $variaveis = new Buffer();

            if(isset($parameters[1])){
                $lingua = new Lingua('install','home',$parameters[1]);
            }else{
                $lingua = new Lingua('install','home', 'pt');
            }

            $linguas_xml = new BO_XML($this->Conf['Caminho']['SistemaFicheiros'].'plugins/install/home/linguas.xml');
            $linguas = $linguas_xml->XMLToArray($linguas_xml->ficheiro, array());

            $variaveis->adicionar('lingua', $lingua);
            $variaveis->adicionar('linguas', $linguas['lingua']);
            $variaveis->adicionar('conf', $this->Conf);
            $variaveis->adicionar('install', $this->template->Instalacao);


            $vista = new Vista('vista_idioma');
            $vista->caminhoBase = $this->caminhoBase . '/vistas';
            $vista->variaveis = $variaveis->toArray();

            $bloco = 'idioma';
            $this->template->adicionarVista($vista, $bloco);
            $this->template->mostrarBloco($bloco);
        }

        function preinstall($parameters){
            $variaveis = new Buffer();

            if(isset($parameters[1])){
                $lingua = new Lingua('install','home',$parameters[1]);
            }else{
                $lingua = new Lingua('install','home', 'pt');
            }

            $checks = array();
            $checks[0] = phpversion();
            $checks[1] = extension_loaded('zlib');
            $checks[2] = extension_loaded('xml');
            $checks[3] = (function_exists('mysql_connect') || function_exists('mysqli_connect'));
            $checks[4] = (@ file_exists('../config/config.ini') && @ is_writable('../config/config.ini')) || is_writable('../');           

            $recomended = array();
            $recomended[0] = ini_get('safe_mode');
            $recomended[1] = ini_get('display_errors');
            $recomended[2] = ini_get('file_uploads');
            $recomended[3] = ini_get('magic_quotes_runtime');
            $recomended[4] = ini_get('register_globals');
            $recomended[5] = ini_get('session.auto_start');

            $variaveis->adicionar('lingua', $lingua);
            $variaveis->adicionar('conf', $this->Conf);
            $variaveis->adicionar('install', $this->template->Instalacao);
            $variaveis->adicionar('checks', $checks);
            $variaveis->adicionar('recomended', $recomended);

            $vista = new Vista('vista_preinstall');
            $vista->caminhoBase = $this->caminhoBase . '/vistas';
            $vista->variaveis = $variaveis->toArray();

            $bloco = 'preinstall';
            $this->template->adicionarVista($vista, $bloco);
            $this->template->mostrarBloco($bloco);
        }

        function recommended($parameters){
            $variaveis = new Buffer();

            if(isset($parameters[1])){
                $lingua = new Lingua('install','home',$parameters[1]);
            }else{
                $lingua = new Lingua('install','home', 'pt');
            }

            $variaveis->adicionar('lingua', $lingua);
            $variaveis->adicionar('conf', $this->Conf);
            $variaveis->adicionar('install', $this->template->Instalacao);

            $vista = new Vista('vista_recommended');
            $vista->caminhoBase = $this->caminhoBase . '/vistas';
            $vista->variaveis = $variaveis->toArray();

            $bloco = 'recommended';
            $this->template->adicionarVista($vista, $bloco);
            $this->template->mostrarBloco($bloco);
        }

        function license($parameters){
            $variaveis = new Buffer();

            if(isset($parameters[1])){
                $lingua = new Lingua('install','home',$parameters[1]);
            }else{
                $lingua = new Lingua('install','home', 'pt');
            }

            $license = BO_URL::obterHrefInterno('gnu_license/gpl.html');

            $variaveis->adicionar('lingua', $lingua);
            $variaveis->adicionar('conf', $this->Conf);
            $variaveis->adicionar('license', $license);
            $variaveis->adicionar('install', $this->template->Instalacao);

            $vista = new Vista('vista_license');
            $vista->caminhoBase = $this->caminhoBase . '/vistas';
            $vista->variaveis = $variaveis->toArray();

            $bloco = 'license';
            $this->template->adicionarVista($vista, $bloco);
            $this->template->mostrarBloco($bloco);
        }

        function bd($parameters){
            $variaveis = new Buffer();

            if(isset($parameters[1])){
                $lingua = new Lingua('install','home',$parameters[1]);
            }else{
                $lingua = new Lingua('install','home', 'pt');
            }

            $variaveis->adicionar('lingua', $lingua);
            $variaveis->adicionar('conf', $this->Conf);
            $variaveis->adicionar('install', $this->template->Instalacao);

            $vista = new Vista('vista_bd');
            $vista->caminhoBase = $this->caminhoBase . '/vistas';
            $vista->variaveis = $variaveis->toArray();

            $bloco = 'bd';
            $this->template->adicionarVista($vista, $bloco);
            $this->template->mostrarBloco($bloco);
        }

        function mainconf($parameters){
            $variaveis = new Buffer();

            if(isset($parameters[1])){
                $lingua = new Lingua('install','home',$parameters[1]);
            }else{
                $lingua = new Lingua('install','home', 'pt');
            }

            $tipo_bd = $_POST['bd_type'];
            $nome_servidor = $_POST['server_name'];
            $nome_utilizador = $_POST['bd_username'];
            $senha = $_POST['bd_password'];
            $nome_bd = $_POST['bd_name'];

            $newconf = $this->Conf;           

            $config = new Config();

            $newconf['BaseDados']['Utilizador'] = $nome_utilizador;
            $newconf['BaseDados']['PalavraPasse'] = $senha;
            $newconf['BaseDados']['Host'] = $nome_servidor;
            $newconf['BaseDados']['BaseDados'] = $nome_bd;
            $newconf['BaseDados']['TipoBD'] = $tipo_bd;

            $config->save($newconf);

            //definir novas especificações no caso de bases de dados de tipo diferente

            $bd = new BaseDados();

            
                $bd->executar("DROP DATABASE IF_EXISTS $nome_bd");

            $bd->executar("CREATE DATABASE IF NOT EXISTS $nome_bd");

            if($bd->num_ultimo_erro()!=0){
                echo "{'message':'ERRO: Falha na criação da Base de Dados: \"".$bd->desc_ultimo_erro()."\"' , 'data':'-1'}";
                BO_JAVASCRIPT::location_href(BO_URL::obterHrefInterno('install/bd/' . $lingua->lingua));
            }else{
                $variaveis->adicionar('lingua', $lingua);
            $variaveis->adicionar('conf', $this->Conf);
            $variaveis->adicionar('install', $this->template->Instalacao);

            $vista = new Vista('vista_mainconf');
            $vista->caminhoBase = $this->caminhoBase . '/vistas';
            $vista->variaveis = $variaveis->toArray();

            $bloco = 'mainconf';
            $this->template->adicionarVista($vista, $bloco);
            $this->template->mostrarBloco($bloco);

                //echo "{'message':'Base de Dados criada com sucesso.' , 'data':'0'}";
            }
        }

        function finish($parameters){
            $variaveis = new Buffer();

            $nome_site = $_POST['sitename'];
            $email = $_POST['email'];
            $senha_admin = $_POST['password'];

            $tem_registo = (isset($_POST['register']))?1:0;
            $tem_ecommerce = (isset($_POST['ecommerce']))?1:0;
            $tem_newsletter = (isset($_POST['newsletter']))?1:0;
            $tem_contacto = (isset($_POST['contact']))?1:0;
            $tem_guestbook = (isset($_POST['guestbook']))?1:0;

            $install = $this->template->Instalacao;

            $linguas = $install['Idiomas'];
            $areas = $install['Areas'];
            
            /*echo "install: <br />";
            var_dump($install);*/

            $baseDados = $this->Conf['BaseDados']['BaseDados'];

            $bd = new BaseDados();

            //Criacao de tabela de acordo com area
            $areas = explode(',', $areas['Areas']);

            foreach($areas as $area){

			
			
		$area_nome = $install[$area]['nome'];
                $area_label = $install[$area]['nome'];
		$area_imagens = $install[$area]['images'];
		$campos = explode(', ', $install[$area]['campos']);

		$bd->executar("DROP TABLE IF EXISTS $area_nome");
		echo $bd->desc_ultimo_erro()."<br /><br />";
		
		$sql = "CREATE TABLE $area_nome (
					id			INT UNIQUE AUTO_INCREMENT,";

		foreach($campos as $campo){

			$campo_nome = $install[$area.'_'.$campo]['nome'];
			$campo_tipo = $install[$area.'_'.$campo]['tipo'];

			if(isset($install[$area.'_'.$campo]['tamanho'])){
				$campo_tamanho = $install[$area.'_'.$campo]['tamanho'];
				$sql .= $campo_nome."		$campo_tipo($campo_tamanho),";
			}else{
				$sql .= $campo_nome."		$campo_tipo,";
			}
		}

		if(isset($install[$area]['log']) && $install[$area]['log']==1){
			$log_areas = array('data_criacao','criado_por','data_edicao','editado_por');
			foreach($log_areas as $logs){
				$campo_nome = $install['log_'.$logs]['nome'];
				$campo_tipo = $install['log_'.$logs]['tipo'];

				if(isset($install['log_'.$logs]['tamanho'])){
					$campo_tamanho = $install['log_'.$logs]['tamanho'];
					$sql .= $campo_nome."		$campo_tipo($campo_tamanho),";
				}else{
					$sql .= $campo_nome."		$campo_tipo,";
				}
			}
		}

		$sql .= "cod					VARCHAR(255),
				 idioma					VARCHAR(2)
				)";
		$bd->executar($sql);
		echo $bd->sql."<br />".$bd->desc_ultimo_erro()."<br /><br />";

                if($area_imagens==true){
                    $sql = "CREATE TABLE imagens_$area_nome (
					id			INT UNIQUE AUTO_INCREMENT,
                                        imagem                  VARCHAR(255),
                                        parent                  INT,
                                        cod                     VARCHAR UNIQUE
                           )";
                }

	}
	//Fim criacao de tabelas

	//insercao de tabela de linguas
	
	$bd->executar("DROP TABLE IF EXISTS idiomas");
	echo $bd->desc_ultimo_erro()."<br /><br />";
	
	$sql = "CREATE TABLE idiomas (
					id					INT UNIQUE AUTO_INCREMENT,
					nome				VARCHAR(255),
					cod					VARCHAR(2) UNIQUE
			)";
	$bd->executar($sql);
	echo $bd->desc_ultimo_erro()."<br /><br />";

	foreach($linguas as $lingua){

		$l = explode(',', $lingua);

		$sql = "INSERT IGNORE INTO idiomas(nome, cod)
					VALUES
				('".$l[0]."','".$l[1]."')";
		$bd->executar($sql);
		echo $bd->sql."<br />".$bd->desc_ultimo_erro()."<br /><br />";
	}
	//fim linguas

	//tabelas de presenca obrigatoria

	$default = array('utilizadores_bo', 'utilizadores_bo_temp', 'grupos_aut');

	if($tem_newsletter)
		array_push($default, 'newsletter_avancada', 'nl_subscritores');
        if($tem_newsletter){
                array_push($default, 'nl_grupos');
        }
	if($tem_registo){
		array_push($default, 'utilizadores', 'utilizadores_temp');
		array_push($default, 'paises');
	}
	if($tem_contacto)
		array_push($default, 'contactos');
	if($tem_guestbook)
		array_push($default, 'guestbook');


	$install = new Instalacao();
	$install->ficheiroInstall = "default.ini";
	$install = $install->load();

	$areas = $default;

	foreach($areas as $area){

		$area_nome = $install[$area]['nome'];
                $area_label = $install[$area]['label'];
                if(isset($install[$area]['images']))
                    $area_imagens = $install[$area]['images'];
		$area_num_campos = $install[$area]['num_campos'];
		$campos = explode(', ', $install[$area]['campos']);

		$bd->executar("DROP TABLE IF EXISTS $area_nome");
		echo $bd->desc_ultimo_erro()."<br /><br />";
		
	$sql = "CREATE TABLE $area_nome (
					id			INT UNIQUE AUTO_INCREMENT,";

		foreach($campos as $campo){

			$campo_nome = $install[$area.'_'.$campo]['nome'];
			$campo_tipo = $install[$area.'_'.$campo]['tipo'];

			if(isset($install[$area.'_'.$campo]['tamanho'])){
				$campo_tamanho = $install[$area.'_'.$campo]['tamanho'];
				$sql .= $campo_nome."		$campo_tipo($campo_tamanho),";
			}else{
				$sql .= $campo_nome."		$campo_tipo,";
			}
		}

		if(isset($install[$area]['log']) && $install[$area]['log']==1){
			$log_areas = array('data_criacao','criado_por','data_edicao','editado_por');
			foreach($log_areas as $logs){
				$campo_nome = $install['log_'.$logs]['nome'];
				$campo_tipo = $install['log_'.$logs]['tipo'];

				if(isset($install['log_'.$logs]['tamanho'])){
					$campo_tamanho = $install['log_'.$logs]['tamanho'];
					$sql .= $campo_nome."		$campo_tipo($campo_tamanho),";
				}else{
					$sql .= $campo_nome."		$campo_tipo,";
				}
			}
		}

		$sql .= "cod					VARCHAR(255),
                        idioma					VARCHAR(2)
			)";
		$bd->executar($sql);
		echo $bd->sql."<br />".$bd->desc_ultimo_erro()."<br /><br />";

                if($area_imagens==true){
                    $sql = "CREATE TABLE imagens_$area_nome (
					id			INT UNIQUE AUTO_INCREMENT,
                                        imagem                  VARCHAR(255),
                                        parent                  INT,
                                        cod                     VARCHAR UNIQUE
                           )";
                }

	}

	$bd->executar("INSERT IGNORE INTO utilizadores_bo(id, utilizador, password, nome, grupoaut, cod)
					VALUES(1, 'admin','".md5($senha_admin)."', 'Administrador', 1, '".md5(microtime())."')");
	//fim tabelas obrigatórias

	//tem eCommerce
	if($tem_ecommerce){
	$install = new Instalacao();
	$install->ficheiroInstall = "ecommerce.ini";
	$install = $install->load();

	$areas = $install['Areas'];

	//Criacao de tabela de acordo com area
	$num_areas = $areas['Num'];
	$areas = explode(',', $areas['Areas']);

	foreach($areas as $area){

		$area_nome = $install[$area]['nome'];
                $area_label = $install[$area]['label'];
		$area_imagens = $install[$area]['imagens'];
		$area_num_campos = $install[$area]['num_campos'];
		$campos = explode(', ', $install[$area]['campos']);
		
		$bd->executar("DROP TABLE IF EXISTS $area_nome");
		echo $bd->desc_ultimo_erro()."<br /><br />";
		
		$sql = "CREATE TABLE $area_nome (
					id			INT UNIQUE AUTO_INCREMENT,";

		foreach($campos as $campo){

			$campo_nome = $install[$area.'_'.$campo]['nome'];
			$campo_tipo = $install[$area.'_'.$campo]['tipo'];

			if(isset($install[$area.'_'.$campo]['tamanho'])){
				$campo_tamanho = $install[$area.'_'.$campo]['tamanho'];
				$sql .= $campo_nome."		$campo_tipo($campo_tamanho),";
			}else{
				$sql .= $campo_nome."		$campo_tipo,";
			}
                }

		if(isset($install[$area]['log']) && $install[$area]['log']==1){
			$log_areas = array('data_criacao','criado_por','data_edicao','editado_por');
			foreach($log_areas as $logs){
				$campo_nome = $install['log_'.$logs]['nome'];
				$campo_tipo = $install['log_'.$logs]['tipo'];

				if(isset($install['log_'.$logs]['tamanho'])){
					$campo_tamanho = $install['log_'.$logs]['tamanho'];
					$sql .= $campo_nome."		$campo_tipo($campo_tamanho),";
				}else{
					$sql .= $campo_nome."		$campo_tipo,";
				}
			}
		}

		$sql .= "cod					VARCHAR(255),
				 idioma					VARCHAR(2)
				)";
		$bd->executar($sql);
		echo $bd->sql."<br />".$bd->desc_ultimo_erro()."<br /><br />";

                $sql = "INSERT IGNORE INTO tabelas(nome, cod) VALUES('".htmlentities(utf8_decode($area_label))."','$area_nome')";
                $bd->executar($sql);
                echo $bd->sql."<br />".$bd->desc_ultimo_erro()."<br /><br />";

                if($area_imagens==true){
                    $sql = "CREATE TABLE imagens_$area_nome (
					id			INT UNIQUE AUTO_INCREMENT,
                                        imagem                  VARCHAR(255),
                                        parent                  INT,
                                        cod                     VARCHAR UNIQUE
                           )";
                }
	}
	//Fim criacao de tabelas
	}
	//fim eCommerce

        $newconf = $this->Conf;

        $config = new Config();

        $newconf['Instalacao']['Instalado'] = true;
        $newconf['modificacoes']['paginas'] = "";
        $newconf['modificacoes']['artigos'] = "";
        $newconf['modificacoes']['produtos'] = "";

        $newconf['MainConf']['Newsletter'] = $tem_newsletter;
        $newconf['MainConf']['Registo'] = $tem_registo;
        $newconf['MainConf']['Contactos'] = $tem_contacto;
        $newconf['MainConf']['Guestbook'] = $tem_guestbook;
        $newconf['MainConf']['eCommerce'] = $tem_ecommerce;

        $config->save($newconf);

         if(isset($parameters[1])){
                $lingua = new Lingua('install','home',$parameters[1]);
            }else{
                $lingua = new Lingua('install','home', 'pt');
            }

            $variaveis->adicionar('lingua', $lingua);
            $variaveis->adicionar('conf', $this->Conf);
            $variaveis->adicionar('install', $this->template->Instalacao);

            $vista = new Vista('vista_finish');
            $vista->caminhoBase = $this->caminhoBase . '/vistas';
            $vista->variaveis = $variaveis->toArray();

            $bloco = 'finish';
            $this->template->adicionarVista($vista, $bloco);
            $this->template->mostrarBloco($bloco);
        }

}