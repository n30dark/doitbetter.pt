<?php /*MODF: 14:48:00,22.07.07*/

if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')===false)
	echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<title>Fileview</title>
<?php
include_once("inc/file.php");
$fd=opendir($path);
$images=Array();
$good=GiveShowableTypes();
/*echo "<pre>";
print_r($good);
echo "</pre>";/**/
while($res=readdir($fd))
{
  $endung=strtolower(substr($res,strrpos($res,".")));
  //echo "<pre>$endung</pre>";
  if(in_array($endung,$good) )
    $images[]=$res;
}
$prev=$images[max(0,count($images)-1)];
$next=$images[min(count($images)-1,1)];
if($res=array_search(basename($_GET['file']),$images))
{
  $next=$images[$res+1>count($images)-1?0:$res+1];
  $prev=$images[$res-1<0?0:$res-1];
}

$burl=$_SERVER['PHP_SELF']."?type=2&amp;file=";

if(isset($_GET['interval'],$_GET['start']) )
	echo "<meta http-equiv='refresh' content=\"".$_GET['interval'].";URL=$burl$path_shrt$next&amp;start=start&amp;interval=".$_GET['interval']."\">";
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>">
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript" src="theme/viewer/diashow.js?v=0"></script>
<script language="javascript" type="text/javascript" src="theme/debug/debug.js?v=0"></script>
<link rel="stylesheet" href="theme/viewer/diashow.css" type="text/css" media="all"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<style type="text/css">
div#menubar { background-color:<?php echo $menu_color_hex; ?>;  }
</style>
<script language="javascript" type="text/javascript">
<!--//
var c_mov_type=Array(<?php echo '"'.implode('","',$c_video_ext).'"'; ?>);
var curfile=hexcode2string("<?php echo string2jscode(basename($_GET['file'])); ?>");
var curdir=hexcode2string("<?php echo string2jscode(dirname($_GET['file'])); ?>");
var ilink=hexcode2string("<?php echo string2jscode("menu.php?do=prv&typ=big&chf=".urlencode($_GET['file']));?>");
//-->
</script>
</head>
<body onload="changeimsize(false);AddEventListener('mousewheel',document.getElementById('withim'),movie_navi_onmousewheel,true);" onresize="changeimsize(true)">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" enctype="application/x-www-form-urlencoded" onSubmit="return !isNaN(this.interval.value)">
<div class='toolbar' style="z-index:2;">
  <a href='<?php echo $burl.urlencode($path_shrt.$prev);?>'><img src='theme/prev.gif' class="button"/></a>
  <a href='<?php echo $burl.urlencode($path_shrt.$next);?>'><img src='theme/next.gif' class="button"/></a>
  <input type='hidden' name='type' value='<?php echo $_GET['type'];?>'/>
  <input type='hidden' name='file' value='<?php echo $_GET['file'];?>'/>
  <?php echo "$l_viw_cp_dia: ".(isset($_GET['interval'],$_GET['start'])?"":"$l_viw_cp_interv :<input type='text' style='text-align:right;width:14px;' name='interval' maxlength='2' size='2' value='".(isset($_GET['interval'])?$_GET['interval']:5).
	 "'/>");?>
  <input type='submit' name='<?php echo (isset($_GET['interval'],$_GET['start'])?"stop":"start");?>' value='<?php echo (isset($_GET['interval'],$_GET['start'])?"$l_viw_cp_end":"$l_viw_cp_srt"); ?>'/> | <?php echo $l_viw_cp_file; ?>
  <span style='color:#999999;'><?php echo (strlen($file_shrt)>50?"..":"").substr($file_shrt,max(0,strlen($file_shrt)-50)); ?></span>
</div>
</form>
<div id='withim' align="center" onmouseover="movie_navi_draw(true)" onmousemove="movie_navi_draw(true)" onmouseout="movie_navi_draw(false)">
<img id="previewwait" src="theme/hourglass.gif" style="position:absolute;top:28px;left:2px" alt="<?php echo $l_fil_preview; ?>" title="<?php echo $l_fil_preview; ?>"/>
<div id="preview_movie_navi" onclick="movie_navi_alter(this)"><img id='preview_movie_navi_tab' src="theme/movie_navi_tab.png"/></div>
<img id='view' src="theme/loading.gif" alt="<?php echo $file_shrt; ?>" onload="movie_stopwaiting()"/>
<!--<pre style="text-align:center; color:#666666; letter-spacing: 2px; font-family:Arial, Helvetica, sans-serif; font-size: 12px;"><?php
$seurl=$path."/".$images[$res];
$seurl=substr($seurl,0,strrpos($seurl,".")).".txt";

if(is_file($seurl))
{
  $fd=fopen($seurl,"r");
  echo fread($fd,filesize($seurl));
  fclose($fd);
}
?></pre>-->
</div>
</body>
</html>