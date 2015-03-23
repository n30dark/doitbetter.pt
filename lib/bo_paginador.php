<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de Paginação
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class BO_PAGINADOR{
	
	var $estapagina;
	var $num;
	var $porpagina;
	var $mostrarcadalado;
	var $inicio;
	var $max_paginas;
	var $cur;
	var $seguinte;
	var $anterior;
	
	/**
	 * Paginar um array de dados
	 * 
	 * @param $dados O array de dados a paginar
	 * @param $perpage Número de elementos por página
	 * @param $pagina Página actual
	 * @param $eachside Número de páginas a apresentar para cada lado
	 * @param $start Página a iniciar 
	 */
	function paginar($dados, $perpage="2",$pagina , $eachside="1", $start="0"){
		
		$this->estapagina = $pagina;
		$this->num = count($dados);
		$this->porpagina = $perpage;
		$this->mostrarcadalado = $eachside;
		$this->inicio = $start*$perpage;

		$this->max_paginas = ceil($this->num/$this->porpagina);
		$this->cur = $start;
	}
	
	/**
	 * Imprimir o link para a página anterior
	 * 
	 */
	function anterior(){
		
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') )
		{
    		$browser = 'IE';
		}else{
			$browser = 'Firefox';
		}
		
		$hack = (($browser==='Firefox')?"style='display:inline-block;margin-right:2px;'":"style='margin-right:2px;'");
		
		if((($this->cur)-1)>=0){			
			echo ("<a href='".$this->estapagina."/".($this->cur-1)."' ".$hack.">&lt;</a>");
		}		
	}
	
	/**
	 * Imprimir o link para a primeira página
	 *
	 */
	function primeiro(){
	
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') )
		{
    		$browser = 'IE';
		}else{
			$browser = 'Firefox';
		}
		
		$hack = (($browser==='Firefox')?"style='display:inline-block;margin-right:2px;'":"style='margin-right:2px;'");
		
		if((($this->cur)-1)>=0){			
			echo ("<a href='".$this->estapagina."/0' ".$hack.">|&lt;</a>");
		}
	}
	
	/**
	 * Imprimir o link para a página seguinte
	 * 
	 */
	function seguinte(){
		
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') )
		{
    		$browser = 'IE';
		}else{
			$browser = 'Firefox';
		}
		
		$hack = (($browser==='Firefox')?"style='display:inline-block;'":"");
		
		if(($this->cur+1)<$this->max_paginas){
			$this->seguinte = (($this->cur)+1);
			
			echo ("<a href='".$this->estapagina."/".$this->seguinte."' ".$hack.">&gt;</a>");
		}		
	}
	
	/**
	 * Imprimir o link para a última página
	 * 
	 */
	function ultimo(){
		
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') )
		{
    		$browser = 'IE';
		}else{
			$browser = 'Firefox';
		}
		
		$hack = (($browser==='Firefox')?"style='display:inline-block;margin-left:2px;'":"style='margin-left:2px;'");
		
		if(($this->cur+1)<$this->max_paginas){
			$this->seguinte = (($this->cur)+1);
			
			echo ("<a href='".$this->estapagina."/".($this->max_paginas-1)."' ".$hack.">&gt;|</a>");
		}	
	}
	
	/**
	 * Imprimir a página actual
	 * 
	 */
	function paginaactual(){
		echo "P&aacute;gina ".$this->cur." de ".$this->max_paginas."<br />(".$this->num." registos)";
	}
	
	/**
	 * Imprimir a numeração de páginas
	 * 
	 */
	function numeracao($actual){
		$pg=1;
		
		$this->cur = $actual;
		
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') )
		{
    		$browser = 'IE';
		}else{
			$browser = 'Firefox';
		}
		
		$hack = (($browser==='Firefox')?"style='display:inline-block;'":"");
		
		$paginas = ceil($this->num/$this->porpagina)+1;
		
		$primeira = ((($this->cur)-($this->mostrarcadalado))>0)?(($this->cur)-($this->mostrarcadalado)):1;
		$ultima = ((($this->cur)+($this->mostrarcadalado))<$this->max_paginas)?(($this->cur)+($this->mostrarcadalado)):$this->max_paginas;
		
		if($primeira==$ultima) return;
		
		if($primeira>1)
		
			$hack = (($browser==='Firefox')?"style='display:inline-block;'":"");
			
			for($i=$primeira; $i<=$ultima; $i+=1){
				if($i-1==$actual){
					echo "<a href='$this->estapagina/".($i-1)."' ".$hack."class='selected'>$i</a> ";
				}else{
					echo "<a href='$this->estapagina/".($i-1)."' ".$hack.">$i</a> ";
				}
			}
		
		
	}

}