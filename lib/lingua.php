<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação e gestão multilingue
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */
class Lingua{
	
	var $lingua = 'pt';
	var $items = array();
	var $controlador = 'site';
	
	/**
	 * Criação de novo objecto Língua
	 * 
	 * @param $lingua A lingua a utilizar
	 * @return unknown_type
	 */
	function  __construct($controlador, $plugin, $lingua='pt'){
                $this->controlador = $controlador;
		$this->lingua = $lingua;
                $this->carregar($plugin);
	}
	
	/**
	 * Carregar novo ficheiro de língua
	 * 
	 * @param $plugins O plugin onde se encontra o ficheiro de língua
	 */
	function carregar($plugin=""){
		$plugins = func_get_args();

		global $conf;

		
		//foreach($plugins as $plugin){
			$ficheiro = /*$conf['Caminho']['SistemaFicheiros'] .*/'plugins/' . $this->controlador .'/'. $plugin .'/ling_'. $this->lingua .'.ini';
                        //echo $ficheiro;
			debug('ficheiro utilizado ['.$ficheiro.']...',2);
			if(file_exists($ficheiro) && (is_readable($ficheiro))){
                                //echo file_get_contents($ficheiro);
				$tmp = parse_ini_file($ficheiro, true);
                                //var_dump($tmp);
				$this->items[] = $tmp;
                                unset($tmp);
			}
		//}
	}
	
	/**
	 * Obter palavra/frase
	 * 
	 * @param $caminho O nome da variável a obter
	 * @return String correspondente à variável na língua configurada
	 */
	function obter($caminho = ''){
		global $conf;

		$caminho = func_get_args();
                $caminho = $caminho[0];
                
		//var_dump($this->items);
				
		$tmp = $this->items[0][$caminho];
		
		/**foreach($caminho as $foo => $chave){
			
			if(array_key_exists($chave, $tmp)){
				$tmp = $tmp[$chave];
			}else{
				return implode('/', $caminho);
			}
		}*/
		
		return htmlentities($tmp, ENT_QUOTES, $conf['Site']['Charset']);
	}
}
?>