<?php 
/*MODF: 23:52:00,10.07.07*/

$nlat=24;           //  # chars horizontally
$height=16;         //  # chars vertically
$vert_spacer=8;     //  every # lines will be a spacer
$horz_spacer=8;     //  every # chars will be a spacer

$inv_sign="&bull;"; // sign for white chars


$page=0;
$max_page=floor(FileSize2($file)/($nlat*$height));
if(isset($_GET['page2']) and $_GET['page2']<FileSize2($file) )
  $_GET['page']=$_GET['page2']-1;
if(isset($_GET['page']) )
  $page=max(0,min($max_page,$_GET['page']) );

$startat=$nlat*$height*$page;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Simple hex viewer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="theme/viewer/hexedit.css" type="text/css" media="all">
<style type="text/css" media="all">
table.n tr th { background-color: <?php echo $menu_color_hex; ?>;  }
table.n a     { background-color: <?php echo $menu_color_hex; ?>;  }
</style>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript">
<!--//
var nlat=<?php echo $nlat;?>;
var last_nh=null;               // zuletzt geändertes Objekt
var last_nh_class=null;         // Klassen Namen des Objekt
var inv_sign="<?php echo $inv_sign; ?>";         // Zeichen für nicht sichtbares
//-->
</script>
<script language="javascript" type="text/javascript" src="theme/viewer/hexedit.js"></script>
<script language="javascript" type="text/javascript" src="theme/debug/debug.js?v=0"></script>
</head>
<body>
<table width="881" class="n" cellpadding="0" cellspacing="0">
<?php 
$zeilencol="";
$hexcol="";
$txtcol="";

$fd=fopen($file,"rb");
if($startat>0)
	fseek($fd,$startat,SEEK_SET);
$temp=fread($fd,$nlat*$height);
fclose($fd);

$i=0;
for($i=0;$i<strlen($temp);$i++)
{
	$chr=substr($temp,$i,1);
	$num=ord($chr);
	
	$class="";
	
	//	Ist das Zeichen darstellbar?
	if( (31<$num and $num<127) or (160<$num and $num<256) )
		$chr=str_replace(" ","&nbsp;",htmlentities($chr));
	else
	{	$class.="s";
		$chr=$inv_sign;	}
		
	$txtcol.="<span id='t$i' onclick='i($i,0)' onmouseover='nh(\"h$i\""/*,".($class=="n"?"true":"false")*/.")' onmouseout='nh(null,true)' class='n$class'>$chr</span>";
	
	$hexcol.="<span id='h$i' onclick='i($i,1)' onmouseover='nh(\"t$i\""/*,".($class=="n"?"true":"false")*/.")' onmouseout='nh(null,true)' class='h$class'>".($num<16?"0":"").dechex($num)."</span>";
	
	//	Neue Zeile?
	if($i%$nlat==($nlat-1))
	{
		$txtcol.="<br/>\r\n";
		$hexcol.="<br/>\r\n";
		
		/*if(strlen($temp)>($i+1))
		{*/
			$tmp=dechex($startat+$i+1-$nlat);
			while(strlen($tmp)<8)
				$tmp="0$tmp";
			$zeilencol.="$tmp<br/>\r\n";
		/*}*/
		
		// Vertical spacer?
		if($i/$nlat%$vert_spacer==($vert_spacer-1))
		{
			$txtcol.="<br/>\r\n";
			$hexcol.="<br/>\r\n";
			$zeilencol.="<br/>\r\n";
		}
	}
	// Horizontal Spacer?
	elseif( ($i%$nlat%$horz_spacer)==($horz_spacer-1) )
	{
		$hexcol.="&nbsp;";
		$txtcol.="&nbsp;&nbsp;";
	}
	
}

if($i%$nlat!=0 )
{
	$tmp=dechex($startat+$i-$i%$nlat);
	while(strlen($tmp)<8)
		$tmp="0$tmp";
	$zeilencol.="$tmp<br/>\r\n";
}
echo "<tr><th width='64'>#</th>\r\n<th width='592' colspan='2'>$l_viw_hx_th_hx</th>\r\n<th width='225'>$l_viw_hx_th_tx</td></tr>\r\n";
echo "<tr><th align='right'>$zeilencol</th>\r\n<td colspan='2'>$hexcol</td>\r\n<td>$txtcol</td></tr>\r\n";

$querystring="type=".$_GET['type']."&amp;file=".$_GET['file'];
$tmp="<a href='".$_SERVER['PHP_SELF']."?".$querystring."&amp;page=0'>|&lt;&lt;</a>&nbsp;&nbsp;&nbsp;".
	 "<a href='".$_SERVER['PHP_SELF']."?".$querystring."&amp;page=".max(0,$page-1)."'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;".
	 "<a href='".$_SERVER['PHP_SELF']."?".$querystring."&amp;page=".min($max_page,$page+1)."'>&gt;&gt;</a>&nbsp;&nbsp;&nbsp;".
	 "<a href='".$_SERVER['PHP_SELF']."?".$querystring."&amp;page=".$max_page."'>&gt;&gt;|</a>";

echo "<tr><th>$l_viw_hx_file</th>\r\n<td width='430'>".substr($file_shrt,max(strlen($file_shrt)-50,0)).//$_GET['file'].
	 "</td>\r\n<td width='162'><form style='height:14px;margin:0px;padding:0px;font-size:12px;' method='get' action='".$_SERVER['PHP_SELF'].
	 "' enctype='application/x-www-form-urlencoded'>$l_viw_hx_page <input style='height:11px;margin-bottom:1px;font-size:11px;border:0px solid #ffffff;".
	 "width:".(strlen($max_page)*6)."px;text-align:right;' type='text' size='".strlen($max_page).
	 "' maxlength='".strlen($max_page)."' name='page2' value='".($page+1)."'/>/".($max_page+1).
	 "<input type='hidden' name='type' value='".$_GET['type']."'/><input type='hidden' name='file' value='".$_GET['file']."'/>".
	 "</form></td>\r\n<th>$tmp</th>\r\n</tr>\r\n";
?>
<tr>
<th colspan='4'>
<?php echo $l_viw_hx_dec; ?>:<input type="text" id="dec" size="10" maxlength="10" onkeyup="gdec(this)" value="">&nbsp;&nbsp;&nbsp;
<?php echo $l_viw_hx_hex; ?>:<input type="text" id="hex" size="8" maxlength="8" onkeyup="ghex(this)" value="">&nbsp;&nbsp;&nbsp;
<?php echo $l_viw_hx_chr; ?>:<input type="text" id="chr" size="1" maxlength="1" onkeyup="gchr(this)" value="">
</th></tr>
</table>
</body>
</html>
