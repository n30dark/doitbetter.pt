<?php
class conteudo_plugin extends Plugin{
    
    function home($parametros){
        $variaveis = new Buffer();
        
        $lingua = new Lingua("site", $parametros[0], $parametros[1]);
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista('vista_home');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "home";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function pagina($parametros){
        $variaveis = new Buffer();        
        
        $lingua = new Lingua("site", "conteudo", $parametros[1]);
        
        $bd = new BaseDados();
        $pagina = $bd->obterObjecto("SELECT seccao, aliasweb, titulo, conteudo, keywords, metadescription FROM paginas WHERE aliasweb='$parametros[0]'");
        //echo "la";
        if($bd->contar()>0){
            //echo "lala";
            $pagina->imagens = $bd->obterArrayObjectos("SELECT * FROM paginas_imagens WHERE parent='$pagina->aliasweb'");
        }else{
            //echo "lalala";            
            $pagina = $bd->obterObjecto("SELECT seccao, aliasweb, tipo_artigo, titulo, artigo as conteudo, keywords, metadescription, 1 as mostrar_titulo FROM artigos WHERE aliasweb='$parametros[0]'");
            $pagina->imagens = $bd->obterArrayObjectos("SELECT * FROM artigos_imagens WHERE parent='$pagina->aliasweb'");
		}  
        
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        $variaveis->adicionar("conteudo", $pagina);
        
        $vista = new Vista('vista_pagina');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "pagina";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function noticia($parametros){
        $variaveis = new Buffer();
        
		$qs = new QueryString();
		$noticia = $qs->Segmentos[2];
		
        $lingua = new Lingua("site", "conteudo", $parametros[1]);
        
        $bd = new BaseDados();
        $pagina = $bd->obterObjecto("SELECT * FROM artigos WHERE (cod='$noticia' OR aliasweb='$noticia') AND idioma='$lingua->lingua'");
		$pagina->foto = $bd->obterObjecto("SELECT * FROM artigos_imagens WHERE parent='$pagina->aliasweb'"); 
        
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        $variaveis->adicionar("conteudo", $pagina);
        
        $vista = new Vista('vista_noticia');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "noticia";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function contacto_lateral($parametros){
        $variaveis = new Buffer();
        
        $qs = new QueryString();
		$curso = $qs->Segmentos[0];
        
        $lingua = new Lingua("site", "conteudo", $parametros[1]);
        
        $bd = new BaseDados();
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='$curso'");
        $nacionalidades = $bd->obterArrayObjectos("SELECT * FROM nacionalidade");
        $distritos = $bd->obterArrayObjectos("SELECT * FROM distritos");
        $habilitacoes = $bd->obterArrayObjectos("SELECT * FROM habilitacoes");
        $onde_conheceu = $bd->obterArrayObjectos("SELECT * FROM onde_conheceu");
        
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        $variaveis->adicionar("pagina", $pagina);
        $variaveis->adicionar("nacionalidades", $nacionalidades);
        $variaveis->adicionar("distritos", $distritos);
        $variaveis->adicionar("habilitacoes", $habilitacoes);
        $variaveis->adicionar("onde_conheceu", $onde_conheceu);
        
        $vista = new Vista('vista_contacto_lateral');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "contacto_lateral";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);        
    }
    
    function inscricoes($parametros){
        $variaveis = new Buffer();        
        
        $lingua = new Lingua("site", "conteudo", $parametros[1]);
        
        $bd = new BaseDados();
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE (cod='inscricoes' OR aliasweb='inscricoes')");
		$cursos = $bd->obterArrayObjectos("SELECT * FROM paginas WHERE seccao='cursos' ORDER BY titulo");
        $nacionalidades = $bd->obterArrayObjectos("SELECT * FROM nacionalidade");
        $habilitacoes = $bd->obterArrayObjectos("SELECT * FROM habilitacoes");
        $distritos = $bd->obterArrayObjectos("SELECT * FROM distritos");
        $onde_conheceu = $bd->obterArrayObjectos("SELECT * FROM onde_conheceu");
        
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        $variaveis->adicionar("conteudo", $pagina);
        $variaveis->adicionar("cursos", $cursos);
        $variaveis->adicionar("nacionalidades", $nacionalidades);
        $variaveis->adicionar("habilitacoes", $habilitacoes);
        $variaveis->adicionar("distritos", $distritos);
        $variaveis->adicionar("como_soube", $onde_conheceu);
        
        $vista = new Vista('vista_inscricoes');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "inscricoes";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function galeria($parametros){
        $variaveis = new Buffer();        
        
        $lingua = new Lingua("site", "conteudo", $parametros[1]);
        
        $bd = new BaseDados();
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE (cod='inscricoes' OR aliasweb='inscricoes')");
		$galerias = $bd->obterArrayObjectos("SELECT * FROM artigos WHERE tipo_artigo='galeria'");
        foreach($galerias as $galeria){
            $aux = $bd->obterObjecto("SELECT * FROM artigos_imagens WHERE parent='".$galeria->aliasweb."'");
            $galeria->imagem = $aux->nome;
        }
        
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        $variaveis->adicionar("conteudo", $pagina);
        $variaveis->adicionar("galerias", $galerias);
        
        $vista = new Vista('vista_galeria');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "galeria";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function contactos($parametros){
        $variaveis = new Buffer();        
        
        $lingua = new Lingua("site", "conteudo", $parametros[1]);
        
        $bd = new BaseDados();
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='contactos'");		
        
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        $variaveis->adicionar("conteudo", $pagina);
        
        $vista = new Vista('vista_contactos');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "contactos";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function trabalhe_connosco($parametros){
        $variaveis = new Buffer();
        
        $lingua = new Lingua("site", "conteudo", "pt");
        
        $bd = new BaseDados();
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='trabalhe_connosco'");
        
        $habilitacoes = $bd->obterArrayObjectos("SELECT * FROM habilitacoes");        
        
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        $variaveis->adicionar("conteudo", $pagina);
        $variaveis->adicionar("habilitacoes", $habilitacoes);
        
        $vista = new Vista('vista_trabalhe_connosco');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "trabalhe_connosco";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
}