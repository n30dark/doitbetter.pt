<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para formatação de URLs
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class BO_URL{
	
	/**
	 * Adiciona o prefixo "http://" a uma url
	 * 
	 * @param $url A url a converter
	 * @return A url formatada
	 */
	function adicionarHTTP($url){
		if(preg_match('^http://', $url) !== false){
			return $url;
		}else{
			return 'http://'.$url;
		}
	}
	
	/**
	 * Remove o prefixo "http://" a uma url
	 * 
	 * @param $url A url a converter
	 * @return A url formatada
	 */
	function removerHTTP($url){
		if(preg_match('^http://', $url) !== false){
			return substr(7,$url);
		}else{
			return $url;
		}
	}
	
	/**
	 * Obter uma url interna ao site
	 * 
	 * @param $link A secção interna do site a obter
	 * @return A url interna do site
	 */
	function obterHrefInterno($link){
		global $conf;
		return $conf['Caminho']['Url'] .'/'. $link;
	}
}
?>