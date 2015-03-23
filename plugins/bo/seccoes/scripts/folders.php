<?php 
/*MODF:	22:15:00,14.03.07*/

// Loadsettings
include_once("inc/settings.php");

// Load open folders
$opendirs=isset($_GET['od'])?decode_ods($_GET['od']):array(t_c_folder);

//	Switch to a dir
if( isset($_GET['s2d']) )
{
	$_GET['s2d']=str_replace("\\'","'",$_GET['s2d']);
	if( is_dir( t_folder."/".securl($_GET['s2d']) ) )
		$_GET['nod']=dirname($_GET['s2d']);
}

//	Expanding or Collapsing Folder?
if( isset($_GET['nod']) )
{
	$_GET['nod']=str_replace("\\'","'",$_GET['nod']);

	//	Is folder not yet expanded?
	if(!in_array($_GET['nod'],$opendirs) || isset($_GET['s2d']) )
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

<html xmlns="http://www.w3.org/1999/xhtml" onmouseup='drag_end()'>

<head>
<title><?php echo $l_dvw_t; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript" src="theme/folder.js?v=2"></script>
<script language="javascript" type="text/javascript">
<!--//
var markednum=null;
var markedname=null;
var thispage="<?php echo $_SERVER['PHP_SELF']; ?>";
var isfullyloaded=false;


function opendir_spec(hexc)
{	opendir_spec(hexc,false);	}
function opendir_spec(hexc,me2)
{
	//	Openlink in Fileview
	parent.fileview.location.href="files.php?bf="+urlencode(hexcode2string(hexc));
	parent.pathview.location.href="address.php?address="+urlencode(hexcode2string(hexc))+"&cfromfw=1";
	if(me2)
		window.location.href=thispage+"?od="+document.getElementById('opendirs').value;

}
function selectdir_spec(path,objn)
{	}


function onloadf()
{
	<?php 
if(isset($_GET['s2d'],$_GET['nod']) )
	echo 'opendir_spec("'.string2jscode($_GET['s2d']).'");';
	?>
	
	isfullyloaded=true;
}
//-->
</script>
</head>
<body onload="onloadf();dirs_restore_offset()" onunload="dirs_save_offset()" ondragstart="return false" onselectstart="return false">
<div id='dragjobcatcher' onmouseup='drag_end()'></div>
<div class="folderlist" id="folderlist">
<?php
$dirs=new TreeDir($opendirs);
$dirs->printtree();
?>
</div>
<input type="hidden" id="opendirs" value="<?php echo htmlentities(urlencode(encode_ods($opendirs))); ?>"/>
<div id='dragjob'></div>
</body>
<script language="javascript" type="text/javascript" src="theme/afterjs.js"></script>
</html>