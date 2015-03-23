<?php
	$conf = $dados['conf'];
	$install = $dados['install'];
        $seccao = $dados['seccao'];
        $subseccao = $dados['subseccao'];
        $action = $dados['action'];
	$plug = new GestorPlugins();
	$plug->controlador = 'bo';

        $browser = BO_BROWSER::obter_browser();

        /**($browser==="IE")?"100%":"hnonie";*/
?>
<script type="text/javascript">
$.ui.dialog.defaults.bgiframe = true;
$(function(){

	$("a.tip").easyTooltip();

        $(".multiselect").multiselect();

	var altura = $(window).height()-80;
	var largura = $(window).width()-30;

	$("#login").dialog({
		resizable: false,
		position: 'center',
		draggable: false,
		<?= (isset($_COOKIE['utilizadores_bo']))?"autoOpen: false,":"autoOpen: true,";?>
		closeOnEscape: false,
		close: function(){
			$("#login").dialog('close');
			$("#login").dialog('open');
                        return false;
		}
	});

	$("#pass_recover").dialog({
		resizable: false,
		position: 'center',
		modal: true,
		autoOpen: false
	});	

	$("#application").dialog({
		resizable: false,
		draggable: false,
		position: 'center',
		<?= (isset($_COOKIE['utilizadores_bo']))?"autoOpen: true,":"autoOpen: false,";?>
		height: altura,
		width: largura,
		closeOnEscape: false,
		close: function(){
                        $("this").dialog('destroy');
                        $.post("<?= BO_URL::obterHrefInterno('bo/login/sair'); ?>");
			$("#login").dialog('open');
                        return false;
		}
	});

	$(".newtab").click(function(){
		tabs = tabs + 1;
		var url = $(this).attr('alt');
		var label = $(this).attr('id');
		$("#tabs").tabs('remove', 1);
		$("#tabs").tabs('add', url, label);
		$("#tabs").tabs('select', 1);
	});
});

$(".newtab").click(function(){
	tabs = tabs + 1;
	var url = $(this).attr('alt');
	var label = $(this).attr('id')+'<span alt="' + 1 + '" class="tab-close ui-icon ui-icon-closethick" unselectable="on" style="-moz-user-select: none;">close</span>';
	$("#tabs").tabs('remove', 1);
	$("#tabs").tabs('add', url, label);
	
});
</script>

<!-- Janela de login -->
<!--<div id="login" title="Login">
	<?php //$plug->dispatch(array('login', 'login'));?>
</div>-->
<!-- fim da janela de login -->

<!-- Janela de recuperação de password -->
<div id="pass_recover" title="Recuperação de Password">
	<?php $plug->dispatch(array('login', 'recuperar_password'));?>
</div>
<!--  Fim de janela de recuperação de password -->

<!-- Janela de alert/info -->
<div id="alert" title="">
</div>
<!-- Fim da janela de alert/info -->

<!-- Janela de Aplicação -->
<div class="application" <?= (!isset($_COOKIE['utilizadores_bo']))?"style='display:none;'":"";?>>
    <?php $plug->dispatch(array('home', 'home', $seccao, $subseccao, $action));?>
</div>
<!-- Fim da janela de aplicação -->