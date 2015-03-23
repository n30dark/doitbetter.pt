<?php
header('Content-Type: text/html; charset='.$this->charset);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?= $this->charset ?>" />
		<title><?= $this->titulo ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?= $this->Conf['Caminho']['Url'] ?>/template/bo/imgs/favicon.ico" />
		<?php 
		foreach ($this->js as $js):?>
                    <script type="text/javascript" src="<?= $js?>" ></script>
		<?php endforeach;
		foreach ($this->css as $css):?>
                    <link rel="stylesheet" type="text/css" href="<?= $css?>" />
		<?php endforeach; ?>
		<script type="text/javascript">
			var path = "<?= $this->Conf['Caminho']['Url'] ?>";
			var path2 = "";
		</script>		
	</head>
	<body>
		<?= $this->mostrarBloco('stage')?>
	</body>
</html>