<?php 
/*MODF:	22:15:00,14.03.07*/

include_once("inc/settings.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Explorer</title>
<!-- PHex Plorer for PHP 4/5 by bluevirus-design, www.bluevirus.ch.vu -->
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>">
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript">
<!--//
var history_back=Array();
var history_forward=Array();
var history_pressed_hist_button=0;
var multiselect=false;
var l_err_jsblock=hexcode2string("<?php echo string2jscode($l_idx_err_jsblk); ?>");
var folders_offsetX=0;
var folders_offsetY=0;
//-->
</script>
</head>
<html>
<frameset rows="26,*" cols="*" border="0"<?php /*frameborder="no" framespacing="0"*/?>>
  <frame src="address.php" name="pathview" scrolling="NO" noresize >
  <frameset cols="200,*" border="2" bordercolor="#666"<?php /*framespacing="1" frameborder="1"*/?> >
    <frame src="folders.php" name="folderview" scrolling="auto">
    <frame src="files.php" name="fileview" scrolling="auto" style="border-left: 1px solid #666;">
  </frameset>
</frameset><noframes></noframes>
</html>
