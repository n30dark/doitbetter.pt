<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de URL
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */
class Url{
	
	/**
	 * Ler uma url
	 * 
	 * @param $segmentos Os segmentos da url
	 * @param $chaves As chaves da url
	 */
	function lerURL($segmentos, $chaves){
		
		if(is_string($chaves)){
			$chaves = array($chaves);
		}
		
		if(is_string($segmentos)){
			$segmentos = explode('/', $segmentos);
		}
		
		$ret = array();
		$id = "none";
		$ret[$id] = '';
		foreach($keys as $key){
			$ret[$key]='';
		}
		
		foreach($segmentos as $segmento){
			if(in_array($segmento, $chaves)){
				$id = $segmento;
			}else{
				$ret[$id] .= $segmento.'/';
			}
		}
		return $ret;
	}
	
	/**
	 * Criar uma nova url
	 * 
	 * @param $segmentos Os segmentos da url
	 * @param $real Se a url corresponde a um ficheiro ou não
	 * @return A nova url
	 */
	function criarURL($segmentos, $real=false){
		global $conf;
		
		if(is_array($segmentos)){
			$segmentos = implode('/', $segmentos);
		}
		
		$base = $conf['Caminho']['Url'];
		
		if($real){
			return $base .'/'. $segmentos;
		}else{
			return $base .'/index.php/'. $segmentos;
		}
	}
	
}
?>