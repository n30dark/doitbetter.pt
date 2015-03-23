<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	$larguras = explode(',', urldecode($_POST['larguras']));
	$jpeg_quality = 90;

	$src = $_POST['cropimage'];
	
	list($width, $height, $type, $attr) = getimagesize($_POST['path'].$src);

	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	
	foreach($larguras as $largura){
		$altura = ($height*$largura)/$width; 
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'], $largura,$altura,$_POST['w'],$_POST['h']);
		header('Content-type: image/jpeg');
		$ficheiro = $_SERVER['DOCUMENT_ROOT'].$_POST['server'].substr($src, 0, -4)."_".$largura.".jpeg";
		imagejpeg($dst_r,$ficheiro,$jpeg_quality);
	}
	
	unlink($_SERVER['DOCUMENT_ROOT'] . $_POST['server']. $src);

	exit;
}
?>