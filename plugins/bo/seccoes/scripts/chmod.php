<?php 
/*MODF:	22:15:00,14.03.07*/

// Loadsettings
include_once("inc/settings.php");

if( !isset($_GET['mod']) )
{	?>
<script language="javascript" type="text/javascript">
<!--//
	window.close();
//-->
</script>
	<?php
	die('invalid arguments');
}

$mod=$_GET['mod'];
$chmv=array( array(false,false,false), array(false,false,false), array(false,false,false) );

for($i=0;$i<3;$i++)
{
	$num=substr($mod,$i,1);	settype($num,"integer");
	$mask=1; settype($mask,"integer");
	for($y=0;$y<3;$y++)
	{
		$chmv[$i][$y]=(($mask & $num) == $mask);
		$mask=$mask << 1;
	}
}
?>
<?php echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $l_fil_t; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript">
<!--//
function onloadf()
{
	
}
function selectf()
{
  var multiplier=1;
  var chmv=1000;
  for(i=0;i<3;i++)
  {
    for(y=1;y<=4;y++)
      if(y!=3)
      {
        var elem=document.getElementById('chm'+(multiplier*y));
        var valu=(elem.checked?parseInt(elem.value):0);
        chmv+=valu;
      }
    multiplier*=10;
  }
  window.opener.chmodsel_onselect(chmv.toString().substr(1,3) );
  window.close();
}
//-->
</script>
</head>
<body onLoad="onloadf()">
<div id="chmod" align="center">
<form name="chmod" method="get" action="#" onSubmit="return false">
<table border="0" cellspacing="0" cellpadding="1">
  <tr>
    <th>&nbsp;</th>
    <th><?php echo $l_chm_r;?></th>
    <th><?php echo $l_chm_w;?></th>
    <th><?php echo $l_chm_x;?></th>
  </tr>
  <tr>
    <th><?php echo $l_chm_owner;?></th>
    <td align="center"><input type="checkbox" id="chm100" name="r[]" value="400" <?php echo ($chmv[$i=0][$y=0]?"checked='checked'":""); ?> ></td>
    <td align="center"><input type="checkbox" id="chm200" name="r[]" value="200" <?php echo ($chmv[$i][++$y]?"checked='checked'":""); ?>></td>
    <td align="center"><input type="checkbox" id="chm400" name="r[]" value="100" <?php echo ($chmv[$i][++$y]?"checked='checked'":""); ?>></td>
  </tr>
  <tr>
    <th><?php echo $l_chm_group;?></th>
    <td align="center"><input type="checkbox" id="chm10" name="r[]" value="40" <?php echo ($chmv[++$i][$y=0]?"checked='checked'":""); ?>></td>
    <td align="center"><input type="checkbox" id="chm20" name="r[]" value="20" <?php echo ($chmv[$i][++$y]?"checked='checked'":""); ?>></td>
    <td align="center"><input type="checkbox" id="chm40" name="r[]" value="10" <?php echo ($chmv[$i][++$y]?"checked='checked'":""); ?>></td>
  </tr>
  <tr>
    <th><?php echo $l_chm_world;?></th>
    <td align="center"><input type="checkbox" id="chm1" name="r[]" value="4" <?php echo ($chmv[++$i][$y=0]?"checked='checked'":""); ?>></td>
    <td align="center"><input type="checkbox" id="chm2" name="r[]" value="2" <?php echo ($chmv[$i][++$y]?"checked='checked'":""); ?>></td>
    <td align="center"><input type="checkbox" id="chm4" name="r[]" value="1" <?php echo ($chmv[$i][++$y]?"checked='checked'":""); ?>></td>
  </tr>
  <tr>
    <td align="center" colspan="4"><input type="submit" onClick="selectf()" class="button" value="<?php echo $l_chm_save; ?>"/></td>
  </tr>
</table>

</form></div>
</body>
<script language="javascript" type="text/javascript" src="theme/afterjs.js"></script>
</html>