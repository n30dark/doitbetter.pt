<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação e gestão de Base de Dados
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Basedados{
	
	var $basedados;
	var $utilizador;
	var $palavrapasse;
	var $nomedohost;
	var $ligado;
	var $sql;
	var $resultado;
	var $ligacao;

	/**
	 * 
	 * Inicializa a base de dados
	 * 
	 * @param $utilizador Utilizador da passe de dados
	 * @param $host Host da base de dados
	 * @param $passe Password da base de dados
	 * @param $bd Base de dados correspondente
	 * @param $seccao_conf_bd Secção de configuração da Base de Dados no ficheiro de configuração
	 * 
	 */
	function basedados ($utilizador = null, $host = null, $passe = null, $bd = null, $seccao_conf_bd = 'BaseDados'){
		global $conf;
		
		if (!$utilizador) $utilizador = $conf[$seccao_conf_bd]['Utilizador'];
		if (!$host) $host = $conf[$seccao_conf_bd]['Host'];
		if (!$passe) $passe = $conf[$seccao_conf_bd]['PalavraPasse'];
		if (!$bd) $bd = $conf[$seccao_conf_bd]['BaseDados'];
		
		$this->basedados = $bd;
		$this->utilizador = $utilizador;
		$this->palavrapasse = $passe;
		$this->nomedohost = $host;
		
		$this->ligado = false;
		if($this->ligar()==false){
			$this->criar();
			$this->ligar();
		}
		
	}
	
	/**
	 * Termina a ligação com a BD
	 * 
	 */
	function desligar(){
		if($this->ligado) {
			mysql_close($this->ligacao);
        	$this->connected = false;	
		}
	}
	
	/**
	 * Inicia a ligação com a BD já criada
	 * 
	 */
	function ligar(){
		$this->ligacao = mysql_connect($this->nomedohost, $this->utilizador, $this->palavrapasse);
		if(!$this->ligacao){
			die('Nao foi possivel ligar: ' . mysql_error());
		}else{
			if(!mysql_select_db($this->basedados, $this->ligacao)){
				//die('select database ' . mysql_error());
				return false;
			}else{
				$this->ligado = true;
				return true;
			}
			
		}
	}
	
	/**
	 * Cria a ligação com a BD
	 * 
	 */
	function criar(){
		$this->ligacao = mysql_connect($this->nomedohost, $this->utilizador, $this->palavrapasse);
		if(!$this->ligacao){
			die('Nao foi possivel ligar: ' . mysql_error());
		}else{
			$sqlquery = "CREATE DATABASE $this->basedados"; 
			if(mysql_query($sqlquery, $this->ligacao))
				return true;
			else
				die('Nao foi possivel criar a base de dados:' . mysql_error());
		}
	}
	
	/**
	 * Adiciona uma query SQL
	 * 
	 * @param $SQL A query SQL a adicionar
	 */
	function SQL ($SQL){
		$this->sql = $SQL;
	}
	
	/**
	 * Executa uma query SQL.
	 * 
	 * Caso sql seja null executa a última query SQL adicionada
	 * 
	 * @param $sql A query SQL a executar
	 * @return false caso a Query seja inválida
	 */
	function executar ($sql=null){
		if(!is_null($sql)){
			$this->sql = $sql;
		}
		
		$this->resultado = mysql_query($this->sql, $this->ligacao);
		if(!$this->resultado)
			return false;
                else
                    return $this->resultado;
	}
	
	/**
	 * Obtém a última id de objecto obtido
	 * 
	 * @return a id do objecto
	 */
	function ultima_id(){
		return mysql_insert_id($this->ligacao);
	}
	
	/**
	 * Obtém o primeiro objecto de uma query SQL
	 * @param $sql A query a executar
	 * @return O objecto pedido, ou null caso a query seja inválida.
	 */
	function obterObjecto($sql = null){
		if(!is_null($sql)){
			$this->executar($sql);
		}
		if(!$this->resultado) return null;
		$obj = mysql_fetch_object($this->resultado);
		return $obj;
	}
	
	/**
	 * Obtém um campo de um objecto através de uma query SQL
	 * 
	 * @param $campo O campo a recuperar
	 * @param $sql A query a executar
	 * @return O campo pretendido ou null caso a query seja inválida
	 */
	function obterCampo($campo, $sql=null){
		if(!is_null($sql)){
			$this->executar($sql);
		}
		$obj = mysql_fetch_object($this->result);
		
		if($obj) {
			return $obj->{$field};
		}else{
			return null;
		}
	}
	
	/**
	 * Obtém um array de objectos através de uma query SQL
	 * 
	 * @param $sql A query a executar
	 * @return Um array de objectos ou um array vazio caso a query seja inválida
	 */
	function obterArrayObjectos($sql = null){
		if(!is_null($sql)){
			$this->executar($sql);
		}
		
		$tmp = array();
		while($obj=mysql_fetch_object($this->resultado)){
			$tmp[] = $obj;
		}
		
		return $tmp;
	}
	
	/**
	 * Obtém um array de objectos com um campo como chave através de uma query SQL
	 * 
	 * @param $sql A query a executar
	 * @param $id O campo a  atribuir como chave. Por default o id
	 * @return Um array de objectos ou um array vazio caso a query seja inválida. 
	 */
	function obterArrayObjectosComChave($sql=null, $id='id'){
		if(!is_null($sql)){
			$this->executar($sql);
		}
		
		$tmp = array();
		while($obj=mysql_fetch_object($this->resultado)){
			$tmp[$obj->{$id}]=$obj;
		}
		
		return $tmp;
	}
	
	/**
	 * Conta o número de linhas obtidas pela última query SQL
	 * 
	 * @return O número de linhas obtidas pela última query SQL
	 */
	function contar(){
		return mysql_numrows($this->resultado);
	}
	
	/**
	 * Obtém a descrição do último erro SQL
	 * 
	 * @return String contendo a descrição do último erro SQL
	 */
	function desc_ultimo_erro(){
		return mysql_error($this->ligacao);
	}
	
	/**
	 * Obtém o número do último erro SQL
	 * 
	 * @return O número do último erro sql
	 */
	function num_ultimo_erro(){
		return mysql_errno($this->ligacao);
	}
	
}

/**
 * Classe para facilitar a gestão de conteúdos da base de dados
 * 
 * Sérgio Paulino - neopaulino@gmail.com
 *
 */
class BD_Quick extends Basedados{
	
	/**
	 * Adiciona valores aos respectivos campos duma tabela
	 * 
	 * @param $tabela A tabela à qual serão adiconados os valores
	 * @param $campos Os campos a adicionar
	 * @param $valores Os valores a adicionar
	 */
	function adicionarValores($tabela, $campos, $valores){
		$this->SQL("INSERT INTO `$tabela` ($campos) VALUES($valores)");
		$this->executar();
	}
	
	/**
	 * Retorna o maior id com um determinado valor da tabela.
	 * 
	 * @param $tabela A tabela a verificar
	 * @param $valor O valor pretendido
	 * @return O id pretendido
	 */
	function idMax($tabela, $valor){
		$this->SQL("SELECT case when isnull(max($valor)) then 1 else max($valor) + 1 end FROM `$tabela`");
		$this->executar();
		$id = $this->resultado;
		return $id;
	}
	
	/**
	 * Actualiza valores nos respectivos campos da tabela
	 * 
	 * @param $tabela A tabela na qual serão actualizados os valores
	 * @param $valores Os valores a actualizar (e.g: "campo='valor', campo2='valor2'")
	 * @param $where A verificação de dados para determinar qual o objecto a actualizar (eg: "id='2'")
	 */
	function actualizarValores($tabela, $valores, $where){
		$this->SQL("UPDATE `$tabela` SET $valores WHERE $where");
		$this->executar();
	}
	
	/**
	 * Elimina um valor da tabela de acordo com a verificação de dados
	 * 
	 * @param $tabela A tabela onde se encontra o valor
	 * @param $where A verificação de dados para determinar qual o objecto a eliminar (eg: "id='2'")
	 * @return unknown_type
	 */
	function eliminar($tabela, $where){
		$this->SQL("DELETE FROM `$tabela` WHERE $where");
		$this->executar();
	}
	
	/**
	 * Obtem um array de objectos contendo os valores pretendidos de uma determinada tabela
	 * 
	 * @param $valores String contendo os valores pretendidos (eg: "(id, nome, texto)")
	 * @param $tabela A tabela a procurar
	 * @param $extras Termos extras a colocar na query SQL (eg: "WHERE id>3 ASC LIMIT 5")
	 * @return O array de objectos pretendido
	 */
	function seleccionarArrayObjectos($valores, $tabela, $extras){
		$this->SQL("SELECT $valores FROM `$tabela` $extras");
		$this->obterArrayObjectos($this->sql);
	}
	
} 

/**
 * Classe que facilita a gestão de base de dados
 * 
 * @author Sérgio Paulino - neopaulino@gmail.com
 *
 */
class Ajudante_BD extends BaseDados {
	var $tabela = '';
	var $camposRaw = array();
	
	/**
	 * Reordena os objectos contidos numa tabela
	 * 
	 * @param $onde 
	 * @param $ordem
	 * @param $idCmp
	 * @param $posicaoCmp
	 * @return unknown_type
	 */
	function reordenar($onde, $ordem='Desc' , $idCmp = 'id', $posicaoCmp = 'Posicao'){
		$items = $this->obterArrayObjectos('SELECT * FROM ' . $this->tabela . ' WHERE ' . $onde . ' ORDER BY '. $positionFld.', LastChanged ' .$ordem );
		$countador = 1 ;
		foreach ($items as $item){
			$this->executar('UPDATE ' . $this->tabela . ' SET ' . $posicaoCmp . '='. $countador++ . ' WHERE ' . $idCMP . '=' . $item->{$idCMP} .' LIMIT 1' );
		}
	}
	
	/**
	 * Guarda um conjunto de items chave/valor na base de dados definida
	 * 
	 * @param $items O conjunto de items chave/valor
	 * @param $actualizar True caso seja uma actualização de conteúdo (UPDATE), False caso sejam dados novos (INSERT)
	 * @param $valorid Id do objecto
	 * @param $idcmp Campo de id
	 * @param $prefixo_item Prefixo da chave (e.g.: frmtexto corresponde ao campo texto)
	 */
	function salvar($items, $actualizar = false, $valorid=0, $idcmp = 'id', $prefixo_item=""){
		$conf = new Config();
		$conf = $conf->load();
		$tmp = array();
		$comp_prefixo=strlen($prefixo_item);
		
		foreach($items as $chave => $valor){
			
			//echo "<script>alert('$chave: $valor')</script>";
			
			if( preg_match("^$prefixo_item^",$chave) !== false ){
				$cmp_bd = 	substr($chave,$comp_prefixo ) ;
				if( in_array($cmp_bd, $this->camposRaw)){
					$tmp['`' . $cmp_bd . '`' ] = '"'. $valor .'"';
				}else{
					$tmp['`' . $cmp_bd . '`' ] = '"' . ( htmlentities ( $valor,ENT_QUOTES,$conf['Site']['Charset']) ) .'"';	
				}
			}
		}
		
		//echo "<script>alert('$actualizar')</script>";
		
		if($actualizar){
			
 			$tmp1 = array();
			foreach($tmp as $chave => $valor){
				$tmp1[] = $chave .' = '.$valor ;
			}
			
			$sql ='
				UPDATE
				'. $this->tabela .'
				SET
				' . implode(',', $tmp1) .'
				WHERE
					'. $idcmp.' = "'. $valorid.'" 
				
				';
			
			//echo "<script>alert('UPDATE $this->tabela SET ".implode(',', $tmp1) ." WHERE $idcmp = \"$valorid\"')</script>";
			
		}else{
			$nomes = array_keys($tmp);
			$valores = array_values($tmp);
		
		
			$sql ='
				INSERT INTO
					'. $this->tabela.'
					('. implode(',', $nomes).')
				VALUES
					('. implode(',', $valores).')
			'; 
		}
		
		//echo "<script>alert('$sql')</script>";
		
		$this->executar( $sql ) ;
		
		//echo '/*'.$this->sql.'*/' ;	
	}
	
	/**
	 * Obtém um objecto e os nomes das respectivas colunas, ou caso esse não exista apenas as colunas da tabela respectiva
	 * 
	 * @param $sql A query SQL a executar
	 * @param $defaults Array de campos a obter
	 * @return unknown_type
	 */
	function obterObjectoOuColunasVazias($sql, $defaults=array()){
		$item = $this->obterObjecto($sql);
		//echo $this->sql ;
		if($this->contar() == 0) {
			$tmp = $this->obterArrayObjectos('SHOW COLUMNS FROM ' . $this->tabela);	
			foreach($tmp as $k => $cmp){
            	$item->{$cmp->Campo} = '';	
            }
            
            foreach($defaults as $k => $v){
            	$item->{$k} = $v	;
            }
		}
		
		return $item ;
	
	}
}

?>