<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de definição de PAGETITLE
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class BO_PAGETITLE{

	var $area = "";
	var $lingua = "";
	var $pagetitle = "";
	var $metadescription = "";
	var $keywords = "";
	var $tabela = "paginas";
	
	function __construct(){
		$bd = new BaseDados();
	
		$QS = new QueryString();
	
		if(count($QS->Segmentos)>0 && $QS->Segmentos[0]!=""){
			$this->area = $QS->Segmentos[0];
			if($this->area == 'home')
				$this->area = "inicio";
			if(isset($QS->Segmentos[1]) && $QS->Segmentos[1]!="")
				$this->lingua = $QS->Segmentos[1];
			else
				$this->lingua = "pt";
			$item = $bd->obterObjecto("SELECT * FROM paginas WHERE cod='$this->area' AND idioma='$this->lingua'");
			if(!isset($item->id))
				$item = $bd->obterObjecto("SELECT * FROM artigos WHERE cod='$this->area' AND idioma='$this->lingua'");
			$this->pagetitle = $item->titulo;
			$this->metadescritption = $item->metadescription;
			$this->keywords = $item->keywords;
				
			
		}else{
			$this->area = "home";
			$this->lingua = "pt";
			
			$item = $bd->obterObjecto("SELECT * FROM paginas WHERE cod='inicio' AND idioma='$this->lingua'");
			$this->pagetitle = $item->titulo;
			$this->metadescritption = $item->metadescription;
			$this->keywords = $item->keywords;
		}
	}
	
	/**
	 * Obter o título da página
	 *
	 */
	function obterPagetitle(){
		return $this->pagetitle;	
	}	
	
	/**
	 * Obter o título da página
	 *
	 */
	function obterKeywords(){
		return $this->keywords;	
	}	
	
	/**
	 * Obter o título da página
	 *
	 */
	function obterMetadescription(){
		return $this->metadescription;	
	}	
}