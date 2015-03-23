<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação/edição de ficheiros INI
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Ini{

	var $ficheiro = '';
	var $processarAccoes = true;
	var $items = array();
	var $EOL = "\n";
	
	/**
	 * Criar um novo objecto INI
	 * 
	 * @param $fich O ficheiro INI a utilizar
	 * @return unknown_type
	 */
	function Ini($fich = ''){
		$this->ficheiro = $fich;
	}
	
	/**
	 * Ler o conteúdo dos ficheiros INI
	 * 
	 * @return Um array com os conteúdos do ficheiro INI
	 */
	function ler(){
		if(is_file($this->ficheiro)){
            /*echo "$this->ficheiro<br />";
            echo file_get_contents($this->ficheiro);*/
			$this->items = parse_ini_file($this->ficheiro, $this->processarAccoes);
		}
        
        //var_dump($this->items);
                
		return $this->items;
	}
	
	/**
	 * Guardar o ficheiro INI
	 * 
	 */
	function salvar(){
		if($this->processarAccoes){
			$this->_salvarSeccoes();
		}else{
			$this->_salvarSimples();
		}
	}
	
	function _salvarSeccoes(){
		$fh = @fopen($this->ficheiro, 'w');

                if($fh){
                    foreach($this->items as $seccao => $dados){
                            echo "[$seccao]\n";
                            fwrite($fh, "[$seccao]" . $this->EOL);

                            if(is_array($dados)){
                                    foreach($dados as $chave => $valor){
                                    echo "\t$chave = \"$valor\"\n";
                                            fwrite($fh, "\t$chave = \"$valor\"" . $this->EOL);
                                    }
                            }

                    }
                    fwrite($fh, "\n");
                    fclose($fh);
                    echo "ficheiro $this->ficheiro tratado com sucesso.";
                }else{
                    echo "Erro ao abrir o ficheiro $this->ficheiro";
                }
	}
	
	function _salvarSimples(){
		$fh = fopen($this->ficheiro, 'w');
		
		foreach($this->items as $chave => $valor){
			fwrite($fh,"$chave = \"$valor\"" . $this->EOL);
		}
		fclose($fh);
	}
}
?>