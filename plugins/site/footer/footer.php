<?php
class footer_plugin extends Plugin{

    function footer($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_footer');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = 'footer';
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }

    function parceiros($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_parceiros');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = 'parceiros';
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function menufundo($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_menufundo');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = 'menufundo';
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function copyright($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('lingua', $lingua);
        
        $vista = new Vista('vista_copyright');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = 'copyright';
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
}
?>
