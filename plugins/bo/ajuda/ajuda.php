<?php
class ajuda_plugin extends Plugin{

        function index($parametros){
            $this->template->abortar=true;

		$variaveis = new Buffer();

		$conf = $this->Conf;

		$variaveis->adicionar('conf', $conf);

		$vista = new Vista('vista_ajuda');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();

		$bloco = 'ajuda';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
        }
	
	function faq($parametros){
		$this->template->abortar=true;

		$variaveis = new Buffer();
		$xml = new BO_XML();

                $xml->ficheiro = "plugins/bo/ajuda/scripts/faq.xml";

                var_dump($xml->ficheiro);
                $faq = $xml->XMLToArray($xml->ficheiro);

                var_dump($faq);

		$conf = $this->Conf;

		$variaveis->adicionar('conf', $conf);
		$variaveis->adicionar('faq', $faq);
		
		$vista = new Vista('vista_faq');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();

		$bloco = 'faq';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
	function ajuda_rapida($parametros){
		$this->template->abortar=true;

		$variaveis = &new Buffer();

                if(isset($_POST['pesquisa'])){

                }else{

                }

		$conf = $this->Conf;

		$variaveis->adicionar('conf', $conf);

		$vista = new Vista('vista_ajuda_rapida');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();

		$bloco = 'ajuda_rapida';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
	function duvidas($parametros){
		$this->template->abortar=true;

		$variaveis = &new Buffer();
		$bd = new BaseDados();

		$tabela = $parametros[0];

		$install = $this->template->Instalacao;
		$conf = $this->Conf;

		if(!isset($install[$tabela])){
			$install = new Config();
			$install->ficheiroConfig = "default.php";
			$install = $install->load();
		}

		if(!isset($install[$tabela])){
			$install = new Instalacao();
			$install->ficheiroInstall = "ecommerce.ini";
			$install = $install->load();
		}

		$variaveis->adicionar('conf', $conf);
		$variaveis->adicionar('install', $install);
		$variaveis->adicionar('tabela', $tabela);

		$vista = new Vista('vista_listar');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();

		$bloco = 'listar';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
}