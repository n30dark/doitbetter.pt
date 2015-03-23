<?php
ob_start("ob_gzhandler");
/**
 * AlverByte BackOffice
 *
 * An open source application development framework for PHP
 * 
 * @author		Sérgio Paulino - neopaulino@gmail.com
 * @since		Version 1.0
 */

define('BO_LOADED', true);

error_reporting(E_ALL);

//carregar as bibliotecas necessárias
foreach(glob("lib/*.php") as $class_filename){
    require_once $class_filename;
}


$seguranca = new Seguranca();

$config = new Config();
$conf = $config->load();

$conf['Debug'] = 0;

debug("... a inicializar install ...", 2);
$install = new Instalacao();
$install = $install->load();
debug("... install inicializado ...", 2);

$QS = new QueryString();

debug("... Segmentos ".$QS->Segmentos[0]." ..." ,2);

if($QS->Segmentos[0] == 'bo'){
	$nomeTemplate = 'bo';
	if(!key_exists(1, $QS->Segmentos)){
		$QS->Segmentos[] = '';
	}

        if((!$seguranca->estaLigado()) && ($QS->Segmentos[1] != 'login')){
            echo '<script type="text/javascript">
				window.location.href="'.$conf['Caminho']['Url'].'/bo/login'.'"
			  </script>';
		exit;
        }
	
}else if($QS->Segmentos[0] == 'bo_old'){
	debug("... controlador bo_old ...", 2);
	$nomeTemplate = 'bo_old';
	if(!key_exists(1, $QS->Segmentos)){
		$QS->Segmentos[] = '';
	}
	
	if((!$seguranca->estaLigado()) && ($QS->Segmentos[1] != 'login')){
		echo '<script type="text/javascript">
				window.location.href="'.$conf['Caminho']['Url'].'/bo_old/login'.'"
			  </script>';
		exit;
	}
	
	if(($seguranca->estaLigado())&&($QS->Segmentos[1] != 'login')){
		header('Location: '. BO_URL::obterHrefInterno('bo_old/login'));
	}
		
}else if($QS->Segmentos[0] == "install"){
	$nomeTemplate = 'install';
}else{
	$nomeTemplate = 'site';
}

$template = new Template($nomeTemplate);
$template->titulo = $conf['Site']['Titulo'];
$template->charset = $conf['Site']['Charset'];
$template->Conf = $conf;
$template->definirURLBase($conf['Caminho']['Url']);

debug("... a executar install ...", 2);
$template->Instalacao = $install;

$dispatcher = new Dispatcher();
$dispatcher->controladorPredefinido = $nomeTemplate;
debug("... controlador predefinido $dispatcher->controladorPredefinido ...", 2);
$dispatcher->funcaoPredefinida = 'index';
debug("... funcao predefinida $dispatcher->funcaoPredefinida ...", 2);


$dispatcher->dispatch($QS->Segmentos);

debug("... a iniciar template... ", 2);
$template->mostrar();
?>