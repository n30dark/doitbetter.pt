<?php
/*MODF: 08:54:00,10.07.07*/
include("inc/settings.php");

if( !$c_edit_files)
  exit;

$editor=null;


if( isset($_POST['type'],$_POST['file']) )
{
  $_GET['type']=$_POST['type'];
  $_GET['file']=$_POST['file'];
}

if( !isset($_GET['type']) )
  $_GET['type']=0;

switch($_GET['type'])
{
  case 2  :
    $editor="textaid";
    break;
  case 1  :
  default :
    $editor="text";
    break;
}

$path_shrt=securl(dirname($_GET['file']))."/";
$file_shrt=$path_shrt.basename($_GET['file']);
$path=t_folder."/".$path_shrt;
$file=t_folder."/".$file_shrt;

include("inc/editor/$editor.php");
?>