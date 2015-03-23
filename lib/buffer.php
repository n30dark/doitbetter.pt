<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe com um Buffer de dados
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Buffer{
	var $buffer = array();
	
	function _tornarSeguroJS($dados){
		if(is_array($dados)){
			foreach($dados as $k => $v){
				$dados[$k] = tornarSeguroJS($v);
			}
		}
		
		if(is_object($data)){
			$propriedades = get_object_vars($data);
			foreach($propriedades as $k => $v){
				$dados->$k = tornarSeguroJS($v);
			}
		}
		if(is_string($dados)){
			$dados = tornarSeguroJS($dados);
		}
		
		return $dados;
	}
	
	function adicionar($blocoBuffer, $dados, $puro = false){
		$this->buffer[$blocoBuffer] = $dados;
	}
	
	function append($blocoBuffer, $dados){
		if(array_key_exists($blocoBuffer, $this->buffer)){
			$this->buffer[$blocoBuffer] .= $dados;
		}else{
			$this->buffer[$blocoBuffer] = $dados;
		}
		
	}
	
	function toArray(){
		return $this->buffer;
	}
	
}
?>