<?php 
/*MODF:	22:15:00,14.03.07*/

// Loadsettings
include_once("inc/settings.php");
// include FileView interface
include_once("inc/fileview.php");


$do_change_in_folderview=false;
$path_to_transmit="";
if( isset($_GET['address']) )
{
	// is Hidden Adress valid?
	if( !isset($_GET['hid_address']) || securl($_GET['hid_address'])!=$_GET['hid_address'] || !is_dir(t_folder."/".$_GET['hid_address']) )
		$_GET['hid_address']=t_c_folder;
	
	$_GET['address']=securl($_GET['address']);

	//	Given Address valid?
	if( !is_dir(t_folder."/".$_GET['address']) )
		$_GET['address']=$_GET['hid_address'];
	else
	{
		$path_to_transmit=$_GET['address'];
		
		if( !isset($_GET['cfromfw']) )
			$do_change_in_folderview=true;
	}
}
?>
<?php echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $l_nav_t; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript" src="theme/address.js"></script>
<script language="javascript" type="text/javascript">
<!--//
var last_address="";
var l_multis_on=hexcode2string("<?php echo string2jscode($l_nav_multis_on); ?>");
var l_multis_of=hexcode2string("<?php echo string2jscode($l_nav_multis_of); ?>");

function startup_delayed()
{
	//	Check if frame with folder is loaded
	if( !(typeof parent.folderview.isfullyloaded) || true!=parent.folderview.isfullyloaded)
	{
		window.setTimeout('startup_delayed()',100);
		return;
	}

	<?php
	//	Has a request for changing site been successful -> load that page
	if($do_change_in_folderview)
		echo "parent.folderview.change2dir(last_address);";
	?>
}
//-->
</script>
</head>
<body onload="onloadf()">
<div class="toolbar">
	<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>" name="addressform">
		<input type="hidden" name="hid_address" value="<?php echo htmlentities(isset($_GET['address'])?$_GET['address']:t_c_folder); ?>" 
		/><img id="h_back" src="theme/history_backward_h.gif" alt="<?php echo $l_nav_back; ?>" title="<?php echo $l_nav_back; ?>"
		/><img id="h_forw" src="theme/history_forward_h.gif" alt="<?php echo $l_nav_forward; ?>" title="<?php echo $l_nav_forward; ?>"
		/><input type="text" class="ltext" name="address" id="address" value="<?php echo htmlentities(isset($_GET['address'])?$_GET['address']:t_c_folder); ?>"
		/><img onclick="window.document.addressform.submit();" src="theme/go2address.gif" class="button" alt="<?php echo $l_nav_browseUrl;?>" title="<?php echo $l_nav_browseUrl;?>" 
		/><?php if($f_right_to_upload) { ?>
<img src="theme/uploadwin.gif" class="button" onclick="openuploaddialogue()" title="<?php echo $l_nav_open_dlm; ?>" alt="<?php echo $l_nav_open_dlm; ?>"
		/><?php } ?><img id="multis" onclick="parent.multiselect=!parent.multiselect;checkmultiselect()" src="theme/multis_off.gif" class="button" alt="<?php echo $l_nav_multis_on;?>" title="<?php echo $l_nav_multis_on;?>" 
		/><?php if($f_right_to_crdir) { ?>
<img id="newdir" onclick="parent.fileview.menu_action_crdir();" src="theme/dirnewalt3.gif" class="button" alt="<?php echo $l_nav_crdir; ?>" title="<?php echo $l_nav_crdir;?>" 
		/><?php } ?><?php if($c_srch_enabled) { ?>
<img id="search" onclick="startsearch()" src="theme/search.gif" class="button" alt="<?php echo $l_nav_search; ?>" title="<?php echo $l_nav_search;?>" 
		/><?php } ?><select onchange="alterfileview(this)" id='fileview'>
<?php
$selfileview=(isset($_COOKIE['FileView'],$FileViews[$_COOKIE['FileView']])?$_COOKIE['FileView']:0);
foreach($FileViews as $key => $item)
{
	if( !in_array($item,$FileViewsExt) )
	{
		$tmp="";
		eval("\$tc=new $item;\n\$tmp=\$tc->getFileViewType('".$_COOKIE['Language']."');");
		echo "<option value='$key' ".($selfileview==$key?"selected='selected'":"").">$tmp</option>\r\n";
	}
}
?>
		</select><input type="button" class="button" value="&nbsp;?&nbsp;" onClick="about();"/>
	</form>
</div>
</body>
<script language="javascript" type="text/javascript" src="theme/afterjs.js"></script>
</html>