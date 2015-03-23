<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação e gestão de um Carrinho de Compras
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class phpCart{
	
	var $nome_cart;
	var $items = array();
	var $bd;
	var $cheque_thumb = '../';
	var $conf;
	var $produtos = "produtos";
	
	/**
	 * Construir um novo carrinho
	 * 
	 * @param $conf Variável global Conf
	 * @param $nome Nome do carrinho
	 * @return unknown_type
	 */
	function __construct($conf, $nome=""){
		$this->nome_cart = $nome;
		
		$this->conf = $conf;
	}
	
	/**
	 * Adicionar novo Produto
	 * 
	 * @param $ref A referência do produto
	 * @param $quantidade A quantidade a adicionar
	 */
	function adicionarProduto($ref, $quantidade){
		
		$bd = new BaseDados();
		
		if(isset($this->items[$ref])){
			$item = $this->items[$ref];
			$item->quantidade += 1;
		}else{
			$item = null;
			$it = $bd->obterObjecto("SELECT * FROM $produtos WHERE ref = '$ref'");			
			
			$item->ref = $it->ref;
			$item->nome = $it->titulo;
			$item->preco = $it->preco;
			$item->thumb = $this->conf.'/uploads/imagens/emocoes/'.$it->imagem;
			$item->quantidade = 1;
			$this->items[$ref] = $item;
		}
		
	}
	
	
	/**
	 * Adicionar novo Cheque
	 * 
	 * @param $valor O valor do cheque
	 * @param $ref A referêcnia do Cheque
	 */
	function adicionarCheque($valor, $ref){
		
		foreach($this->items as $item){
			if($item->nome==('Cheque Prenda &euro;'.$valor)){
				$item->quantidade += 1;
				return;
			}
		}
		
		$item = null;
		$item->ref = $ref;
		$item->nome = 'Cheque Prenda &euro;'.$valor;
		$item->preco = $valor;
		$item->thumb = $this->cheque_thumb;
		$item->quantidade = 1;
		$this->items[$ref] = $item;
	}
	
	/**
	 * Remover um produto
	 * 
	 * @param $ref A referência do produto a retirar
	 */
	function removerProduto($ref){
		if(isset($this->items[$ref])){
			$item = $this->items[$ref];
			$item->quantidade -= 1;
			
			if($item->quantidade<=0){
				unset($this->items[$ref]);
			}else{
				$this->items[$ref] = $item;
			}
		}
	}		

	/**
	 * Obter o preço de um item
	 * 
	 * @param $ref A referência do item a obter
	 * @return O preço do item
	 */
	function obterPrecoItem($ref){
		if(isset($this->items[$ref])){
			$item = $this->items[$ref];		
			return $item->preco;
		}else{
			return 0;
		}
	}
	
	/**
	 * Obter o nome de um item 
	 * 
	 * @param $ref A referência do item a obter
	 * @return O nome do item a obter
	 */
	function obterNomeItem($ref){
		
		$item = $this->items[$ref];		
		return $item->nome;
	}
	
	/**
	 * Obter os items do carrinho
	 * 
	 * @return Os items do carrinho
	 */
	function obterItems(){
		return $this->items;
	}
	
	/**
	 * Obter a quantidade de um determinado item no carrinho
	 * 
	 * @param $ref A referência do item
	 * @return A quantidade do item
	 */
	function obterQuantidadeItems($ref){
		
		if(isset($this->items[$ref])){
			$item = $this->items[$ref];
			return $item->quantidade;
		}else{
			return 0;
		}
				
	}
	
	/**
	 * Obter o valor total de um item no carrinho
	 * 
	 * @param $ref A referência do item
	 * @return O valor total do item no carrinho
	 */
	function obterTotalItem($ref){
		if(isset($this->items[$ref])){
			$item = $this->items[$ref];
			return (($item->preco)*($item->quantidade));
		}else{
			return 0;
		}
	}
	
	/**
	 * Obter o total do carrinho
	 * 
	 * @return O total do carrinho
	 */
	function obterTotal(){
		$total = 0.0;
		foreach($this->items as $item){
			$total += (($item->preco)*($item->quantidade));
		}
		
		return $total;
	}
	
	/**
	 * Obter o total de items no carrinho
	 * 
	 * @return O total de items no carrinho
	 */
	function obterTotalItems(){
		$total = 0;
		foreach($this->items as $item){
			$total += $item->quantidade;
		}
		
		return $total;
		
	}
	
	/**
	 * Limpar o carrinho
	 * 
	 */
	function limparCart(){
		foreach($this->items as $item){
			unset($this->items[$item->ref]);
		}
	}
	
	/**
	 * Imprimir um item do carrinho
	 * 
	 * @param $ref A referência do item do carrinho
	 * @return O item a imprimir (com a devida formatação)
	 */
	function imprimirItem($ref){
		
		$item = $this->items[$ref];

		$result = "<td><div class='itemContainer' id='itemContainer_$item->ref'>
					<div class='itemName'>".BO_TEXTO::cortar_texto($item->nome, 25)."</div>
					<div class='itemImage'>
						<img src='$item->thumb' height='75px' />
					</div>
					<div style='display:block; width:100px;'>
						<div class='itemQuantity' style='float:left;'>
							<input id='quant_$item->ref' type='text' value='$item->quantidade' />
						</div>
						<div style='float:left;'>
							<div class='itemincrement'>
								<a href='#' onclick='incrementar(\"$item->ref\", \"".$this->conf."\")'>+</a>
							</div>
							<div class='itemdecrement'>
								<a href='#' onclick='decrementar(\"$item->ref\", \"".$this->conf."\")'>-</a>
							</div>
						</div>
					</div>
					<div class='itemTotal' id='itemTotal_$ref' >&euro;".($item->preco*$item->quantidade)."</div>
				  </div></td>";
		return $result;
	}
	
	/**
	 * Imprimir o carrinho
	 * 
	 * @return O carrinho com a devida formatação
	 */
	function imprimirCart(){
		
		$result = "";
		foreach($this->items as $item){
			$result .= $this->imprimirItem($item->ref);
 		}
 		
 		return $result;
		
	}
	
	/**
	 * Limpar o carrinho
	 * 
	 */
	function clean(){
		foreach($this->items as $item){
			if($item->quantidade<1)
				unset($this->items[$ref]);
		}
	}
	
	/**
	 * Guardar o carrinho em sessão
	 * 
	 */
	function save(){
		$this->clean();
		$_SESSION[$this->nome_cart] = $this->items;	
	}
	
}
?>