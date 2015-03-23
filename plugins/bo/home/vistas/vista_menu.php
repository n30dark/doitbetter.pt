<?php
	$conf = $dados['conf'];
	$install = $dados['install'];
	
	$tabelas = explode(",", $install['Areas']['Tabelas']);
	$dados = explode(",", $install['Areas']['Dados']);
	
	$default = new Instalacao();
	$default->ficheiroInstall = "default.php";
	$default = $default->load();
	
	if($install['Configuracao']['eCommerce']){
		$ecommerce = new Instalacao();
		$ecommerce->ficheiroInstall = "ecommerce.ini";
		$ecommerce = $ecommerce->load();
		
		$stores = explode(",", $ecommerce['Areas']['Areas']);
	}
?>

<ul id="menu">
	<li>
	<a id="Configuração" href="#" class="newtab" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/configuracao")?>">Configuração</a>
	</li>
	<li>
	<a href="#">Administração</a>
	<ul>
		<li><a id="Utilizadores Admin" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/utilizadores_bo")?>">Utilizadores</a></li>
		<!--<li><a id="Grupos Admin" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/grupos_aut")?>">Níveis</a></li>-->
		<li><a id="Logs Admin" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/utilizadores_bo_temp")?>">Logs Utilizadores</a></li>
	</ul>
	</li>
	<li>
	<a href="#">Tabelas</a>
	<ul>
		<?php foreach($tabelas as $tabela):
			if(!isset($install[$tabela]['visivel'])){
		?>
		<li><a id="<?= $install[$tabela]['label']?>" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/".$install[$tabela]['nome'])?>"><?= $install[$tabela]['label']?></a></li>	
		<?php }
		endforeach;?>
	</ul>
	</li>
	<li>
	<a href="#">Dados</a>
	<ul>
		<?php foreach($dados as $dado):
			if(!isset($install[$dado]['visivel'])){
		?>
		<li><a id="<?= $install[$dado]['label']?>" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/".$install[$dado]['nome'])?>"><?= $install[$dado]['label']?></a></li>	
		<?php }
		endforeach;?>
	</ul>
	</li>
	<?php if($install['Configuracao']['Registo']):?>
	<li>
	<a href="#">Utilizadores</a>
	<ul>
		<li><a id="Utilizadores" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/utilizadores")?>">Utilizadores</a></li>
		<li><a id="Logs de Utilizadores" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/utilizadores_temp")?>">Logs Utilizadores</a></li>
	</ul>
	</li>
	<?php endif;
	if($install['Configuracao']['Contactos']):?>
	<li>
	<a id="Contactos" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/contactos")?>">Contactos</a>
	</li>
	<?php endif;
	if($install['Configuracao']['Newsletter']!=false):?>
	<li>
	<a href="#">Newsletter</a>
	<ul>
		<li><a id="Subscritores Newsletter" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/nl_subscritores")?>">Subscritores</a></li>
		<li><a id="Grupos Newsletter" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/nl_grupos")?>">Grupos</a></li>
		<li><a id="Newsletter" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/".(($install['Configuracao']['Newsletter']=='simples')?'newsletter':'newsletter_avancada'))?>">Newsletters</a></li>
	</ul>
	</li>
	<?php endif;
	if($install['Configuracao']['Guestbook']):?>
	<li>
	<a id="Guestbook" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/guestbook")?>">GuestBook</a>
	</li>
	<?php endif;
	if($install['Configuracao']['eCommerce']):?>
	<li>
	<a href="#">eCommerce</a>
	<ul>
		<?php foreach($stores as $store):
			if(!isset($ecommerce[$store]['visivel'])){
		?>
		<li><a id="<?= $ecommerce[$store]['label']?>" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/listar/".$ecommerce[$store]['nome'])?>"><?= $ecommerce[$store]['label']?></a></li>	
		<?php }
		endforeach;?>
	</ul>
	</li>
	<?php endif;?>
	<li>
	<a id="Ficheiros" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/ficheiros")?>">Ficheiros</a>
	</li>
	<!--<li>
	<a id="Ajuda" class="newtab" href="#" alt="<?= BO_URL::obterHrefInterno("bo/ajuda")?>">Ajuda</a>
	</li>-->
</ul>