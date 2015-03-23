<?php
class home_plugin extends Plugin{
	
	function index(){
		$variaveis = &new Buffer();
		
		$this->template->adicionarCSS('estilos/bo_home.css');
		$this->template->adicionarCSS('estilos/960.css');
		
		/**
		 $lingua = &new Lingua($this->template->lingua);
		 $lingua->carregar('home');
		 */
		
		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
		//$variaveis->adicionar('ling', $this->lingua);
		
		$vista = &new Vista('vista_stage');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$this->template->adicionarVista($vista, 'stage');
	}
	
	function conteudo($parametros){
		$variaveis = &new Buffer();
		
		$this->template->adicionarCSS('estilos/bo_home.css');
		$this->template->adicionarCSS('estilos/960.css');
		
		/**
		 $lingua = &new Lingua($this->template->lingua);
		 $lingua->carregar('home');
		 */
		
		$variaveis->adicionar('conf', $this->Conf);
		$variaveis->adicionar('install', $this->template->Instalacao);
		//$variaveis->adicionar('ling', $this->lingua);
		
		$vista = &new Vista('vista_conteudo');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$caminho = $this->caminhoBase;
		$seccao = $parametros;
		$variaveis->adicionar('caminho', $caminho);
		$variaveis->adicionar('seccao', $parametros);
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'conteudo';
		$this->template->adicionarVista($vista, 'conteudo');
		$this->template->mostrarBloco('conteudo');
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
		$variaveis->adicionar('install', $this->template->Instalacao);
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = 'menu';
		$this->template->adicionarVista($vista, 'menu');
		$this->template->mostrarBloco('menu');		
	}
	
}
?>