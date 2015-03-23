<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para execução de plugins
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Dispatcher{
	var $controladorPredefinido = '';
	var $funcaoPredefinida = '';
	
	var $controlador = '';
	var $funcao = '';
	var $parametros = '';
	var $caminhoBase = 'controladores';
	var $sufixoClasse = '';
	var $variaveisClasse = array();
	
	function _ler($segmentos){

                debug("Segmentos dispatcher -> _ler: [".implode($segmentos)."]", 5);
		if(array_key_exists(0, $segmentos)){
			if(strlen($segmentos[0])>0){
				$this->controlador = trim(array_shift($segmentos));
			}else{
				$this->controlador = trim($this->controladorPredefinido);
				array_shift($segmentos);
			}
		}
		
		array_key_exists(0, $segmentos) ? $this->funcao = trim(array_shift($segmentos)):$this->funcao = $this->funcaoPredefinida;
		$this->parametros = $segmentos;
	}
	
	function dispatch($segmentos){

                debug("Segmentos dispatcher -> dispatch: [".implode($segmentos)."]", 5);

		$this->_ler($segmentos);
		if(preg_match('/^_/', $this->funcao))
			die("tentou chamar uma funcao privada " . $this->funcao);
		
		$ficheiro = $this->caminhoBase.'/'.$this->controlador.'/'.$this->controlador.'.php';
		debug('ficheiro adicionado ['.$ficheiro.']...', 2);
		debug("... [$this->controlador$this->sufixoClasse] ...", 2);
		if(file_exists($ficheiro)){
			debug("... ficheiro [$ficheiro] ...", 2);
			if(!class_exists(trim($this->controlador) . trim($this->sufixoClasse))){
				debug("... controlador $this->controlador . $this->sufixoClasse - vou incluir o ficheiro ...", 2);
				include $ficheiro;
			}
		}else{
			$ficheiro = $this->caminhoBase.'/'.$this->controladorPredefinido .'/'. $this->controladorPredefinido .'.php';
			if(file_exists($ficheiro)){
				array_unshift($this->parametros, $this->funcao);
				$this->funcao = $this->controlador;
				$this->controlador = $this->controladorPredefinido;
				if(!class_exists($this->controlador . $this->sufixoClasse))
					include $ficheiro;
			}else{
				die("Ficheiro de controlador $ficheiro nao foi encontrado.");
			} 
		}
		
		$classe = trim($this->controlador) . trim($this->sufixoClasse);
		debug("... classe $classe ...", 2);
		if(class_exists($classe)){
			$obj = new $classe();

			debug("... classe existe ...", 2);
		}else{
			die("Controlador de classe '$classe' nao foi encontrado.");
		}
		
		foreach($this->variaveisClasse as $variaveis => $valor){
			$obj->$variaveis = $valor;

		}
		
		$func = $this->funcao;
		
		if(method_exists($obj, $func)){
			$obj->$func($this->parametros);
		}else{
			$func = $this->funcaoPredefinida;
			debug("... ghjkg funcao $func ...", 2);
			if(!method_exists($obj, $func)){
				die("metodo predefinido nao foi encontrado.");
			}
			
			array_unshift($this->parametros, $this->funcao);
			$obj->$func($this->parametros); 
		}
	}
	
}
?>