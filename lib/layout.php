<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 *
 * Classe para criação e definição de layouts
 *
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Layout{

    var $ficheiro = "";
    var $caminho = "";
    var $css = "";
    var $html = "";

    function __construct($ficheiro, $caminho='estilos/site/') {
        $this->css = $caminho . $ficheiro;
    }

    function contruir(){
        if(!isset($this->css)){
            exit("ERRO: objecto Layout não criado");
        }else{
            $this->html = "";
        }
    }

}