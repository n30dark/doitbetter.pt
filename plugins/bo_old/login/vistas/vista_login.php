<?php
debug('dentro do vista_login...', 2);
$conf = $dados['conf'];
/*$lingua = $dados['ling'];*/
?>
<script type="text/javascript">
function hov(loc,cls) { 
	if(loc.className) 
	loc.className=cls; 
}

function validaCampos(){
	if (frm.Utilizador.value == ""){
		alert('O campo Login n�o est� preenchido');
		return false;
	}
		if (frm.PalavraPasse.value == ""){
		alert('O campo Senha n�o est� preenchido');
		return false;
	}	
}
</script>
<div class="container_16 bg">
	<div class="grid_8 prefix_6 suffix_3 header">
		<div class="grid_5 suffix_5 logo">
			<img src="<?= BO_URL::obterHrefInterno('plugins/bo_old/login/imgs/logo.png')?>" alt="AlverByte BO">
		</div>
	</div>
	<div class="grid_8 prefix_6 suffix_3 content">
		<div class="grid_5 text subtitle">
			<span class="company_name"><?= $conf['Site']['Titulo'] ?></span> | BackOffice<br /><br />
			 <?php ?>Bem-vindo ao BackOffice, aqui poder&atilde;o inserir, alterar e remover os conte&uacute;dos que estar&atilde;o dispon&iacute;veis no site.
		</div>
		<div class="grid_5 text">
			Contacte para qualquer esclarecimento, sugest&atilde;o ou d&uacute;vida t&eacute;cnica <a href="mailto:suporte@alverbyte.com">suporte@alverbyte.com</a> ou atrav&eacute;s do telefone 000 000 000.
		</div>
		<form name="form_login" action="<?php echo $conf['Caminho']['Url']?>/bo_old/login/entrar" method="post" >
		<div class="grid_4 push_2 field">
			<div class="grid_1 alpha label">user:</div>
			<div class="grid_2 omega"><input type="text" class="campos" name="Utilizador" id="Utilizador" /></div>
		</div>
		<div class="grid_4 push_2 field">
			<div class="grid_1 alpha label">senha:</div>
			<div class="grid_2 omega fld"><input type="password" class="campos" name="PalavraPasse" id="PalavraPasse" /></div>
		</div>
		<div class="grid_1 prefix_4 ">
			<input type="submit" name="entrar" value="entrar" class="btn" onmouseover="hov(this,'btn btnhov')" onmouseout="hov(this,'btn')"/>
		</div>
	</div>
	<div class="grid_5 push_7 copyright">
		Desenvolvido por <a href="http://www.alverbyte.com">AlverByte</a> &copy; 2009 Todos os direitos reservados.
	</div>
	
</div>