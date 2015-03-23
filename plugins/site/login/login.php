<?php
class login_plugin extends Plugin{

    function login_form($parametros){
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

        $lingua = new Lingua("site", $parametros[2], $lingua);  

        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);

        $vista = &new Vista('vista_login_form');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();

        $bloco = "login_form";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }

}
?>
