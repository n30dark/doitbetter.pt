<?php 
/*MODF: 23:52:00,10.07.07*/

// Loadsettings
include_once("inc/settings.php");
// include FileView interface
include_once("inc/fileview.php");
// Include Icon selector
include_once("inc/icons.php");
// Include File infos
//include_once("inc/file.php");



// Get opened folder
$opendir=isset($_GET['bf'])?securl($_GET['bf']):t_c_folder;

//Set fullpath
$fullpath=t_folder."/$opendir";

// Browse directory
$fd=@opendir($fullpath);
$dirs=array();
$files=array();
// And save all dirs and files seperatly in array
while($fd && $file=readdir($fd))
  if( $file!=".." && $file!="." )
    if(is_dir("$fullpath/$file") )
      $dirs[]=$file;
    else
      $files[]=$file;
// Nat sort array
natcasesort($dirs);
natcasesort($files);

$print="";

$sel_FileView=(isset($_COOKIE['FileView'],$FileViews[$_COOKIE['FileView']])?$_COOKIE['FileView']:0);
// Change FileView?
$sel_FileView=(isset($_GET['chfv'],$FileViews[$_GET['chfv']])?$_GET['chfv']:$sel_FileView);
if( isset($_GET['chfv']) )
  setcookie("FileView",$sel_FileView);

eval("\$print=".$FileViews[$sel_FileView]."::printview(\$fullpath,\$dirs,\$files);");
?>
<?php 
if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')===false)
	echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" onmousedown='start_selection()' onmouseup='drag_enabled=false;end_selection()'>
<head>
<title><?php echo $l_fil_t; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<link rel="stylesheet" href="theme/files.css" type="text/css" media="all"/>
<script language="javascript" type="text/javascript" src="theme/debug/debug.js?v=0"></script>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript">
<!--//
var dbg_enabled=<?php echo debug?'true':'false'; ?>;

var selectionOffsetY=<?php 
eval("echo ".$FileViews[$sel_FileView]."::selectionOffsetY();"); ?>;

var curdir=hexcode2string("<?php echo string2jscode($opendir); ?>");	// Current directory

/* Language vars */
var l_download  =hexcode2string("<?php echo string2jscode($l_fil_download); ?>");
var l_view_hex  =hexcode2string("<?php echo string2jscode($l_fil_view_hex); ?>");
var l_view_html =hexcode2string("<?php echo string2jscode($l_fil_view_html); ?>");
var l_view_text =hexcode2string("<?php echo string2jscode($l_fil_view_text); ?>");
var l_view_dia  =hexcode2string("<?php echo string2jscode($l_fil_view_dia); ?>");
var l_edit_text =hexcode2string("<?php echo string2jscode($l_fil_edit_text); ?>");
var l_opendir   =hexcode2string("<?php echo string2jscode($l_fil_opendir); ?>");
var l_ren       =hexcode2string("<?php echo string2jscode(html_entity_decode($l_fil_ren)); ?>")
var l_renprompt =hexcode2string("<?php echo string2jscode(html_entity_decode($l_fil_renPrompt)); ?>");

var l_del       =hexcode2string("<?php echo string2jscode(html_entity_decode($l_fil_del)); ?>");
var l_del4f_p   =hexcode2string("<?php echo string2jscode(html_entity_decode($l_fil_del4f_p)); ?>");
var l_del4d_p   =hexcode2string("<?php echo string2jscode(html_entity_decode($l_fil_del4d_p)); ?>");
var l_del_all   =hexcode2string("<?php echo string2jscode(html_entity_decode($l_fil_delall)); ?>");
var l_crdir_p   =hexcode2string("<?php echo string2jscode(html_entity_decode($l_fil_crdir_pt)); ?>");
var l_crdir_name=hexcode2string("<?php echo string2jscode(html_entity_decode($l_fil_ndirname)); ?>");

var l_cpy       =hexcode2string("<?php echo string2jscode($l_fil_cpy); ?>");
var l_mov       =hexcode2string("<?php echo string2jscode($l_fil_mov); ?>");
var l_chm       =hexcode2string("<?php echo string2jscode($l_fil_chm); ?>");
var l_zipcreate =hexcode2string("<?php echo string2jscode($l_fil_zipcreate); ?>");
var l_zipextrct =hexcode2string("<?php echo string2jscode($l_fil_zipextrct); ?>");
var l_fil_srcstp=hexcode2string("<?php echo string2jscode($l_fil_srcstp); ?>");

/* Settings */
var c_dblclktime_ms =<?php echo $menu_doubleclicktime_ms; ?>;
var c_img_type  =Array(<?php  echo '"'.implode('","',GiveShowableTypes() ).'"'; ?>);
var c_img_thb   =<?php  echo ($c_imagemodul?"true":"false");?>;
var c_mov_type  =Array(<?php echo '"'.implode('","',$c_video_ext).'"'; ?>);
var c_viewer    =<?php  echo ($c_view_files?"true":"false"); ?>;
var c_vw_tx_type=Array(<?php echo '"'.implode('","',$c_view_text_ext).'"'; ?>);
var c_vw_ht_type=Array(<?php echo '"'.implode('","',$c_view_html_ext).'"'; ?>);
var c_edit      =<?php  echo ($c_edit_files?"true":"false"); ?>;
var c_ed_tx_type=Array(<?php echo '"'.implode('","',$c_edit_txt_ext).'"'; ?>);
var c_rename    =<?php  echo ($f_right_to_rename?"true":"false"); ?>;
var c_delete    =<?php  echo ($f_right_to_delete?"true":"false"); ?>;
var c_movcpy    =<?php  echo ($f_right_to_moveNcopyto?"true":"false"); ?>;
var c_chmod     =<?php  echo ($f_right_to_chmod?"true":"false"); ?>;
var c_zip       =<?php  echo ($f_right_to_zip?"true":"false"); ?>;
 
var marked_items=Array();
var all_items   =Array();
//-->
</script>
<script language="javascript" type="text/javascript" src="theme/files.js?v=2"></script>
</head>
<body onload="onloadf();AddEventListener('mousewheel',document.getElementById('previewd'),movie_navi_onmousewheel,true);" ondragstart="return false" onselectstart="return false">
<?php
echo $print;
?>
<div id='selection' onmouseup='end_selection();'></div>
<div id='dragjob' onmouseup='drag_end();'></div>
<div id='menu' onmouseout="menuaction(false);" onmouseover="menuaction(true);">
  <h1 id='menu_name' onmouseout="menuaction(false);" onmouseover="menuaction(true);">..</h1
  ><a id="menu_dblclk" class="seperator" onmouseout="menuaction(false);" onmouseover="menuaction(true);" href="#">&#035;</a
  ><div id='menubt'></div
  ><div id="previewd" onmouseover="movie_navi_draw(true)" onmouseout="movie_navi_draw(false)"><img id="previewwait" src="theme/hourglass.gif" style="position:absolute;" alt="<?php echo $l_fil_preview; ?>" title="<?php echo $l_fil_preview; ?>"/><img id="preview" onload="movie_stopwaiting()" src="theme/leer.gif" alt=''/><div
  id="preview_movie_navi" onclick="movie_navi_alter(this)"><img id='preview_movie_navi_tab' src="theme/movie_navi_tab.png"/></div></div
  ><div id="menuplus"><div class='info'><b><?php echo $l_fil_atime; ?></b><span id='menu_atime'>..</span></div
  ><div class='info'><b><?php echo $l_fil_mtime; ?></b><span id='menu_mtime'>..</span></div
  ><div class='info'><b><?php echo $l_fil_ctime; ?></b><span id='menu_ctime'>..</span></div
  ><div class='info'><b><?php echo $l_fil_fsize; ?></b><span id='menu_size'>..</span></div
  ><div class='info'><b><?php echo $l_fil_chmod; ?></b><span id='menu_chmod'>..</span></div></div>
</div>
</body>
<script language="javascript" type="text/javascript" src="theme/afterjs.js"></script>
</html>