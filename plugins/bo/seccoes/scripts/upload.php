<?php 
/*MODF:	22:15:00,14.03.07*/

// Loadsettings
include_once("inc/settings.php");
if(!$l_charset)
	exit();

?>
<?php echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $l_upl_t; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<script language="javascript"  type="text/javascript">
<!--//
var size=2;
function grow(doink)
{
	if( size>2 && !doink || size<10 && doink)
	{
		//window.resizeBy(0,((doink)?1:-1)*60);
		growing(4,((doink)?1:-1)*13);
		size+=(doink?+1:-1);
	}
}
function growing(steps,inkrement)
{
	window.resizeBy(0,inkrement);
	if(steps!=1)
		window.setTimeout("growing("+(steps-1)+","+inkrement+")",10);
}
function onloadf()
{
	// Set Queue check interval
	chechthreadiv=window.setInterval("checkthreadqueue()",200);
	// Resize and focus
	window.resizeTo(248,165);
	window.focus();
}
/*	Threadstates:
0	-> Page not loaded/upload not finished
1	-> Page loaded
2	-> Page waiting for upload	*/
var thread=Array(0,0,0,0,0,0,0,0,0,0);
var dirselwin=Array();
var	chechthreadiv=null;
function checkthreadqueue()
{
	//	Check if all uplaod moduls are loaded
	for(i=0;i<thread.length;i++)
	//	If not, stop this fkt
		if(thread[i]==0)
			return;
	
	//	Check for a modul that waits for upload
	for(i=0;i<thread.length;i++)
		// If found an awaiting page, run it and stop this fkt
		if(thread[i]==2)
		{
			window.frames[i].uploading();
			return;
		}
}
//-->
</script>
</head>
<body onload="onloadf()">
<div id="top">
<a style="background-image:url(theme/collapse.gif)" href="javascript:grow(false)" title="<?php echo $l_upl_collapse; ?>"></a>
<a style="background-image:url(theme/expand.gif)" href="javascript:grow(true)" title="<?php echo $l_upl_expand; ?>"></a>
</div>
<?php
for($i=0;$i<10;$i++)
	echo '<iframe id="uploadtask_'.$i.'" scrolling="no" name="uploadtask_'.$i.'" class="modfram" width="100%" height="52" frameborder="0" src="uploadmod.php?id='.$i.'"></iframe>';
?>
</body>
</html>