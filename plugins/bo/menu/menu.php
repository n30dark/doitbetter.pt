<?php
class menu_plugin extends Plugin{

    function sub_menu($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = $parametros[0];

        if(!isset($parametros[1])){
            $ops = split(',', $aux[$seccao]);
            $parametros[1] = $ops[0];
        }

        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('seccao_ops', $aux[$seccao]);
        $variaveis->adicionar('selected_option', $parametros[1]);

        $vista = new Vista('vista_sub_menu');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'sub_menu';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }

    function side_menu($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = $parametros[0];
		
        $sub_seccao = $parametros[1];
		
		$lingua = new Lingua('install','home','pt');
		
		if(isset($aux[$seccao.'_'.$sub_seccao]))
			$seccao_ops = $aux[$seccao.'_'.$sub_seccao];
		else
			$seccao_ops = Array();

        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('seccao_ops', $seccao_ops);
        $variaveis->adicionar('seccao', $seccao);
		$variaveis->adicionar('subseccao', $sub_seccao);
		$variaveis->adicionar('lingua', $lingua);

        $vista = new Vista('vista_side_menu');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'side_menu';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }

}
?>
