<?php
class seccoes_plugin extends Plugin{

    function dashboard($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        

        $variaveis->adicionar('conf', $this->Conf);
        

        $vista = new Vista('vista_dashboard');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'dashboard';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }

    function e_cms($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        if(!isset($parametros[1]) || $parametros[1]=="")
            $parametros[1] = 'listar';

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = "e_cms_".$parametros[0];

		$lingua = new Lingua('install','home','pt');

        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('subseccao', $parametros[0]);
        $variaveis->adicionar('action', $parametros[1]);
		$variaveis->adicionar('lingua', $lingua);

        $vista = new Vista('vista_e_cms');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'e_cms';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }

    function e_shop($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        if(!isset($parametros[1]) || $parametros[1]=="")
            $parametros[1] = 'listar';

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = "e_shop_".$parametros[0];

		$lingua = new Lingua('install','home','pt');

		$variaveis->adicionar('lingua', $lingua);
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('subseccao', $parametros[0]);
        $variaveis->adicionar('action', $parametros[1]);

        $vista = new Vista('vista_e_shop');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'e_shop';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }

    function e_newsletter($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        if(!isset($parametros[1]) || $parametros[1]=="")
            $parametros[1] = 'listar';

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = "e_newsletter_".$parametros[0];

		$lingua = new Lingua('install','home','pt');

		$variaveis->adicionar('lingua', $lingua);
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('subseccao', $parametros[0]);
        $variaveis->adicionar('action', $parametros[1]);

        $vista = new Vista('vista_e_newsletter');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'e_newsletter';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }

    function e_stat($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        if(!isset($parametros[1]) || $parametros[1]=="")
            $parametros[1] = 'geral';

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = "e_stat_".$parametros[0];

		$lingua = new Lingua('install','home','pt');

		$variaveis->adicionar('lingua', $lingua);
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('subseccao', $parametros[0]);
        $variaveis->adicionar('action', $parametros[1]);

        $vista = new Vista('vista_e_stats');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'e_stat';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }
    
    function e_travel($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        if(!isset($parametros[1]) || $parametros[1]=="")
            $parametros[1] = 'geral';

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = "e_travel_".$parametros[0];

		$lingua = new Lingua('install','home','pt');

		$variaveis->adicionar('lingua', $lingua);
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('subseccao', $parametros[0]);
        $variaveis->adicionar('action', $parametros[1]);

        $vista = new Vista('vista_e_travel');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'e_travel';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }

    function engine($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = $parametros[0];

        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('seccao_ops', $aux[$seccao]);

        $vista = new Vista('vista_sub_menu');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'sub_menu';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }
	
	function multimedia($parametros){
        $this->template->abortar=true;

        $variaveis = new Buffer();

        $install = $this->template->Instalacao;
        $conf = $this->Conf;

        if(!isset($parametros[1]) || $parametros[1]=="")
            $parametros[1] = 'geral';

        $aux = new Config();
        $aux->ficheiroConfig = 'seccoes.ini';
        $aux = $aux->load();
        $seccao = "e_stat_".$parametros[0];

		$lingua = new Lingua('install','home','pt');

		$variaveis->adicionar('lingua', $lingua);
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('subseccao', $parametros[0]);
        $variaveis->adicionar('action', $parametros[1]);

        $vista = new Vista('vista_multimedia');
	$vista->caminhoBase = $this->caminhoBase . '/vistas';
	$vista->variaveis = $variaveis->toArray();

	$bloco = 'e_stat';
	$this->template->adicionarVista($vista, $bloco);
	$this->template->mostrarBloco($bloco);
    }

}
?>
