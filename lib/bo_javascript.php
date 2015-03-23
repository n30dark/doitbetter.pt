<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de JavaScript (Conversão de funções javascript em php)
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class BO_JAVASCRIPT{

	/**
	 * Função de javascript alert
	 * 
	 * @param $parameters Texto a aparecer no alert
	 */
	function alert($parameters){
		echo "<script>alert('$parameters');</script>";	
	}
	
	/**
	 * Função de redireccionamento javascript (window.location.href)
	 * 
	 * @param $parameters Url para redireccionar
	 */
	function location_href($parameters){
		
		echo "<script>window.location.href='$parameters';</script>";
	}
	
	/**
	 * Função History
	 * 
	 * @param $parameters Valor de history
	 */
	function history($parameters){
		echo "<script>window.history($parameters);</script>";
	}
}