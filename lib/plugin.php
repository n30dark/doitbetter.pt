<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para gestão de Plugins
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class GestorPlugins{
	var $controlador = 'site';
	var $nome = '';
	var $caminhoBase = 'plugins';
	
	/**
	 * Executar um plugin
	 * 
	 * @param $segmentos Segmentos do plugin
	 */
	function dispatch($segmentos){
		global $conf, $template, $instalacao;

		$this->nome = $segmentos[0];
		
		$disp = new Dispatcher();
		$disp->caminhoBase = 'plugins/' . $this->controlador;
		$disp->sufixoClasse = '_plugin';
		$disp->funcaoPredefinida = 'index';
		
		$caminhoBase = $this->caminhoBase .'/'. $this->controlador .'/'. $this->nome;
		$disp->variaveisClasse = array(
									  	'Conf'			=> $conf,
										'template' 		=> $template,
										'caminhoBase' 	=> $caminhoBase,
										'Instalacao' 	=> $instalacao
									);

		$disp->dispatch($segmentos);
	}
}

//-----------------------------------------------------------------------//

/**
 * AlverByte BackOffice
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação de Plugins
 * 
 * @author		Sérgio Paulino - neopaulino@gmail.com
 * @since		Version 1.0
 */
class Plugin{
	var $conf;
	var $template;
	var $caminhoBase;
	
	/**
	 * Obter o index
	 * 
	 */
	function index(){
		die ("ERRO: por favor redefina a funcao predefinida de plugin: index");
	}
}
?>