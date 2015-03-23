<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de instalação
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Instalacao{
	
	var $ficheiroInstall = 'instalacao.ini';
	var $sysbase = null;
        var $ini = null;
        var $dir_config = 'config';

        function  __construct($dir_config='config', $ficheiroInstall='instalacao.ini') {
            $this->dir_config = $dir_config;
            $this->ficheiroInstall = $ficheiroInstall;
        }

	/**
	 * Carregar o ficheiro de configuração
	 * 
	 * @param $dir_config A directoria onde se encontra o ficheiro de configuração
	 * @return Array com os dados do ficheiro de configuração
	 */
	function load(){
		if(!is_null($this->sysbase)){
			$sysbase = $this->sysbase;
		}else{
			$me = str_replace('\\', '/', dirname(__FILE__));
			$sysbase = basename(dirname($me));
		}
		
		$ficheiro = $this->dir_config .'/'. $this->ficheiroInstall;
		$this->ini = new Ini($ficheiro);
                //include_once $ficheiro;
		$tmp = $this->ini->ler();
        
        /*echo "estou no instalação: <br />";
        var_dump($tmp);*/
        
		return $tmp;
		
		//inserir dados adicionais de email, versao, etc...
	}

        function save($conf){
            if(!is_null($this->sysbase)){
                $sysbase = $this->sysbase;
            }else{
                $me = str_replace('\\', '/', dirname(__FILE__));
                $sysbase = basename(dirname($me));
            }

            $ficheiro = $this->dir_config .'/'. $this->ficheiroInstall;

            $this->ini = new Ini();
            $this->ini->ficheiro = $ficheiro;
            $this->ini->items = $conf;
            $tmp = $this->ini->salvar();
        }

	
}
?>