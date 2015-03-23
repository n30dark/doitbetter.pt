<?php
$conf = $dados['conf'];
?>
<script type="text/javascript">

$(function(){

	$("#recover_link").click(function(){
		$("#pass_recover").dialog("open");
	});
	
	$(".campos").focus(function(){
		$(this).toggleClass("ui-state-highlight");
	});

	$(".campos").blur(function(){
		$(this).toggleClass("ui-state-highlight");
	});

});

$("#form_login").validate({

		rules: {
			Utilizador: {
				required: true,
				alphanumeric: true
			},
			PalavraPasse:{
				required: true,
				alphanumeric: true
			}
		},
		messages: {
			Utilizador: {
				required: "Obrigatório",
				alphanumeric: "Letras, números, espaços e underscores apenas."
			},
			PalavraPasse: {
				required: "Obrigatório",
				alphanumeric: "Letras, números, espaços e underscores apenas."
			}
		},
		submitHandler: function(){
			$('#form_login').ajaxSubmit({
				type: 'POST',
				dataType: 'json',
				clearForm: true,
				success:function(data){
					if(data.value==0){
						//$("#login").dialog('close');
                                                location.reload(true);
						//$("#application").dialog('open');
                                                return false;
					}else if(data.value==-1){
						$("#alert").html(data.message);
						$("#alert").dialog({
							position: 'center',
							resizable: false,
							modal: true,
							draggable: false,
							dialogClass: 'ui-error',
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
<div id="distance"></div>
<div class="login_page">
    <div class="title">Administrator Interface</div>
    <div class="ver">ver. <div class="version_num">1.0</div> <div class="new_ver">nova</div></div>

    <div class="login_cont">
        <div class="login_logo"></div>
        <div class="login_content">
            <div class="actualizacoes"><span class="warning">Actualiza&ccedil;&atilde;o:</span> Administra&ccedil;&atilde;o com novas funcionalidades.</div>
            <div class="login_form">
                <form class="form" id="form_login" name="form_login" action="<?php echo $conf['Caminho']['Url']?>/bo/login/entrar" method="post">
                    <label for='Utilizador' accesskey='U'>Utilizador:</label>
                    <input type="text" class="campos " name="Utilizador" id="Utilizador" /><br />
                    <label for='PalavraPasse' accesskey='P'>Senha:</label>
                    <input type="password" class="campos " name="PalavraPasse" id="PalavraPasse" /><br />
                    <input type="checkbox" class="check" name="remind" id="remind" /> <span class="check_label">lembrar neste computador</span>
                    <br style="height:30px;"/>
                    <div class="buttons">
                        <button type="reset" id="reset_login" class="btn">Apagar</button>
                        <button type="submit" id="do_login" class="btn">Entrar</button>
                    </div>
                </form>
		<div class="recover"><a href="#" id="recover_link">Recuperar senha ou nome de utilizador.</a></div>
            </div>
        </div>
    </div>

    <div class="copyright">
        Todos os direitos reservados.
    </div>
</div>

