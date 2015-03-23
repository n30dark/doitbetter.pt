<?php
include 'lib/plugin.php';

class bo_old{
	
	function index($parametros){
		if((count($parametros) == 0)||((count($parametros)==1)&&(strlen($parametros[0])==0)))
			$parametros[0] = 'home';
			
		global $template;
		$template->nome='bo_old';
		global $conf;
		global $instalacao;
		$template->definirTitulo('BO :: ' . $conf['Site']['Titulo']);
		
		$template->adicionarCSS('styles/reset.css');
		$template->adicionarCSS('template/bo_old/css/bo.css');
		
		$plugin = &new GestorPlugins();
		$plugin->controlador = 'bo_old';
		$plugin->dispatch($parametros);
	}
	
	function fazerLogin(){
		$this->template->abortar = true;
		$utilizador = $_POST['Utilizador'];
		$passe = $_POST['PalavraPasse'];
		$seg = &new Seguranca();
		$ok = $seg->autenticar($utilizador, $passe);
		
		if($ok===true){
			echo '{success:true}';
		}else{
			echo '{success: false}';
		}
	}
}
?>