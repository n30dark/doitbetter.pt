<?php
header('Content-Type: text/html; charset='.$this->charset);

$metatags = new BO_PAGETITLE();
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?= $this->charset ?>" />
		<meta name="description" content="<?= $metatags->obterMetadescription() ?>" />
		<meta name="keywords" content="<?= $metatags->obterKeywords() ?>" />
		<meta name="author" content="<?= $this->Conf['Site']['Autor'] ?>" />
		
		<title><?= $this->titulo." - ".$metatags->obterPagetitle(); ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?= $this->Conf['Caminho']['Url'] ?>/template/site/imgs/favicon.ico" />
		<?php		
			foreach ($this->css as $css):?>
		<link rel="stylesheet" type="text/css" href="<?= $css?>" />
		<?php endforeach; ?>
		<script type="text/javascript">
			var path = "<?= $this->Conf['Caminho']['Url']?>";
		</script>
				<?php
			foreach ($this->js as $js):?>
				<script type="text/javascript" src="<?= $js?>" ></script>
		<?php endforeach;?>	

	</head>
	<body>
            <?=	$this->mostrarBloco('stage'); ?>
	</body>
</html>	