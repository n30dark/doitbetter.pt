<?php
	$conf = $dados['conf'];
	$install = $dados['install'];
	$tabela = $dados['tabela'];
        $tabela_label = $dados['tabela'];
        $conteudo = $dados['conteudo'];
        $total = $dados['total'];
		
	$lingua = $dados['lingua'];
	
	$QS = new QueryString();
		$segs = $QS->Segmentos;
		$seccao = $segs[3];

	$plug = new GestorPlugins();
	$plug->controlador = 'bo';

        $campos = Array();
        $search = Array();
        $buttons = Array();
        $buttons_label = Array();

        $search_list = explode(", ", $install[$tabela]['search_list']);

	if(isset($install[$tabela]['campos']))$campos = explode(", ", $install[$tabela]['campos']);
	if(isset($install[$tabela]['search']))$search = explode(", ", $install[$tabela]['search']);
	if(isset($install[$tabela]['buttons']))$buttons = explode(", ", $install[$tabela]['buttons']);

        $bd = new BaseDados();
?>
<script type="text/javascript">
$(function(){

    $("#delete").click(function(){       
        if($('.listed_item:checked').length>=1){
            $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Tem a certeza que deseja eliminar este item?</p>");
            $("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Confirmação",
			modal: true,
			stack: true,
			buttons:{ Eliminar: function() {
                                                        //if($('.listed_item:selected').length==1){
                                                            var id = $('.listed_item:checked').val();
                                                            //alert(id);
                                                            $.post("<?= BO_URL::obterHrefInterno("bo/conteudo/delete/$tabela/")?>"+id);
                                                        /*}else{
                                                            for(var i in $('.listed_item:selected')){
                                                                i =  i.val();
                                                                alert(i);
                                                                $.post("<?= BO_URL::obterHrefInterno("bo/conteudo/delete/$tabela/")?>"+i);
                                                            }
                                                        }*/
                                                        $(this).dialog('close');
														$('.listen_item').attr('checked', false);
                                                        window.location.reload();
						},
                                  Cancelar: function(){
                                                        $(this).dialog('close');                                                       
                                                }
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }else{
        $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Seleccione o objecto a eliminar.</p>");

		$("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Atencao!!!",
			modal: true,
			stack: true,
			buttons:{ Ok: function() {
							$(this).dialog('close');
						}
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }
});

$("#moveup").click(function(){       
    if($('.listed_item:checked').length>=1){
		var id = $('.listed_item:checked').val();
		$.post("<?= BO_URL::obterHrefInterno("bo/conteudo/moveup/$tabela/")?>"+id);
		window.location.reload();
    }else{
        $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Seleccione o objecto a subir.</p>");

		$("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Atencao!!!",
			modal: true,
			stack: true,
			buttons:{ Ok: function() {
							$(this).dialog('close');
						}
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }
});

$("#movedown").click(function(){       
	if($('.listed_item:checked').length>=1){
		var id = $('.listed_item:checked').val();
		$.post("<?= BO_URL::obterHrefInterno("bo/conteudo/movedown/$tabela/")?>"+id);
    }else{
        $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Seleccione o objecto a descer.</p>");

		$("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Atencao!!!",
			modal: true,
			stack: true,
			buttons:{ Ok: function() {
							$(this).dialog('close');
						}
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }
});

$("#edit").click(function(grid){
	if($('.listed_item:checked').length==1){
		var id = $('.listed_item:checked').val();
		window.location.href="<?= BO_URL::obterHrefInterno("bo/home/index/$seccao/$tabela/edit/")?>" + id;
	}else{

		$("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Seleccione o objecto a editar.</p>");
		
		$("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Atenção!!!",
			modal: true,
			stack: true,
			buttons:{ Ok: function() {
							$(this).dialog('close');
						}
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
	}
});

$("#export_list").click(function(){
        //if($('.trSelected').length==1){
            //var id = $('.trSelected:eq(0)').attr('id');
            //id = id.substr(3);
            $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Tem a certeza que deseja exportar os contactos?</p>");
            $("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Confirmação",
			modal: true,
			stack: true,
			buttons:{ OK: function() {
							$.post("<?= BO_URL::obterHrefInterno("bo/conteudo/exportar_contactos/$tabela/")?>", 
                                                                function(data){
                                                                    ficheiro = data.split('<');
                                                                    window.open(ficheiro[0], "Ficheiro: " + ficheiro[0]);
                                                            });

                                                        $(this).dialog('close');
                                                        //$("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
						},
                                  Cancelar: function(){
                                                        $(this).dialog('close');
                                                        //$("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
                                                }
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    /**}else{
        $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Seleccione o objecto a eliminar.</p>");

		$("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Atenção!!!",
			modal: true,
			stack: true,
			buttons:{ Ok: function() {
							$(this).dialog('close');
						}
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }*/
});

$("#import_list").click(function(){
        //if($('.trSelected').length==1){
            //var id = $('.trSelected:eq(0)').attr('id');
            //id = id.substr(3);
            $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'>"+
                                "</span>Coloque o ficheiro a importar abaixo:<br />" +
                                "<form id='import_form' name='import' enctype='multipart/form-data' method='post' action='<?= BO_URL::obterHrefInterno("bo/conteudo/importar_contactos"); ?>'>" +
                                "<input type='file' value='CSV' name='csvfile'>" +
                                "<input type='submit' style='display:none;'>" +
                                "</form></p>");
            $("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Confirmação",
			modal: true,
			stack: true,
			buttons:{ OK: function() {
							$("#import_form").ajaxSubmit({
                                                            url: '<?= BO_URL::obterHrefInterno("bo/conteudo/importar_contactos") ?>',
                                                            success:
                                                                  function(responseText){
                                                                    window.location.href = window.location.href;
                                                                    //$("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>"+ responseText +".</p>");
                                                            }
                                                        });

                                                        $(this).dialog('close');
                                                        //$("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
						},
                                  Cancelar: function(){
                                                        $(this).dialog('close');
                                                        //$("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
                                                }},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    /**}else{
        $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Seleccione o objecto a eliminar.</p>");

		$("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Atenção!!!",
			modal: true,
			stack: true,
			buttons:{ Ok: function() {
							$(this).dialog('close');
						}
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }*/
});

$("#send").click(function(){
        if($('.trSelected').length==1){
            var id = $('.trSelected:eq(0)').attr('id');
            id = id.substr(3);
            $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Tem a certeza que deseja enviar esta newsletter?</p>");
            $("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Confirmação",
			modal: true,
			stack: true,
			buttons:{ Aprovar: function() {
							$.post("<?= BO_URL::obterHrefInterno("bo/conteudo/enviar_newsletter/$tabela/")?>"+id);
                                                        $(this).dialog('close');
                                                        $("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
						},
                                  Cancelar: function(){
                                                        $(this).dialog('close');
                                                        $("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
                                                }
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }else{
        $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Seleccione a newsletter a enviar.</p>");

		$("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Atenção!!!",
			modal: true,
			stack: true,
			buttons:{ Ok: function() {
							$(this).dialog('close');
						}
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }
});

$("#test_send").click(function(){
        if($('.trSelected').length==1){
            var id = $('.trSelected:eq(0)').attr('id');
            id = id.substr(3);
            $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Tem a certeza que deseja enviar esta newsletter?</p>");
            $("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Confirmação",
			modal: true,
			stack: true,
			buttons:{ Aprovar: function() {
							$.post("<?= BO_URL::obterHrefInterno("bo/conteudo/testar_newsletter/$tabela/")?>"+id);
                                                        $(this).dialog('close');
                                                        $("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
						},
                                  Cancelar: function(){
                                                        $(this).dialog('close');
                                                        $("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
                                                }
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }else{
        $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Seleccione a newsletter a enviar.</p>");

		$("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Atenção!!!",
			modal: true,
			stack: true,
			buttons:{ Ok: function() {
							$(this).dialog('close');
						}
					},
			close: function(){
				$(this).dialog('destroy');
			}
		});
    }
});

$("#search").click(function(){
	$("#procura").submit();
});

$(".fbshare").click(function(){
	window.open('http://www.facebook.com/sharer.php?u=' + $(this).attr('share_url') + '&t=' + $(this).attr('share_title') + '','Facebook Share','width=600,height=300')
});

$(".tweet").click(function(){
	window.open($(this).attr('share_url'),'Twitter Share','width=600,height=300')
});

});
</script>

<div class="buttons">
    <?php foreach($buttons as $button): ?>
        <a id="<?= $button?>" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/$button/$tabela/")?>" href="#" class="button tip newwindow" title="<?= $lingua->obter($button).' '.$tabela_label?>"><img src="<?= BO_URL::obterHrefInterno('estilos/images/'.$button.'.png')?>" /></a>
    <?php endforeach; ?>
	<a style="float:right;" id="search" alt="" href="#" class="button tip newwindow" title="Procurar"><img src="<?= BO_URL::obterHrefInterno('estilos/images/search.png')?>" /></a>
</div>

<div class="search">
    <?php
    $search_form = &new Formulario('search', BO_URL::obterHrefInterno("bo/conteudo/listar/$tabela/"));
    foreach($search as $campo):
        if(isset($install[$tabela.'_'.$campo]['ref'])){
				$t_ref = $install[$tabela.'_'.$campo]['ref'];
				$ref->dados = $bd->obterArrayObjectos($install[$tabela.'_'.$campo]['default_select']);
				$ref->nome = $install[$tabela.'_'.$campo]['nome'];
				$ref->label = $install[$tabela.'_'.$campo]['nome'];
				if(isset($install[$tabela.'_'.$campo]['default']))
					$ref->default = $install[$tabela.'_'.$campo]['default'];
			}else{
				$ref = false;
			}
        $search_form->novoCampo($install[$tabela.'_'.$campo]['nome'], $install[$tabela.'_'.$campo]['nome'], $install[$tabela.'_'.$campo]['classe'], "", $ref);
    endforeach;
    $form_cont = $search_form->campos;
    ?>
    <form id="procura" name="procura" action="" method="POST" enctype="multipart/form-data">
		
		<input type="hidden" name="searchon" />

		<?php
				$camps = $search;

				foreach($camps as $campo):
					echo $form_cont[$campo];
				endforeach;
                ?>

	<!--<input style="float:right;margin-top:-80px;margin-right:20px;width:100px;height:30px;" class="btn ui-state-default ui-corner-all" type='submit' value='Pesquisar' onclick="pesquisar()"/>-->

    </form>
</div>

<div class="content_list">
    <table>
        <thead>
            <td><!--<input type="checkbox" />--></td>
            <?php foreach($search_list as $sl): ?>
                <td><?= $lingua->obter($sl) ?><a href="<?= BO_URL::obterHrefinterno('bo/home/index/'.$seccao.'/'.$tabela)?>?order=<?= $sl?>"><img src="<?= BO_URL::obterHrefInterno('estilos/cms/down_arrow.png')?>" /></a></td>
            <?php endforeach; ?>
        </thead>
        <?php if($total>0):
			$i = 1;
            foreach($conteudo as $dado):?>
        <tr <?= ($i%2==0)?"class='dark'":"";?>>
            <td>
			<input id="art_<?= $dado->id ?>" class="listed_item" type="checkbox" value="<?= $dado->id ?>" />
			<a style="cursor:pointer;" onclick="$('#art_<?= $dado->id?>').attr('checked', true);$('#delete').click();" ><img src="http://www.ibercup.com/estilos/images/delete.png" /></a>				
			<a style="cursor:pointer;" href="<?= BO_URL::obterHrefInterno("bo/home/index/e_cms/".$tabela."/edit/".$dado->id) ?>"><img src="http://www.ibercup.com/estilos/images/edit.png" /></a>			
			<?php if($tabela=="paginas"): ?>
				<a class="fbshare" style="cursor:pointer;" name="fb_share" type="icon" share_title="<?= $conf['Site']['Titulo'].' - '.$dado->titulo ?>" share_url="<?= BO_URL::obterHrefInterno($dado->aliasweb."/".$dado->idioma)?>"><img src="http://www.doitbetter.pt/novo/estilos/site/images/facebook_cor.png" /></a>
				<a class="tweet" style="cursor:pointer;" share_url="https://twitter.com/share?text=Veja em DoItBetter: <?= $dado->titulo ?> - <?= BO_URL::obterHrefInterno($dado->aliasweb."/".$dado->idioma)?>"><img src="http://www.doitbetter.pt/novo/estilos/site/images/twitter_cor.png" /></a>
			<?php elseif($tabela=="artigos"): ?>
				<a class="fbshare" style="cursor:pointer;" name="fb_share" type="icon" share_title="<?= $conf['Site']['Titulo'].' - '.$dado->titulo ?>" share_url="<?= BO_URL::obterHrefInterno("arquivo/".$dado->idioma."/".$dado->aliasweb)?>"><img src="http://www.doitbetter.pt/novo/estilos/site/images/facebook_cor.png" /></a>
				<a class="tweet" style="cursor:pointer;" share_url="https://twitter.com/share?text=Novidade DoItBetter: <?= $dado->titulo ?> - <?= BO_URL::obterHrefInterno($dado->aliasweb."/".$dado->idioma)?>"><img src="http://www.doitbetter.pt/novo/estilos/site/images/twitter_cor.png" /></a>
			<?php endif; ?>
			</td>
            <?php           
                    foreach($search_list as $sl): ?>
                    <td><?= $dado->$sl ?></td>
                <?php endforeach;?>
        </tr>
        <?php
					$i = $i+1;
                    endforeach; endif; ?>
        <tfoot>
            <td></td>
            <?php foreach($search_list as $sl): ?>
                <td></td>
            <?php endforeach; ?>
        </tfoot>
    </table>
</div>