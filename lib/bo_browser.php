<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de Browser
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class BO_BROWSER{

	/**
	 * Obter o browser em utilização
	 * 
	 * @return O browser em utilização
	 */
	function obter_browser(){
		
		$browser = '';
		
		if ( strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE') ){
	    	$browser = 'IE';
		}elseif( strstr($_SERVER['HTTP_USER_AGENT'], 'Firefox') ){
			$browser = 'Firefox';
		}elseif( strstr($_SERVER['HTTP_USER_AGENT'], 'Opera') ){
			$browser = 'Opera';
		}elseif( strstr($_SERVER['HTTP_USER_AGENT'], 'Chrome') ){
			$browser = 'Chrome';
		}elseif( strstr($_SERVER['HTTP_USER_AGENT'], 'Safari') ){
			$browser = 'Safari';
		}

		return $browser;
	}
	
	function obterbrowser(){
		return BO_BROWSER::obter_browser();
	}
	
}