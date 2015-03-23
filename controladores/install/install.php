<?php
include_once 'lib/basedados.php';
include_once 'lib/plugin.php';

class Install{
	
	function index($parametros){
		global $template, $conf;
		
		debug("... a inicializar controlador install ...", 2);
		$bd = new BaseDados();
		$plugin = new GestorPlugins();
		$plugin->controlador = 'install';
		
		debug("... controlador inicializado ...", 2);
		
		
		if((count($parametros)==0)||((count($parametros)==1)&&(strlen($parametros[0])==0))){
			$parametros[0]='home';
			$template->lingua = 'pt';
		}else{
			//$template->lingua = array_shift($parametros);
			if($parametros[0]=='index'){
				$parametros[0]='home';
			}
		}
		
		if(array_key_exists(1, $parametros)){
			$func = $parametros[1];
		}else{
			$func = '';
		}
		
		//definir CSS e JS a colocar no site
		$template->adicionarCSS('styles/reset.css');
		
		
		$template->PluginActual = $parametros[0];
		$template->FuncaoActual = $func;
		
		$plugin->dispatch($parametros);
	}
}
?>