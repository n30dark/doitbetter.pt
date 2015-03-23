<?php
	$id = $dados['id'];
	$install = $dados['install'];
	$conf = $dados['conf'];
	$tabela = $dados['tabela'];
	$validations = $dados['validations'];
	$campos = $dados['campos'];
	$num_tabs = $dados['num_tabs'];
	$tabs = $dados['tabs'];
	$item = $dados['item'];
	$json = $dados['json'];
	$formulario = $dados['formulario'];
	$form = $dados['form'];
	$form_action = $dados['form_action'];
	
	$num_imagens = $install[$tabela]['imagens'];
	if($num_imagens>0){
		$imageratio = $install[$tabela]['maxHeight']/$install[$tabela]['maxWidth'];
		$larguras = $install[$tabela]['larguras']; 
	}
	
	$form_cont = $formulario->campos;
	
	$form_validator = $formulario->jQueryValidator();
?>

<script type="text/javascript">

var num_imagens = <?= $num_imagens ?>;
var tabela = '<?= $tabela ?>';
var campos = '<?= json_encode($campos) ?>';
var free_submit = false;

function save_data(){
	if(free_submit){
		
		var url = $("#<?= $form ?>").attr('action');
		var images = "";
		$("#ul_files > li").each(function(){
			images = images + escape($(this).attr('id') + ",");
		});
		$("#<?= $form ?>").ajaxSubmit({
			type: "POST",
			url: url + "?images=" + images,	
			success:
				function(msg){
                                        $("#<?= $form ?>").ajaxSubmit({
                                            url: url + "?reup=1"
                                        });
					var tmp = msg.split('}');
					var rsptext = tmp[0] + '}';
					var data = eval("(" + rsptext + ")");
			
					if(data.value==0)
						$("#alert").html("<p><span class='ui-icon ui-icon-circle-check' style='float:left; margin:0 7px 50px 0;'></span>Dados editados com sucesso.<br  />" + data.message + "</p>");
					else
						$("#alert").html("<p><span class='ui-icon ui-icon-circle-check' style='float:left; margin:0 7px 50px 0;'></span>Falha na edição dos dados.<br  />" + data.message + "</p>");
					$("#alert").dialog({
						resizable: false,
						position: 'center',
						draggable: true,
						closeOnEscape: false,
						title: "Edição Terminada",
						modal: true,
						stack: true,
						buttons:{ Ok: function() {
										$(this).dialog('close');
										images = "";
										$("#add_window").dialog('close');
										$("#add_window").dialog('destroy');
                                                                                $("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
									}
								},
						close: function(){
							$(this).dialog('destroy');
							images = "";
							$("#add_window").dialog('close');
							$("#add_window").dialog('destroy');
                                                        $("#flex").flexReload({ url: '<?= BO_URL::obterHrefInterno("bo/conteudo/listar_json/$tabela")?>' });
						}
					});

				}	
		});
		return false;
	}
	return false;
}

function guardar(){
	free_submit = true;
}

$(function(){

        $("#form_content").tabs();

	$("#<?= $form ?>").submit(function(){
		return false;
	});
	
	$(".frm_field label.error").css("color", "#AA0202");
	$(".frm_field label.error").css("float", "right");

	<?= $form_validator ?>
	
        

	<?php if($num_imagens>0):
			$imagens = "";
			if($id>0){
				for($i=1; $i<=$num_imagens; $i++){
					$imagem = "imagem_$i";
					if($item->$imagem!=""){
						$imagens .= $item->$imagem.",";
					}
				}
				if(strlen($imagens)>0){
					$imagens = substr($imagens, 0, -1);
				}
			}
			
	?>
	$("#upload_imagens").ajaxMultiFileUpload({
		ajaxFile: path + '/plugins/bo/conteudo/scripts/upload.php',
		maxNumFiles: <?= $num_imagens?>,
		uploadFolder: '<?= $conf['Awstats']['Conf'] ?>/uploads/imagens/<?= $tabela?>/',
		thumbFolder:  '<?= $conf['Awstats']['Conf'] ?>/uploads/imagens/<?= $tabela?>/thumbs/',
		existentFiles: '<?= $imagens?>'
	});
	<?php endif;?>
	
	$(".data").datepicker({
		dateFormat: "yy-mm-dd"		
	});
});

<?php if($num_imagens>0):?>

$("li.image_file .fileInfo .edit").click(function(){
	alert('click');
	var img = $(this).attr('id');
	var imagem = path + "/uploads/imagens/<?= $tabela?>/" + img;
	alert(imagem);
	$("img#cropbox").attr('src', imagem);
});

$(function(){

	$("li.image_file .fileInfo .edit").click(function(){
		alert('click');
		var img = $(this).attr('id');
		var imagem = path + "/uploads/imagens/<?= $tabela?>/" + img;
		alert(imagem);
		$("img#cropbox").attr('src', imagem);
	});
	
	var aspect_ratio = <?= $imageratio?>; 
	
	$('#cropbox').imgAreaSelect(
		{ 
			handles: true,
			aspectRatio: '1:'+aspect_ratio,
			fadeSpeed:1
		}
	);

	$('#docrop').click(function(){

		$.ajax({
			type: "POST",
			url: path + '/js/jcrop/crop.php',
			data: "cropimage=" + $('#cropimage').attr('val') +
                              "&x1=" + $('#x1').attr('val') +
                              "&y1=" + $('#y1').attr('val') +
                              "&x2=" + $('#x2').attr('val') +
                              "&y2=" + $('#y2').attr('val') +
                              "&w=" + $('#w').attr('val') +
                              "&h=" + $('#h').attr('val') +
                              "&larguras=" + encode('<?= $larguras ?>') +
                              "&path=" + path +
                              "&server= <?= $conf['Awstats']['Conf'] ?>",
			success: function(){
				$('img#cropbox').attr('src', path + $('#cropimage').attr('val'));
				$("#alert").html("<p><span class='ui-icon ui-icon-circle-check' style='float:left; margin:0 7px 50px 0;'></span>Corte efectuado com sucesso.<br  /></p>");
				$("#alert").dialog({
					resizable: false,
					position: 'center',
					draggable: true,
					closeOnEscape: false,
					title: "Corte efectuado",
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
	});

});

$("li.image_file").click(function(){
	var img = $(this).attr('src').split('/');
	var imagem = path + "/uploads/imagens/<?= $tabela?>/" + img[img.length-1];
	alert(imagem);
	$("img#cropbox").attr('src', imagem);
});

/**$(window).load(function () { 
	$('#cropbox').imgAreaSelect({ aspectRatio: '1:aspect_ratio'}); 
});*/

<?php endif;?>
</script> 

<form id="<?= $form?>" name="<?= $form ?>" action="<?= BO_URL::obterHrefInterno("bo/conteudo/save/$tabela/$id")?>" method="POST" enctype="multipart/form-data">

	<div id="form_content">	
               <?php if($num_tabs>1): ?>
		<ul>
			<?php for($i=0; $i<$num_tabs; $i++):?>
			<li><a href="#form-tab-<?= $i+1 ?>"><?= $tabs[$i]?></a></li>
			<?php endfor;?>
		</ul>
                <?php endif; ?>
	
	<?php for($i=1; $i<=$num_tabs; $i++):?>
		<div id="form-tab-<?= $i ?>">
			<?php
			if($num_imagens>0 && $i==$num_tabs):
			?>
			
			<div id="upload_imagens" style="width:50%"></div>
			<div id="preview"></div>	
				
			<img src="<?= BO_URL::obterHrefInterno('estilos/images/noimg.png')?>" width="400px" style="float:right;margin-top:-30%;vertical-align:middle;" id="cropbox" /><br />
					
			<div style="visibility:hidden" id="x1" name="x1" val="" />
			<div style="visibility:hidden" id="y1" name="y1" val="" />
			<div style="visibility:hidden" id="x2" name="x1" val="" />
			<div style="visibility:hidden" id="y2" name="y1" val="" />
			<div style="visibility:hidden" id="w" name="w" val="" />
			<div style="visibility:hidden" id="h" name="h" val="" />
			<div style="visibility:hidden" id="cropimage" name="cropimage" val="" />
			<input style="bottom:10px;float:right!important;position:relative;width:250px" class="btn ui-state-default ui-corner-all" type="button" value="CORTAR" id="docrop"/>
			
		<?php
			else:
				$camps = $campos[$i];
				
				foreach($camps as $campo):
					echo $form_cont[$campo];
				endforeach;
			endif; ?>
		</div>
		
	<?php endfor;?>
	</div>
	
	<input style="float:right;margin-top:10px;margin-right:20px;" class="btn ui-state-default ui-corner-all" type='submit' value='Guardar' onclick="guardar()"/>
	
</form>