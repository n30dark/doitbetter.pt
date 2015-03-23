<?php
class menu_plugin extends Plugin{
    
    function menu($parametros){
        $variaveis = new Buffer();
        
        //$ativo = $parametros[0];
        $lingua = $parametros[1];
        $lingua = new Lingua("site", "home", $lingua);  
        $bd = new Basedados();
        $artigos = $bd->obterArrayObjectos("SELECT * FROM artigos");
        
        $variaveis->adicionar('conf', $this->Conf);
        $variaveis->adicionar('artigos', $artigos);
        //$variaveis->adicionar('ativo', $ativo);
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
