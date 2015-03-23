<?php
	$conf = $dados['conf'];
	$install = $dados['install'];
        $p = new GestorPlugins();
        $p->controlador = 'bo';

        $seccao = $dados['seccao'];
        $subseccao = $dados['subseccao'];
        $action = $dados['action'];
		
		$bd = new BaseDados();
		$cookie = $_COOKIE['utilizadores_bo'];
		$aux = $bd->obterObjecto("SELECT * FROM utilizadores_bo_temp WHERE codigo='$cookie'");
		$aux = $bd->obterObjecto("SELECT * FROM utilizadores_bo WHERE utilizador='$aux->utilizador'");
		//var_dump($aux);
		if(!isset($aux->id)){
			$aux->id = 0;
			$aux->nome = "SuperAdmin";
		}
		$utilizador_bo = $aux->id;
		$nomeutilizador = $aux->nome;
?>
<script type="text/javascript">
    $(function($){

        $('.menu .menu_option').hover(
            function(){
                $(this).addClass('menu_option_selected');
            },
            function(){
                if($(this).attr('option')!='<?= $seccao ?>')
                    $(this).removeClass('menu_option_selected');
            }
        );
     /*end of top menu*/

    /*secondary menu*/
      $('.sec_op').hover(
            function(){
                $(this).addClass('sec_op_selected');
            },
            function(){
                if($(this).attr('option')!='<?= $subseccao ?>')
                    $(this).removeClass('sec_op_selected');
            }
        );
     /*end of secondary menu*/

     /*side menu*/
      $('.side_menu .steps .option').hover(
            function(){
                $(this).addClass('option_selected');
            },
            function(){
                $(this).removeClass('option_selected');
            }
        );
     /*end of side menu*/

        $('.menu_option').each(function(){
            if($(this).attr('option')=='<?= $seccao ?>'){
                $(this).addClass('menu_option_selected');
            }
        });

        $('.sec_op').each(function(){
            if($(this).attr('option')=='<?= $subseccao ?>'){
                $(this).addClass('sec_op_selected');
            }
        });

        $('.menu_option').click(function(){
            var seccao = $(this).attr('option');
            window.location.href = path + "/bo/home/index/" + seccao;
        });

        $('.sec_op').click(function(){
            var seccao = $(this).attr('option');
            window.location.href = path + "/bo/home/index/<?= $seccao ?>/" + seccao;
        });

        $('#add').click(function(){
           window.location.href = '<?= BO_URL::obterHrefInterno("bo/home/index/$seccao/$subseccao/add")?>';
        });

        $(".logout").click(function(){
            window.location.href = '<?= BO_URL::obterHrefInterno("bo/login/sair")?>';
        });
		
		$(".user").click(function(){	
			window.location.href = '<?= BO_URL::obterHrefInterno("bo/home/index/e_cms/utilizadores_bo/edit/".$utilizador_bo) ?>';
		});
    });
</script>

<div class="top">
    <div style="width:1020px;margin:auto;">
        <div class="logo"></div>
        <div class="logout"></div>
        <span class="user" style="cursor:pointer;"><?= htmlentities($nomeutilizador)?></span>
        <span class="user_photo"><img src="<?= BO_URL::obterHrefInterno('estilos/cms/user_photo.png') ?>" /></span>
        <span class="date_time"><?= date('d').' '.BO_DATA::obtermes(date('m')).' '.date('Y')?> </span>
    </div>
    
</div>

<div class="top_menu">
    <div style="width:1020px;margin:auto;">
        <div class="menu">
            <div class="menu_option" option="dashboard">Dashboard</div>
            <div class="menu_option" option="e_cms">W-CMS</div>
            <?php if($conf['MainConf']['eCommerce']==1){?><div class="menu_option" option="e_shop">W-Shop</div><?php } ?>
            <?php if($conf['MainConf']['Newsletter']==1){?><div class="menu_option" option="e_newsletter">W-Newsletter</div><?php } ?>
            <!--<div class="menu_option" option="e_stat">W-Stat</div>-->
			<!--<div class="menu_option" option="multimedia">Multimedia</div>-->
        </div>
    </div>
</div>

<div class="sub_menu">
    <div style="width:1020px;margin:auto;">
      <?= $p->dispatch(Array('menu', 'sub_menu', $seccao, $subseccao)); ?>
    </div>
</div>

<div class="cms_content">
    <div style="width:1020px;margin:auto;">
        <?php if($seccao!="multimedia"): ?>
	<div class="side_menu">
            <?= $p->dispatch(Array('menu', 'side_menu', $seccao, $subseccao)); ?>
        </div>
	<?php endif;?>
        <div class="section_content" <?= ($seccao=="multimedia")?"style='width:1020px;'":"";?>>
            <?= $p->dispatch(Array('seccoes', $seccao, $subseccao, $action)); ?>
       </div>
    </div>
</div>



