<?php
class login_plugin extends Plugin{
	
	function index(){
		
		debug('entrei no index...', 2);
		$variaveis = &new Buffer();
		
		//$this->template->adicionarJS('js/validacao.js');
		debug('js adicionado...', 2);
		$this->template->adicionarCSS('estilos/bo_old.css');
		$this->template->adicionarCSS('estilos/960.css');
		debug('css adicionado...', 2);
		
		/**$lingua = &new Lingua($this->template->lingua);
		$lingua->carregar('login');
		*/
		$variaveis->adicionar('conf', $this->Conf);
		/*$variaveis->adicionar('ling', $this->lingua);*/
		debug('variaveis adicionadas...', 2);
				
		$vista = &new Vista('vista_login');
		$vista->caminhoBase = $this->caminhoBase . '/vistas';
		$vista->variaveis = $variaveis->toArray();
		$this->template->adicionarVista($vista, 'stage');
		debug('vista adicionada ['.$vista->caminhoBase.'/'.$vista->nome.']...', 2);
	}
	
	function sair($parametros){
		$this->template->abortar = true;
		
		$seg = &new Seguranca();
		$seg->sair();
		
		echo '<script type="text/javascript">window.location.href="'. $this->Conf['Caminho']['Url'].'/bo_old"</script>';
	}
	
	function entrar(){
		$this->template->abortar = true;

		$utilizador = $_POST['Utilizador'];
		$passe = $_POST['PalavraPasse'];
		
		$seg = &new Seguranca();
		$ok = $seg->autenticar($utilizador, $passe, 0);		
		
		echo "<script>alert('".$ok."');</script>";
		
		if($ok === true){
			echo '<script type="text/javascript">window.location.href="'. $this->Conf['Caminho']['Url'].'/bo_old/home"</script>';
		}else{
			echo '<script type="text/javascript">window.location.href="'. $this->Conf['Caminho']['Url'].'/bo_old/login"</script>';
		}
	}
}
?>