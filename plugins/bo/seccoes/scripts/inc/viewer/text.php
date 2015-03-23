<?php 
/*MODF: 08:54:00,10.07.07*/
$anzpage=@filesize($file)/$c_view_text_maxsize_kb/1024;
$anzpagef=ceil($anzpage)-1;
$page=0;

if(isset($_GET['p']) )
  if(isset($_GET['manual']))
    $page=max(0,min($anzpagef,$_GET['p']-1));
  else
    $page=max(0,min($anzpagef,$_GET['p']));

$zeiger=$c_view_text_maxsize_kb*1024*$page;

$prev=max(0,$page-1);
$next=min($anzpagef,$page+1);
$burl=$_SERVER['PHP_SELF']."?type=".$_GET['type']."&amp;file=".$_GET['file']."&amp;p=";

echo '<?xml version="1.0" encoding="'.$l_charset.'"?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Simple text viewer</title>
<script language="javascript" type="text/javascript" src="theme/debug/debug.js?v=0"></script>
<style type="text/css">
div#menu
    { position:absolute; position:fixed; top:0px;left:0px; background-color: #ccf; border-left: 1px solid #fcfcfe;
      border-right: 1px solid #919b9c; border-bottom: 1px solid #919b9c; height: 23px; width: 100%; margin:0px;
      padding:0px;z-index:3;  }
div#menu a img
    { border: 1px solid #999999;  }
div#menu a:hover img
    { background-color:#FFFFFF; }
div#menu a:active img
    { background-color:#cccccc; }
div#menu span
    { font-size: 12px; color:#666666; font-family:Arial, Helvetica, sans-serif; position:relative; top: -5px;
      margin-left: 8px; margin-right: 8px;  }
div#menu span input
    { border: 0px solid #cccccc; color: #CC0000; height: 15px; width: <?php echo strlen($anzpagef)*8; ?>px;
      font-family: "Courier New", Courier, mono; font-size:14px; padding:0px; margin:0px; text-align: right;  }
pre.txt, pre.txtw
    { font-family:"Courier New", Courier, mono; font-size: 12px; margin-top: 24px;  }
pre.txtw
    { white-space:inherit; width: 100%; }
</style>
</head>
<body>
<div id="menu"><form method="get" enctype="application/x-www-form-urlencoded" onsubmit="return isNaN(this.p.value)?false:(this.p.value><?php echo ($anzpagef+1); ?>?false:true)" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="type" value="<?php echo $_GET['type']?>"/>
<input type="hidden" name="chf" value="<?php echo $_GET['chf']?>"/>
<input type="hidden" name="manual" value="1"/>
<input type="hidden" name="file" value="<?php echo $_GET['file']?>"/>
<a href='<?php echo $burl.$prev; ?>'><img src='theme/prev.gif'/></a>&nbsp;
<a href='<?php echo $burl.$next; ?>'><img src='theme/next.gif'/></a>&nbsp;<span>
<?php 
echo "<input type=\"text\" maxlength='".strlen($anzpagef)."' name=\"p\" value=\"".($page+1)."\" onclick=\"this.select();\"/>".
	 "/".($anzpagef+1)."</span><span>$l_viw_cp_file: ".str_replace('\\','',substr($file_shrt,max(strlen($file_shrt)-50,0)));
?>
</span><span><!--<input onclick="document.getElementById('txt').className=(document.getElementById('txt').className=='txtw'?'txt':'txtw')" type='checkbox' id='wrap'/><label for="wrap">Word wrap</label>--></span></form></div>
<pre class='txt' id='txt'>
<?php 
  //echo "$zeiger - ".($c_view_text_maxsize_kb*1024)." - ".filesize($file)."<br/>";
  if(!$fd=@fopen($file,"rb"))
    echo "<span style='color:red; font-style: italic;'>$l_viw_er_noread</span>"; 
  else
  {
    if($zeiger>0)
      fseek($fd,$zeiger,SEEK_SET);
    echo str_replace(" ","&nbsp;",htmlentities(fread($fd,$c_view_text_maxsize_kb*1024)));
  }
  @fclose($fd);
?></pre>
</body>
</html>