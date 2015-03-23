<?php 
/*MODF:	22:15:00,14.03.07*/

// Loadsettings
include_once("inc/settings.php");


// Load open folders
$opendirs=isset($_GET['od'])?decode_ods($_GET['od']):array();

//	Expanding or Collapsing Folder?
if( isset($_GET['nod']) )
{
	$_GET['nod']=str_replace("\\'","'",$_GET['nod']);

	//	Is folder not yet expanded?
	if(!in_array($_GET['nod'],$opendirs) )
	{		
		$pB4="";
		$ps=explode("/",securl($_GET['nod']));
		
		// Expand every path above and this one
		foreach($ps as $p)
		{
			$pB4.=$p;
			if(!in_array($pB4,$opendirs) )
				$opendirs[]=$pB4;
			
			$pB4.="/";
		}
	}	
	else
	// Collapse
	{
		$ta=array();
		foreach($opendirs as $dir)
			if( $dir!="" && strpos($dir,$_GET['nod'])===false )
				$ta[]=$dir;
		$opendirs=$ta;
	}
}
?>
<?php echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php echo $l_sld_t; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript" src="theme/folder.js"></script>
<script language="javascript" type="text/javascript">
<!--//
var markednum=null;
var markedname=null;
var thispage="<?php echo $_SERVER['PHP_SELF']; ?>";

function opendir_spec(hexc)
{	}

function selectdir_spec(path,objn)
{
	opener.foldersel_onselect(path);
	window.close();
}
//-->
</script>
</head>
<body onload="dirs_restore_offset_pp()" onunload="dirs_save_offset_pp()">
<div class="folderlist">
<?php
$dirs=new TreeDir($opendirs);
$dirs->printtree( isset($_GET['sd'])?securl($_GET['sd']):NULL );
?>
</div>
<input type="hidden" id="opendirs" value="<?php echo htmlentities(urlencode(encode_ods($opendirs))); ?>"/>
</body>
</html>