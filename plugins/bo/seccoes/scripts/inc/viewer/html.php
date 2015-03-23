<?php 
if(isset($_GET['flow']) and $_GET['flow']==1 and !isset($_GET['htyp']) )
{
  error_reporting(0);
  $fd=fopen($file,"rb");

  if($fd!==false)
    echo fread($fd,filesize($file));
  fclose($fd);
}
elseif(isset($_GET['htyp']) )
{
  if(isset($_GET['htyp']) )
  switch($_GET['htyp'])
  {
    case 1  :
    default :
      header("Content-type: text/css;");
      break;
  }
  
  $burl="viewer.php?type=".$_GET['type']."&flow=1&file=".dirname($path_shrt)."/";	//basic url
  
  $fd=fopen($file,"rb");
  $input=fread($fd,min($c_view_html_maxsize_kb*1024,filesize($file)));
  $input=preg_replace("/(url\()([\"|\']?)(.*?)([\"|\']?)(\))/i",'${1}\''.$burl.'${3}\'${5}',$input);
  echo $input;
}
else
{
  $fd=fopen($file,"rb");
  $input=fread($fd,min($c_view_html_maxsize_kb*1024,filesize($file)));
  
  $burl="viewer.php?type=".$_GET['type']."&amp;flow=1&amp;";	//basic url
  function callback_preg($m)
  {
    global $burl,$path_shrt;
    if(preg_match("/javascript\:/",$m[3]))
            return $m[0];
    if(preg_match("/http([s]*):/si",$m[0]))
            return $m[0];
    if(strpos($m[3],"#")===0)
            return $m[0];
    return $m[1].$m[2].$burl.(strpos($m[3],".css")?"htyp=1&amp;":"")."file=".urlencode($path_shrt.$m[3]);
  }
  function callback_two($m)
  {
    global $burl,$path_shrt;
    $p1=strrpos($m[0],"@import");
    $part1=substr($m[0],0,$p1+9);						// bis URL
    $part2=str_replace("&amp;","&",$burl)."htyp=1&file=".$path_shrt.substr($m[0],$p1+9);	// URL
    return $part1.$part2;
  }
  //	Suchen und ersetzen f�r src=,href=,action=,url=
  $input=preg_replace_callback("/(src\=|href\=|action\=|url\=|background\=)(\"|\'){0,1}([^\"\'\>]+)/i","callback_preg",$input);
  //	Suchen und ersetzen f�r css: url(..)
  $input=preg_replace_callback("/(url\()(\"|\'){0,1}([^\"\'\>\s\)]+)/si","callback_preg",$input);
  //	Suchen und ersetzten f�r css: @import
  $input=preg_replace_callback("/(\<style)([^\>]*)(\>)([^\@]*)(\@import)([\s]+)([\"\']?)([^\;]+)(\;)/siU","callback_two",$input);

  echo $input;
}
?> 