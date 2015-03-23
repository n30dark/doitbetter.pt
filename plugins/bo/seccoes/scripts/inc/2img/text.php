<?php
function imagecreatefromtext($file,$width=60,$height=80)
{
	$fd=fopen($file,'r');
	$gd=imagecreate($width,$height);
	imagefill($gd,0,0,imagecolorallocate($gd,255,255,255));
	
	$textcolor=imagecolorallocate($gd,204,204,204);
	
	$lineheight=8;
	
	$cheight=2-$lineheight;
	
	while( !feof($fd) &&  ($cheight+$lineheight)<$height )
		imagestring($gd,1,0,$cheight+=8,fgets($fd),$textcolor);
	
	fclose($fd);
	return $gd;
}
?>