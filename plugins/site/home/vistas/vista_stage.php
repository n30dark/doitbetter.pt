<?php
    $conf = $dados['conf'];
    $lingua = $dados['lingua'];

    $plug = new GestorPlugins();
    $plug->controlador = 'site';

    $QS = new QueryString();
	
    if(!isset($QS->Segmentos[0]) || $QS->Segmentos[0]=="")
        $area = "home";
    else
        $area = $QS->Segmentos[0];

		
?>
<div class="stage">

    <?= $plug->dispatch(Array("header", "header", $area, $lingua->lingua)); ?>    
    
    <?php if($area=='home' || $area=='inscricoes' || $area=='galeria' || $area=='contactos' || $area=='trabalhe_connosco'){
        $plug->dispatch(Array("conteudo", $area, $area, $lingua->lingua));
    
    }else{    
        $bd = new BaseDados();
        $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='$area' OR cod='$area'");
        //if($bd->contar()>0)
            $plug->dispatch(Array("conteudo", "pagina", $area, $lingua->lingua)); 
        //else
        //    $plug->dispatch(Array("conteudo", "artigo", $area, $lingua->lingua)); 
    } 
    
    ?>
    
    
    <?= $plug->dispatch(Array("footer", "footer", $area, $lingua->lingua)); ?>
    
</div>