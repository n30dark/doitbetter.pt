<?php
$conf = $dados['conf'];
?>
<script type="text/javascript">

$("#form_recover").validate({

		rules: {
			Utilizador: {
				required: true,
				alphanumeric: true
			}
		},
		messages: {
			Utilizador: {
				required: "Obrigatório",
				alphanumeric: "Letras, números, espaços e underscores apenas."
			}
		},
		submitHandler: function(form){
			$('#form_recover').ajaxSubmit({
				type: 'POST',
				dataType: 'json',
				clearForm: true,
				success:function(data){
					if(data.value==0){
						$("#alert").html("Verifique o seu email pela sua nova palavra passe.");
						$("#alert").dialog({
							position: 'center',
							resizable: false,
							modal: true,
							draggable: false,
							title: "Sucesso",
							buttons: {"OK": function(){$(this).dialog('close');}}
						});
						$("#alert").dialog("open");
						$("#pass_recover").dialog('close');
					}else if(data.value<0){
						$("#alert").html(data.message);
						$("#alert").dialog({
							position: 'center',
							resizable: false,
							modal: true,
							draggable: false,
							title: "Atenção",
							buttons: {"OK": function(){$(this).dialog('close');}}
						});
						$("#alert").dialog("open");
						return false;
					}
				}
			});
		}
});

</script>
<div class="content">
	<div class="text">
		Insira o seu nome de utilizador abaixo e enviaremos uma nova palavra passe.
	</div>
	<div class="block">
		<form class="form" id="form_recover" name="form_recover" action="<?php echo $conf['Caminho']['Url']?>/bo/login/email_recuperacao" method="post">
			<label for='Utilizador' accesskey='U'>Utilizador:</label>
			<input type="text" class="campos ui-widget-content ui-corner-all" name="Utilizador" id="Utilizador" /><br />
			<button type="submit" class="btn ui-state-default ui-corner-all">Enviar</button>
		</form>
	</div>
</div>