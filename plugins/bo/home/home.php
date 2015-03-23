<?php
class home_plugin extends Plugin{
	
	function index($parametros){
		$variaveis = new Buffer();

                $this->template->adicionarJS('js/jquery-1.3.2.min.js');
		$this->template->adicionarJS('js/jquery-ui-1.7.2.custom.min.js');
		$this->template->adicionarJS('js/jquery.easing.1.3.js');
		$this->template->adicionarJS('js/jquery.form.js');
		$this->template->adicionarJS('js/jquery.validate.js');
		$this->template->adicionarJS('js/flexigrid.js');
		$this->template->adicionarJS('js/easyTooltip.js');
		$this->template->adicionarJS('js/jquery.metadata.js');
		$this->template->adicionarJS('js/jqueryFileTree.js');
		$this->template->adicionarJS('js/menu-collapsed.js');
		$this->template->adicionarJS('js/menu.js');
		$this->template->adicionarJS('js/additional-methods.js');
		$this->template->adicionarJS('js/bofunctions.js');
		$this->template->adicionarJS('js/jquery.ajaxMultiFileUpload.js');
		$this->template->adicionarJS('js/jquery.livequery.min.js');
		$this->template->adicionarJS('js/ckeditor/ckeditor.js');
		$this->template->adicionarJS('js/dialog-patch.js');
		$this->template->adicionarJS('js/jquery.imgareaselect.js');
                $this->template->adicionarJS('js/ui.multiselect.js');
                $this->template->adicionarJS('js/jquery.jclock-1.2.0.js');
                $this->template->adicionarJS('js/jquery.tzineClock.js');
				$this->template->adicionarJS('js/jquery.flot.js');
		$this->template->adicionarJS('js/jquery.uploadify.v2.1.0.min.js');
		$this->template->adicionarJS('js/swfobject.js');
		//$this->template->adicionarJS('js/ckeditor/adapters/jquery.js');
		//$this->template->adicionarJS('js/ckeditor/_samples/sample.js');
		//$this->template->adicionarCSS('js/ckeditor/_samples/sample.css');
		$this->template->adicionarCSS('estilos/cms.css');
                $this->template->adicionarCSS('estilos/jquery.tzineClock.css');
		$this->template->adicionarCSS('estilos/flexigrid.css');
		$this->template->adicionarCSS('estilos/jquery-ui-1.7.2.custom.css');
		$this->template->adicionarCSS('estilos/jqueryFileTree.css');
		$this->template->adicionarCSS('estilos/mbContainer.css');
		$this->template->adicionarCSS('js/reditor/css/style.css');
		$this->template->adicionarCSS('estilos/imgareaselected-default.css');
		$this->template->adicionarCSS('estilos/mfu.style.css');
                $this->template->adicionarCSS('estilos/ui.multiselect.css');
                $this->template->adicionarCSS('estilos/common.css');
		$this->template->adicionarCSS('estilos/default.css');
		$this->template->adicionarCSS('estilos/uploadify.css');
		
		

                $aux = new Config();
                $aux->ficheiroConfig = 'seccoes.ini';
                $aux = $aux->load();

		if(!isset($parametros[0])){
                    $parametros[0] = 'dashboard';
                }
                $seccao = $parametros[0];
                if(!isset($parametros[1])){
                    $ops = split(',', $aux[$seccao]);
                    $parametros[1] = $ops[0];
                }
                if(!isset($parametros[2])){
                    $parametros[2] = "";
                }

		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
                $variaveis->adicionar('seccao', $parametros[0]);
                $variaveis->adicionar('subseccao', strtolower($parametros[1]));
                $variaveis->adicionar('action', $parametros[2]);

		$vista = new Vista('vista_stage');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$this->template->adicionarVista($vista, 'stage');
	}
	
	function menu($parametros){
		$variaveis = new Buffer();
		
		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
		
		$vista = new Vista('vista_menu');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'menu';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
	function home($parametros){
		$variaveis = new Buffer();
		
		$this->template->adicionarJS('plugins/bo/home/scripts/home_script.js');

                $aux = new Config();
                $aux->ficheiroConfig = 'seccoes.ini';
                $aux = $aux->load();

		if(!isset($parametros[0])){
                    $parametros[0] = 'dashboard';
                }
                $seccao = $parametros[0];
                if(!isset($parametros[1])){
                    $ops = split(',', $aux[$seccao]);
                    $parametros[1] = $ops[0];
                }

                if(!isset($parametros[2])){
                    $parametros[2] = "";
                }

		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
                $variaveis->adicionar('seccao', $parametros[0]);
                $variaveis->adicionar('subseccao', strtolower($parametros[1]));
                $variaveis->adicionar('action', $parametros[2]);
		
		$vista = new Vista('vista_home');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'home';
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
}