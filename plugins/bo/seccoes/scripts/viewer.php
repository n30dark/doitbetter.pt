<?php
include("inc/settings.php");

$viewer="hexedit";
if(isset($_GET['type']) )
	switch($_GET['type'])
	{
		case 3	:
			$viewer="text";
			break;
		case 2	:
			$viewer="diashow";
			break;
		case 1	:
			$viewer="html";
			break;
		case 0	:
			$viewer="hexedit";
			break;
	}

$path_shrt=securl(dirname($_GET['file']))."/";
$file_shrt=$path_shrt.basename($_GET['file']);
$path=t_folder."/".$path_shrt;
$file=t_folder."/".$file_shrt;

include("inc/viewer/$viewer.php");
?>