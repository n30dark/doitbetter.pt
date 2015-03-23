<?php
class login_plugin extends Plugin{
	
	function index(){
		$variaveis = new Buffer();

                $this->template->adicionarJS('js/jquery-1.3.2.min.js');
		$this->template->adicionarJS('js/jquery-ui-1.7.2.custom.min.js');
		$this->template->adicionarJS('js/jquery.easing.1.3.js');
		$this->template->adicionarJS('js/jquery.form.js');
		$this->template->adicionarJS('js/jquery.validate.js');
		$this->template->adicionarJS('js/flexigrid.js');
		$this->template->adicionarJS('js/easyTooltip.js');
		$this->template->adicionarJS('js/jquery.metadata.js');
		$this->template->adicionarJS('js/jqueryFileTree.js');
		$this->template->adicionarJS('js/menu-collapsed.js');
		$this->template->adicionarJS('js/menu.js');
		$this->template->adicionarJS('js/additional-methods.js');
		$this->template->adicionarJS('js/bofunctions.js');
		$this->template->adicionarJS('js/jquery.ajaxMultiFileUpload.js');
		$this->template->adicionarJS('js/jquery.livequery.min.js');
		$this->template->adicionarJS('js/ckeditor/ckeditor.js');
		$this->template->adicionarJS('js/dialog-patch.js');
		$this->template->adicionarJS('js/jquery.imgareaselect.js');
                $this->template->adicionarJS('js/ui.multiselect.js');
                $this->template->adicionarJS('js/jquery.jclock-1.2.0.js');
                $this->template->adicionarJS('js/jquery.tzineClock.js');
		//$this->template->adicionarJS('js/ckeditor/adapters/jquery.js');
		//$this->template->adicionarJS('js/ckeditor/_samples/sample.js');
		//$this->template->adicionarCSS('js/ckeditor/_samples/sample.css');
		$this->template->adicionarCSS('estilos/cms_login.css');
                $this->template->adicionarCSS('estilos/jquery.tzineClock.css');
		$this->template->adicionarCSS('estilos/flexigrid.css');
		$this->template->adicionarCSS('estilos/jquery-ui-1.7.2.custom.css');
		$this->template->adicionarCSS('estilos/jqueryFileTree.css');
		$this->template->adicionarCSS('estilos/mbContainer.css');
		$this->template->adicionarCSS('js/reditor/css/style.css');
		$this->template->adicionarCSS('estilos/imgareaselected-default.css');
		$this->template->adicionarCSS('estilos/mfu.style.css');
                $this->template->adicionarCSS('estilos/ui.multiselect.css');
                $this->template->adicionarCSS('estilos/common.css');

		$variaveis->adicionar('conf', $this->Conf);
        
		$vista = new Vista('vista_login');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = "login";
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
        
        $QS = new QueryString();
        $segs = $QS->Segmentos;
        if($segs[count($segs)-1]=='err'){
            echo "<script>alert('Username ou palavra passe inválida!');</script>";
        }
	}
	
	function entrar(){
		$this->template->abortar = true;
		
		$utilizador = $_POST['Utilizador'];
		$passe = $_POST['PalavraPasse'];
		
		$seg = new Seguranca();
		$ok = $seg->autenticar($utilizador, $passe);
		
		if($ok === true){
                        BO_JAVASCRIPT::location_href(BO_URL::obterHrefInterno('bo'));
			$json = "{'message': 'success', 'value': '0'}";
		}else{
			$json = "{'message': 'Dados de Utilizador ou Palavra Passe incorrectos.', 'value': '-1'}";
                        BO_JAVASCRIPT::location_href(BO_URL::obterHrefInterno('bo/login/err'));
		}
		
		//echo $json;
	}
	
	function sair(){
		$this->template->abortar = true;
		
		$seg = new Seguranca();
		$seg->sair();

                BO_JAVASCRIPT::location_href(BO_URL::obterHrefInterno('bo/login'));

		//$json = "{'message': 'success', 'value': '0'}";
		
		echo $json;
	}
	
	function recuperar_password(){
		$variaveis = new Buffer();
		
		$variaveis->adicionar('conf', $this->Conf);
		
		$vista = new Vista('vista_recuperar_password');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		
		$bloco = "recuperar_password";
		$this->template->adicionarVista($vista, $bloco);
		$this->template->mostrarBloco($bloco);
	}
	
	function email_recuperacao(){
		$this->template->abortar = true;
		$bd = new BaseDados();
		
		$user = $_POST['Utilizador'];
		
		$utilizador = $bd->obterObjecto("SELECT * FROM utilizadores_bo WHERE utilizador='$user'");

		$password = $this->generatePassword();
		
		if($bd->contar()==1){
			$mensagem = "Caro Sr(a). $utilizador->nome,
					<br />
					Serve este email para o informar da recuperação de password para o 
					BackOffice do site ".$this->Conf['Site']['Titulo'].". 
					<br /><br />
					<b>Username:</b> $utilizador->utilizador
					<br /><br />
					<b>Password:</b> $password
					<br /><br />
					<hr /> Este email é gerado automaticamente pelo seu BackOffice.<br /><br />2009 &copy; AlverByte. Todos os direitos Reservados. <br /> <a href='".$this->Conf['Caminho']['Url']."/bo'>Backoffice</a>";
			
			$json = new Email(
						$utilizador->email, 
						$this->Conf['Site']['Email'], 
						$this->Conf['Site']['Titulo'], 
						"BackOffice ".$this->Conf['Site']['Titulo'].": Recuperação de Password", 
						$mensagem,
						$this->Conf['Site']['Email']
					);
		}else{
			$json = '{"message" : "O utilizador que colocou não existe.", "value" : "-3"}';
		}
		echo $json;
		return;
	}
	
	function generatePassword ($length = 8){
	  $password = "";
	  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
	  $i = 0; 
	  while ($i < $length) { 
	    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
	    if (!strstr($password, $char)) { 
	      $password .= $char;
	      $i++;
	    }
	  }
	  return $password;
	}
	
}