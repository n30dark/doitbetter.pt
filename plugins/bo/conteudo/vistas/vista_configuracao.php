<?php
        $conf = $dados['conf'];
	$validations = $dados['validations'];
	$campos = $dados['campos'];
	$json = $dados['json'];
	$formulario = $dados['formulario'];
	$form = $dados['form'];
	$form_action = $dados['form_action'];

	$form_cont = $formulario->campos;

	$form_validator = $formulario->jQueryValidator();
?>
<script type="text/javascript">
    
var campos = '<?= json_encode($campos) ?>';
var free_submit = false;

function save_data(){
	if(free_submit){

		var url = $("#<?= $form ?>").attr('action');
		$("#<?= $form ?>").ajaxSubmit({
			type: "POST",
			url: url,
			success:
				function(msg){

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
								}
							},
						close: function(){
							$(this).dialog('destroy');
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



});
</script>

<form id="<?= $form?>" name="<?= $form ?>" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data">

	<div id="form_content" style="height:80%;overflow:auto;">
	<?php
            $camps = $campos;
            foreach($camps as $campo):
                echo $form_cont[$campo];
            endforeach;
        ?>
	</div>

	<input style="float:right;margin-top:10px;margin-right:20px;" class="btn ui-state-default ui-corner-all" type='submit' value='Guardar' onclick="guardar()"/>

</form>

