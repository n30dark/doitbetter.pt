<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$conteudo = $dados['conteudo'];
$galerias = $dados['galerias'];
$plug = new GestorPlugins();
$plug->controlador = 'site';
$area = $conteudo->seccao;

?>

<?php //$plug->dispatch(Array("header", "iconmenu", $area, $lingua->lingua)); ?>

<div class="content">
        <div class="center">
            <?= $plug->dispatch(Array("home", "logo", $area, $lingua->lingua)); ?>
            <span class="title">Galeria de Fotos</span><br />
            
            <div class="content" style="display: table;margin-top:20px;">
            <?= html_entity_decode($conteudo->conteudo) ?>
            
            <?php foreach($galerias as $galeria): ?>
                <div class="galeria">
                    <a href="<?= BO_URL::obterHrefInterno($galeria->aliasweb)?>">
                        <img src="<?= BO_URL::obterHrefInterno("uploads/imagens/artigos/".$galeria->imagem) ?>" alt="<?= $galeria->titulo ?>" />
                        <div class="titulo"><?= $galeria->titulo ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>      
        <div class="right">
            <?= $plug->dispatch(Array("home", "phone", $area, $lingua->lingua)); ?>
            <?php if($area=='cursos'): ?>
                <?= $plug->dispatch(Array("conteudo", "contacto_lateral", $area, $lingua->lingua)); ?>    
            <?php else: ?>
                <?= $plug->dispatch(Array("home", "courses", $area, $lingua->lingua)); ?>
                <?= $plug->dispatch(Array("home", "promos", $area, $lingua->lingua)); ?>
            <?php endif; ?>
            <?= $plug->dispatch(Array("home", "legal", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "newsletter", $area, $lingua->lingua)); ?>
            
        </div>  
    </div>