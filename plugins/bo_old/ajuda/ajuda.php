<?php
class ajuda_plugin extends Plugin{
	
	function index(){
		$variaveis = &new Buffer();
		
		$this->template->adicionarCSS('estilos/bo_home.css');
		$this->template->adicionarCSS('estilos/960.css');
		
		/**
		 $lingua = &new Lingua($this->template->lingua);
		 $lingua->carregar('home');
		 */
		
		$variaveis->adicionar('conf', $this->Conf);
		//$variaveis->adicionar('ling', $this->lingua);
		
		$vista = &new Vista('vista_stage');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$this->template->adicionarVista($vista, 'stage');
	}
	
	function ajuda_rapida($parametros){
		$variaveis = &new Buffer();
		
		$this->template->adicionarCSS('estilos/bo_home.css');
		$this->template->adicionarCSS('estilos/960.css');
		
		/**
		 $lingua = &new Lingua($this->template->lingua);
		 $lingua->carregar('home');
		 */
		
		$variaveis->adicionar('conf', $this->Conf);
		//$variaveis->adicionar('ling', $this->lingua);
		
		$vista = &new Vista('vista_ajuda_rapida');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$caminho = $this->caminhoBase;
		$seccao = $parametros;
		$variaveis->adicionar('caminho', $caminho);
		$variaveis->adicionar('seccao', $parametros);
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'ajuda_rapida';
		$this->template->adicionarVista($vista, 'ajuda_rapida');
		$this->template->mostrarBloco('ajuda_rapida');
	}
	
	function menu($parametros){
		$variaveis = &new Buffer();

		$this->template->adicionarCSS('estilos/bo_home.css');
		$this->template->adicionarCSS('estilos/960.css');
		
		$vista = &new Vista('vista_menu');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$caminho = $this->caminhoBase;
		$seccao = $parametros;
		$variaveis->adicionar('caminho', $caminho);
		$variaveis->adicionar('seccao', $seccao);
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'menu';
		$this->template->adicionarVista($vista, 'menu');
		$this->template->mostrarBloco('menu');		
	}
	
}
?>