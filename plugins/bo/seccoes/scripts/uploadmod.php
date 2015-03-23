<?php 
/*MODF:	22:15:00,14.03.07*/

// Loadsettings
include_once("inc/settings.php");
if(!$f_right_to_upload)
	exit();

if(!isset($_GET['id']) )
	die('ERR:id?');

$pageerrs=array();
$pageinfs=array();

if(isset($_POST['uploaddir'],$_FILES['uploadfile']) )
{
	// Get Path, where to save it
	$uploaddir=securl($_POST['uploaddir']);
	$path=t_folder."/$uploaddir";
	
	//	Create condition to continue
	$good=false;
	if( is_dir($path) )
		$good=true;
	else
	{	$pageerrs[]=$l_upm_nex_dir;	$good=false;	}
		
	
	// All ok so far
	if($good)
	{
		$treffer=NULL;
		preg_match('/^(.*?)\.([A-z0-9\_]{3,6})$/',$_FILES['uploadfile']['name'],$treffer);
		$filename=(count($treffer)==3?$treffer[1]:$_FILES['uploadfile']['name']);
		$origname=$filename; $count=1;
		$filetype=(count($treffer)==3?".".$treffer[2]:"");

		// Rename file if path already exists
		while( is_file($path."/$filename$filetype") || is_dir($path."/$filename$filetype") )
			$filename="$origname(".($count++).")";
		
		// and size not to big
		if(	$_FILES['uploadfile']['size']>$f_max_upload_size || $_FILES['uploadfile']['error']==2 || $_FILES['uploadfile']['error']==1 )
		{	$pageerrs[]=$l_upm_2bigFsize;		$good=false;	}
		//	If no errors 
		if( $_FILES['uploadfile']['error']!=0 && $_FILES['uploadfile']['error']!=2 )
		{
			$good=false;
			switch($_FILES['uploadfile']['error'])
			{
				case '3' :
					$pageerrs[]=$l_upm_partly;
					break;
				case '4' :
					$pageerrs[]=$l_upm_nofile;
					break;
			}
		}
		

		if( $good )
			if( @move_uploaded_file($_FILES['uploadfile']['tmp_name'],$path."/$filename$filetype") )
				$good=true;
			else
			{	$pageerrs[]=$l_upm_nofilemov;		$good=false;	}

		
		if( $origname!=$filename )
			$pageinfs[]=$l_upm_ren_file;

	}
}
foreach($pageinfs as $key => $val)
	$pageinfs[$key]=html_entity_decode($val);	//string2jscode
foreach($pageerrs as $key => $val)
	$pageerrs[$key]=html_entity_decode($val);
?>
<?php echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $l_upm_t; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="javascript" type="text/javascript">
<!--//
var threadid=<?php echo $_GET['id']; ?>;
var l_uploadinprogress=hexcode2string("<?php echo string2jscode(html_entity_decode($l_upm_uploading)); ?>");
//-->
</script>
<script language="javascript" type="text/javascript" src="theme/uploadmod.js"></script>
</head>
<body onload="onloadf()">
<form style="margin:0; padding:0;" name="uploadform" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']."?id=".$_GET['id']; ?>" onsubmit="return false">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $f_max_upload_size; ?>"/>
<div class="toolbar">
<img src="theme/uploadfile.gif" title="<?php echo $l_upm_savefile; ?>" alt="<?php echo $l_upm_savefile; ?>" class="button" onclick="plantoupload()"/>
<input type="file" name="uploadfile" style="width:200px" class="button" /><br/>
</div>
<div style="top:26px" class="toolbar">
<label for="uploaddir"><img src="theme/seldir.gif" title="<?php echo $l_upm_seldir; ?>" alt="<?php echo $l_upm_seldir; ?>" class="button" onclick="opendirsel()" /></label>
<input type="text" class="mtext" value="<?php echo isset($_POST['uploaddir'])?$_POST['uploaddir']:t_c_folder; ?>"  id="uploaddir" name="uploaddir"/>
<?php if( count($pageinfs)>0 ) { ?>
<img src="theme/info.gif" class="button" onclick="alert(hexcode2string('<?php 
echo string2jscode(  html_entity_decode( $l_upm_infobox."\n- ".implode("\n- ",$pageinfs) )  ); ?>' ) )" />
<?php }	 if( count($pageerrs)>0 ) { ?>
<img src="theme/warning.gif" class="button" onclick="alert(hexcode2string('<?php 
echo string2jscode( $l_upm_errbox."\n- ".implode("\n- ",$pageerrs) ); ?>' ) )" />
<?php } ?>
</div>
</form>
<div id='waiting'><img id="waitingimg" src="theme/hourglass.gif" alt="<?php echo $l_upm_queueing; ?>" title="<?php echo $l_upm_queueing; ?>"/></div>
</body>
</html>