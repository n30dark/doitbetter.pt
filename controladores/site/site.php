<?php
include_once 'lib/basedados.php';
include_once 'lib/plugin.php';

class Site{
	
	function index($parametros){
		global $template, $conf;
		
		$bd = new BaseDados();
		$plugin = new GestorPlugins();
		$plugin->controlador = 'site';
		
		debug("On site", 5);

		if((count($parametros)==0)||((count($parametros)==1)&&(strlen($parametros[0])==0))){
			$template->lingua = 'pt';
			$parametros[0]='home';
			$parametros[1]=$template->lingua;
			
		}else{
			$template->lingua = $parametros[0];
			$parametros[0]='home';
			$parametros[1]=$template->lingua;
		}
		
		if(array_key_exists(1, $parametros)){
			$func = $parametros[1];
		}else{
			$func = '';
		}
		
		//definir CSS e JS a colocar no site
		$template->adicionarCSS('estilos/reset.css');
		
		
		$template->PluginActual = $parametros[0];
		$template->FuncaoActual = $func;

                debug("parametros onsite: [".implode(', ',$parametros)."]", 5);

		$plugin->dispatch($parametros);
	}
}
?>