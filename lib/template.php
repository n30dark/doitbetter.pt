<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação e gestão de Vistas
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Vista{
	var $variaveis = array();
	var $nome = '';
	var $caminhoBase = null;
	var $abortar = false;
	
	/**
	 * Criar uma nova vista
	 * 
	 * @param $nome O nome da vista
	 */
	function vista($nome){
		$this->nome = $nome;
	}  
	
	/**
	 * Adicionar uma nova variável
	 * 
	 * @param $nome O nome da variável
	 * @param $conteudo O conteúdo da variável
	 */
	function adicionarVariavel($nome, $conteudo){
		$this->variaveis[$nome] = $conteudo;
	}
}

//--------------------------------------------------//

/**
 * AlverByte BackOffice
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação e gestão de Templates
 * 
 * @author		Sérgio Paulino - neopaulino@gmail.com
 * @since		Version 1.0
 */
class Template{
	var $blocos = array();
	var $js = array();
	var $css = array();
	var $nome = '';
	
	var $Titulo = '';
	var $charset = '';
	var $abortar = false;
	
	var $Conf = null;
	var $URLBase = null;
	var $lingua = '';
	var $Instalacao = null;
	
	var $PluginActual = null;
	var $FuncaoActual = null;
	
	/**
	 * Criar um novo Template
	 * 
	 * @param $nome O nome do template
	 */
	function Template($nome){
		$this->nome = $nome;
		$this->URL = &new Url();
	}
	
	/**
	 * Definir a url base do template
	 * 
	 * @param $url A url a colocar
	 */
	function definirURLBase($url){
		$this->URLBase = $url . '/template/' .$this->nome;	
	}
	
	/**
	 * Adicionar uma nova vista
	 * 
	 * @param $vista A vista a adicionar
	 * @param $bloco O bloco ao qual será adicionada a vista
	 */
	function adicionarVista($vista, $bloco){
		$this->blocos[$bloco][$vista->nome] = $vista;
	}
	
	/**
	 * Mostrar uma nova vista
	 * 
	 * @param $nome O nome da vista
	 * @param $bloco O nome do bloco
	 * @param $caminho O caminho da vista
	 */
	function mostrarVista($nome, $bloco, $caminho=null){
		if(array_key_exists($bloco, $this->blocos)){
			$dados = $this->blocos[$bloco][$nome]->variaveis;
			$template = $this;
			$view = $this->blocos[$bloco][$nome];
		}
		
		if(is_null($caminho)){
			debug('caminho da vista e nulo');
			
			global $conf;
			$caminho = $conf['Caminho']['SistemaFicheiros'] . '/template/' . $this->nome .'/vistas';
			debug("caminho da vista definido para $caminho");
		}
		include $caminho . '/' . $nome . '.php';
	}
	
	/**
	 * Mostrar um novo bloco
	 * 
	 * @param $nome O nome do bloco a mostrar
	 */
	function mostrarBloco($nome){
		if(!array_key_exists($nome, $this->blocos))
			return ;
		debug('dentro do mostrarBloco com ['.$nome.']',2);
		foreach($this->blocos[$nome] as $vista){
			$this->mostrarVista($vista->nome, $nome, $vista->caminhoBase);
		}
	}
	
	/**
	 * Adicionar um ficheiro JavaScript
	 * 
	 * @param $js O ficheiro javascript a adicionar
	 */
	function adicionarJS($js){
		$this->js[] = $this->URL->criarURL($js, true);
		$this->js = array_unique($this->js);		
	}
	
	/**
	 * Construir a importação de ficheiros javascript
	 * 
	 */
	function construirJS(){
		foreach($this->js as $ficheiro)		
			echo '<script type="text/javascript" src="'.$ficheiro.'" />';
	}
	
	/**
	 * Adicionar um novo ficheiro CSS
	 * 
	 * @param $css O ficheiro css a adicionar
	 */
	function adicionarCSS($css){
		$this->css[] = $this->URL->criarURL($css, true);
		$this->css = array_unique($this->css);
	}
	
	/**
	 * Construir a importação de ficheiros CSS
	 * 
	 */
	function construirCSS(){
		foreach($this->css as $ficheiro)
			echo '<link rel="stylesheet" type="text/css" href="'.$ficheiro.'" />';
	}
	
	/**
	 * Definir um novo título
	 * 
	 * @param $str O novo título
	 * @return unknown_type
	 */
	function definirTitulo($str){
		$this->titulo = $str;
	}
	
	/**
	 * Mostrar o novo template
	 * 
	 */
	function mostrar(){
		if($this->abortar===true)
			return ;
		debug('a incluir ['.$this->Conf['Caminho']['SistemaFicheiros'] .'template/'. $this->nome .'/' . $this->nome .'.php'.']', 2);
		include $this->Conf['Caminho']['SistemaFicheiros'] .'template/'. $this->nome .'/' . $this->nome .'.php';
	}
}
?>