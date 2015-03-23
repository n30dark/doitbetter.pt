<?php
	$conf = $dados['conf'];
	$install = $dados['install'];
	$tabela = $dados['tabela'];
        $tabela_label = $dados['tabela'];
	
	$plug = &new GestorPlugins();
	$plug->controlador = 'bo';
	
        $campos = Array();
        $search = Array();
        $buttons = Array();
        $buttons_label = Array();

	if(isset($install[$tabela]['campos']))$campos = explode(", ", $install[$tabela]['campos']);
	if(isset($install[$tabela]['search']))$search = explode(", ", $install[$tabela]['search']);
	if(isset($install[$tabela]['buttons']))$buttons = explode(", ", $install[$tabela]['buttons']);
?>

<script type="text/javascript">

$("#add").click(function(){
	var alt = $("#application").height()-100;
	var lar = $("#application").width()-70;

	$("#add_window").load($(this).attr('alt'));

	$("#add_window").dialog({
		resizable: true,
		position: 'center',
		draggable: true,
		closeOnEscape: true,
		height: alt,
		width: lar,
		modal: true,
		title: $(this).attr('title'),
		stack: true,
		close: function(){
			var editors = $("textarea.texto");
			if(editors.length)
				editors.each(function(){
					var editorID = $(this).attr("id");
					var instance = CKEDITOR.instances[editorID];
					if(instance){ CKEDITOR.remove(instance); }
				});
			$(this).dialog('destroy');
		}
		
	});
});

$("#watch").click(function(){
    var id = $('.trSelected:eq(0)').attr('id');
    id = id.substr(3);
    window.location.href= "<?= BO_URL::obterHrefInterno("bo/conteudo/ver_curriculo/$tabela/")?>"+id;
});

$("#delete").click(function(){
        if($('.trSelected').length==1){
            var id = $('.trSelected:eq(0)').attr('id');
            id = id.substr(3);
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
							$.post("<?= BO_URL::obterHrefInterno("bo/conteudo/delete/$tabela/")?>"+id);
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

$("#aprove").click(function(){
        if($('.trSelected').length==1){
            var id = $('.trSelected:eq(0)').attr('id');
            id = id.substr(3);
            $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Tem a certeza que deseja aprovar este curriculo?</p>");
            $("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Confirmação",
			modal: true,
			stack: true,
			buttons:{ Aprovar: function() {
							$.post("<?= BO_URL::obterHrefInterno("bo/conteudo/aprovar_curriculo/$tabela/")?>"+id);
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
    }
});

$("#deny").click(function(){
        if($('.trSelected').length==1){
            var id = $('.trSelected:eq(0)').attr('id');
            id = id.substr(3);
            $("#alert").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Tem a certeza que deseja rejeitar este curriculo?</p>");
            $("#alert").dialog({
			resizable: false,
			position: 'center',
			draggable: true,
			closeOnEscape: false,
			title: "Confirmação",
			modal: true,
			stack: true,
			buttons:{ Rejeitar: function() {
							$.post("<?= BO_URL::obterHrefInterno("bo/conteudo/rejeitar_curriculo/$tabela/")?>"+id);
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
    }
});

$("#edit").click(function(grid){
	if($('.trSelected').length==1){
		var id = $('.trSelected:eq(0)').attr('id');
		var alt = $("#application").height()-100;
		var lar = $("#application").width()-70;

		$("#add_window").load("<?= BO_URL::obterHrefInterno("bo/conteudo/edit/$tabela/")?>"+id);
	
		$("#add_window").dialog({
			resizable: true,
			position: 'center',
			draggable: true,
			closeOnEscape: true,
			height: alt,
			width: lar,
			modal: true,
			title: "Editar <?= $tabela_label ?>: #" + id.substr(3),
			stack: true,
			close: function(){
				var editors = $("textarea.texto");
				if(editors.length)
					editors.each(function(){
						var editorID = $(this).attr("id");
						var instance = CKEDITOR.instances[editorID];
						if(instance){ CKEDITOR.remove(instance); }
					});
				$(this).dialog('destroy');
			}
			
		});
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

$("#flex").flexigrid({
	url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>',
	dataType: 'json',
	colModel: [
			{display: 'ID', name:'id', width: '20', sortable: true, align: 'left'},
			<?php foreach($campos as $campo):
				if($install[$tabela.'_'.$campo]['classe']!="texto"):
					$nome = $install[$tabela.'_'.$campo]['nome'];
					$label = $install[$tabela.'_'.$campo]['nome'];
					
			?>        
	         {display: '<?= $label?>', name:'<?=$nome?>', sortable: true, align: 'center'},
	         <?php endif;
	         endforeach;
	         if(isset($install[$tabela]['log']) && $install[$tabela]['log']==1):?>
	         {display: 'Data de Criacao', name:'data_criacao', width: '120', sortable: true, align: 'center'},
	         {display: 'Criado Por', name:'criado_por', width: '100', sortable: true, align: 'center'},
	         {display: 'Data de Edicao', name:'data_edicao', width: '120', sortable: true, align: 'center'},
	         {display: 'Editado Por', name:'editado_por', width: '100', sortable: true, align: 'center'},
	  		<?php endif;?>
	  		 {display: 'Cod', name:'cod', width: '100', sortable: true, align: 'right'}
		       	],
	searchitems: [
			<?php foreach($search as $s):
					$nome = $install[$tabela.'_'.$s]['nome'];
					$label = $install[$tabela.'_'.$s]['nome'];
					$default = "";
					if(isset($install[$tabela.'_'.$s]['default_search']))
						$default = ", isdefault: true";
			?>
			{display: '<?= $label?>', name: '<?= $nome?>'<?= $default?>},
			<?php endforeach;
			if(isset($install[$tabela]['log']) && $install[$tabela]['log']==1):?>
	         {display: 'Data de Criação', name:'data_criacao'},
	         {display: 'Criado Por', name:'criado_por'},
	         {display: 'Data de Edição', name:'data_edicao'},
	         {display: 'Editado Por', name:'editado_por'},
	  		<?php endif;?>
	  		 {display: 'Cod', name:'cod'}
			],
	sortname: "<?= $install[$tabela]['order_by']?>",
	usepager: true,
	useRp: false,
	rp: 15,
	
	showTableToggleBtn: false,
	height: "auto"
});
</script>

<div class="list-options">
<?php for($i=0;$i<count($buttons);$i++):?>
	<div class="list-option">
		<a id="<?= $buttons[$i]?>" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/$buttons[$i]/$tabela/")?>" href="#" class="tip newwindow" title="<?= $buttons[$i].' '.$tabela_label?>"><img src="<?= BO_URL::obterHrefInterno('estilos/images/'.$buttons[$i].'.png')?>" /></a>
	</div>
<?php endfor;?>
</div>
<table id="flex">
</table>