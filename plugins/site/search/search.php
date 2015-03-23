<?php
class search_plugin extends Plugin{

    function simple($parametros){
        $variaveis = &new Buffer();

        $install = $this->template->Instalacao;

        $linguas = Array();
        foreach($install['Idiomas'] as $l){
            $aux = explode(',', $l);
            array_push($linguas, $aux[1]);
        }

        if(count($parametros)>0 && in_array($parametros[count($parametros)-1], $linguas)){
            $ling = $parametros[count($parametros)-1];
        }else{
            $ling = $this->Conf['Site']['Lingua'];
        }

        $lingua = &new Lingua('site', 'home', $ling);

        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);

        $vista = &new Vista('vista_simple_search');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();

        $bloco = "simple_search";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }

}
?>
