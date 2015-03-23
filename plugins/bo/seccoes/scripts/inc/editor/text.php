<?php
/*MODF: 08:54:00,10.07.07*/
echo '<?xml version="1.0" encoding="'.$l_charset.'"?>';
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php echo $l_edt_txt_t; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset ?>" />
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<link rel="stylesheet" href="theme/editor/text.css" type="text/css" media="all"/>
<script language="javascript" type="text/javascript" src="theme/debug/debug.js?v=0"></script>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript" src="theme/ajax.js"></script>
<script language="javascript" type="text/javascript" src="theme/editor/text.js"></script>
<script type="text/javascript">
<!--//
var l_err_nodata=hexcode2string("<?php echo string2jscode($l_edt_err_nodata); ?>");
var l_err_no_tmp=hexcode2string("<?php echo string2jscode(html_entity_decode($l_edt_err_ns_tmp)); ?>");
var l_err_no_mov=hexcode2string("<?php echo string2jscode(html_entity_decode($l_edt_err_ns_mov)); ?>");
var l_err_no_ulk=hexcode2string("<?php echo string2jscode(html_entity_decode($l_edt_err_ns_unlk)); ?>");
var l_err_gl_noc=hexcode2string("<?php echo string2jscode(html_entity_decode($l_edt_err_gl_noac)); ?>");

var file_shrt=hexcode2string("<?php echo string2jscode($file_shrt); ?>");
var textloading=hexcode2string("<?php echo string2jscode($file_shrt); ?>");               // saves on what line we are now
var maxlines=-1;
//-->
</script>
</head>
<body onload="startup();">

<!-- Edit frame -->
<table id="editframe" width="100%" cellpadding="0" cellspacing="0">
 <tr>
  <td style='height:24px' colspan="2">
<!-- Menubar -->
<div class="toolbar">
<img src="theme/uploadfile.gif" class="button" onclick='save()' title="<?php echo $l_edt_but_save; ?>" alt="<?php echo $l_edt_but_save; ?>"/>
<?php echo "$l_edt_txt_fname: ".htmlentities($file_shrt); ?>
<div id="progressbar"><div id="progressvalue">&nbsp;</div><div id="progresstext"></div></div>
</div>
    </td>
  </tr>
  <tr>
    <td id="linenumbers" style="overflow:hidden; width:1px;">..</td>
    <td id="edittext"><textarea id='edittextarea' rows="10" cols="40"></textarea></td>
  </tr>
</table>
</body>
</html>