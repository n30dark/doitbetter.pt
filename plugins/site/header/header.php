<?php
class header_plugin extends Plugin{

    function index(){
        
    }

    function header($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_header');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "header";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function bandeiras($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_bandeiras');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "bandeiras";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function datahora($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_datahora');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "datahora";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function social($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_social');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "social";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function menuprincipal($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_menuprincipal');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "menuprincipal";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function submenu($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_submenu');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "submenu";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function menu($parametros){
        $variaveis = new Buffer();
        
        $QS = new QueryString();
        $pagina = $QS->Segmentos[0];
        $variaveis->adicionar("pagina", $pagina);
        
        $bd = new Basedados();
        $opcoes = $bd->obterArrayObjectos("SELECT * FROM paginas WHERE seccao='menu-superior' ORDER BY posicao");
        $variaveis->adicionar("opcoes", $opcoes);
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_menu');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = 'menu';
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
}
?>