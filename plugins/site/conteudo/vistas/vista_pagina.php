<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$conteudo = $dados['conteudo'];
$plug = new GestorPlugins();
$plug->controlador = 'site';
$area = $conteudo->seccao;

$bd = new Basedados();

$browser = new BO_BROWSER();

?>

<?php //$plug->dispatch(Array("header", "iconmenu", $area, $lingua->lingua)); ?>

<script type="text/javascript">
    $(function() {
	   $('a.lightbox').lightBox({fixedNavigation:true});
       
       $(".fbshare").click(function(){
	       window.open('http://www.facebook.com/sharer.php?u=' + $(this).attr('share_url') + '&t=' + $(this).attr('share_title') + '','Facebook Share','width=600,height=300')
        });
    });
</script>

<div class="content">
        <div class="center">
            <?= $plug->dispatch(Array("home", "logo", $area, $lingua->lingua)); ?>
            <span class="title"><?= $conteudo->titulo ?></span><br />
            <?php if($area=='cursos'): ?>
                <a class="fbshare" style="cursor:pointer;" name="fb_share" type="icon" share_title="<?= $conf['Site']['Titulo'].' - '.$conteudo->titulo ?>" share_url="<?= BO_URL::obterHrefInterno($conteudo->aliasweb) ?>"><img style="height:20px;width:20px;" src="http://www.doitbetter.pt/novo/estilos/site/images/facebook_small.png" /> Partilhar o curso</a>
                <a class="mailshare" href="mailto:"><img src="<?= BO_URL::obterHrefInterno("") ?>estilos/images/send.png" /> Enviar a um amigo</a>
            <?php endif; ?>
            <div class="content" <?= ($area=="cursos")?"style='min-height: 660px!important;'":"";?>  <?= ($conteudo->tipo_artigo=="galeria")?"style='display: block;margin-top:20px;'":""; ?> >
            <?php if($conteudo->aliasweb=='cursos'): 
                $cursos = $bd->obterArrayObjectos("SELECT * FROM paginas WHERE seccao='cursos' ORDER BY titulo");
            ?>
                <h1>Conheça os nossos cursos</h1>
                <p>As formações indoor decorrem nas nossas instalações em <strong>Alverca</strong> (Praceta Projetada à Avenida Capitão Meleças n.º 6 ) e em <strong>Lisboa </strong>(na Rua Luz Soriano n.º 42).</p>
                <p>&nbsp;</p>
                <ul class="course_list">
                <?php foreach($cursos as $curso): ?>
                    <li class="option"><a href="<?= BO_URL::obterHrefInterno("".$curso->aliasweb)?>"><?= $curso->titulo ?></a></li>
                <?php endforeach; ?>
                </ul>
                
            <?php endif; ?>
            <?= html_entity_decode($conteudo->conteudo) ?>
            <?php if(isset($conteudo->tipo_artigo) && $conteudo->tipo_artigo=='galeria'): ?>
                
                <?php $i=1;foreach($conteudo->imagens as $galeria): ?>
                <div class="galeria" style="display: inline-block;<?= ($i%2==0)?"margin-left:100px;":""; ?>">
                        <a class="lightbox" href="<?= BO_URL::obterHrefInterno("uploads/imagens/artigos/".$galeria->nome) ?>"><img src="<?= BO_URL::obterHrefInterno("uploads/imagens/artigos/".$galeria->nome) ?>" /></a>
                        <a class="fbshare" style="cursor:pointer;" name="fb_share" type="icon" share_title="<?= $conf['Site']['Titulo'].' - '.$conteudo->titulo ?>" share_url="<?= BO_URL::obterHrefInterno("uploads/imagens/artigos/".$galeria->nome) ?>"><img style="height:20px;width:20px;" src="http://www.doitbetter.pt/novo/estilos/site/images/facebook_small.png" /></a>                       
                </div>
                <?= ($i%2==0)?"<br />":""; ?>
                <?php $i++;endforeach; ?>
                
            <?php endif; ?>
            </div>
        </div>      
        <div class="right">
            <?= $plug->dispatch(Array("home", "phone", $area, $lingua->lingua)); ?>
            <?php if($area=='cursos'): ?>
                <?= $plug->dispatch(Array("conteudo", "contacto_lateral", $area, $lingua->lingua)); ?>    
            <?php else: ?>
                <?= $plug->dispatch(Array("home", "courses", $area, $lingua->lingua)); ?>
            <?php endif; ?>
            <?= $plug->dispatch(Array("home", "promos", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "legal", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "newsletter", $area, $lingua->lingua)); ?>
            
        </div>  
    </div>