<?php

class bo{
	
	function index($parametros){
		if((count($parametros) == 0)||((count($parametros)==1)&&(strlen($parametros[0])==0)))
			$parametros[0] = 'home';
			
		global $template;
		$template->nome='bo';
		global $conf;
		global $instalacao;
		$template->definirTitulo('BO :: ' . $conf['Site']['Titulo']);
		
		$template->adicionarCSS('styles/reset.css');
		$template->adicionarCSS('template/bo/css/bo.css');
		
		$plugin = new GestorPlugins();
		$plugin->controlador = 'bo';
		$plugin->dispatch($parametros);
	}
	
	function fazerLogin(){
		$this->template->abortar = true;
		$utilizador = $_POST['Utilizador'];
		$passe = $_POST['PalavraPasse'];
		$seg = new Seguranca();
		$ok = $seg->autenticar($utilizador, $passe);
		
		if($ok===true){
			echo '{success:true}';
		}else{
			echo '{success: false}';
		}
	}
}
?>