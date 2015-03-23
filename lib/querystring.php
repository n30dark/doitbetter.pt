<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de QueryString (leitura de URL)
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class QueryString{
	
	var $QueryString = '';
	var $Segmentos = array();
	var $CharsValidosURL = "/^[a-z0-9\.\-\_]*$/";
	
	/**
	 * Construir um novo objecto QS
	 * 
	 */
	function __construct(){
		$this->Ler();
	}
	
	/**
	 * Ler uma url
	 *
	 */
	function Ler(){

		$me = utf8_encode(strtolower(urldecode($_SERVER['REQUEST_URI'])));
		$WebServer_base = utf8_encode(dirname($_SERVER["SCRIPT_NAME"]));

		$regex = $GLOBALS["conf"]["Caminho"]["ServidorWeb"];

                $WebServer_base = str_replace($regex, "", $WebServer_base);
                $me = str_replace($regex, "", $me);

		$pos = strpos($me, '?');
		if($pos !== false){
			$me = substr($me, 0, $pos);
		}
		
		$me = str_replace('\\', '/', $me);
		$me = str_replace('\\', '/', $me);
		$WebServer_base = str_replace('\\', '/', $WebServer_base);
		$WebServer_base = str_replace('\\', '/', $WebServer_base);
		
		debug("Ler_1: ".$WebServer_base , 3);
		$base = $WebServer_base;
		$base = $me;//$preg_replace('^'.$WebServer_base.'^', '', $me);
		debug("Ler_2: $base" , 3);
		$base = preg_replace('^' . basename($_SERVER['SCRIPT_NAME']) . '/^', '', $base);
		debug("Ler_3: $base" , 3);
		$base = $base;//preg_replace('[/]{1}', '', $base);
		$base = substr($base, 1);
		debug("Ler_4: $base" , 3);
		
		$segmentos = explode('/', $base);

		foreach($segmentos as $segmento){                       
			if(strlen($segmento) == 0) continue;
			if(!preg_match($this->CharsValidosURL, $segmento)){
				die('A URL '. $base .' que colocou tem caracteres invalidos.');
			}
		}
		
		$this->QueryString = $base;
		$this->Segmentos = $segmentos;

	}
}
?>