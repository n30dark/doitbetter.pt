<?php 
/*MODF: 22:15:00,14.03.07*/

// Loadsettings
include_once("inc/settings.php");

?>
<?php echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title><?php echo str_replace( array( '%PRGM_N%'), array(prgm_name), $l_abt_t); ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
  <link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
  <style type="text/css">
div.toolbartext      { font-size: 14px; margin: 0; font-weight: 800; font-family: Arial; margin-top: 2px;  }
div.conts            { padding-top: 26px; height: 100%; overflow: auto;
                       font-size: 11px; font-family: Arial; line-height: 180%;
                       margin: 0 4px 0 4px; color: #333; }
div.conts a          { color: #333; font-weight: bold; text-decoration: none; }
div.conts a:hover    { color: #66f; }
blockquote           { margin-top: 0; }
a.mlink img			 { background-color:#333; }
a.mlink:hover img	 { background-color:#66f; }
  </style>
  <script language="javascript" type="text/javascript" src="theme/general.js"></script>
  <script language="javascript" type="text/javascript" src="theme/folder.js"></script>
</head>
<body>
<div class="toolbar" style="z-index: 4"><div class="toolbartext"><?php echo str_replace( array( '%PRGM_N%', '%PRGM_V%'), array( prgm_name, prgm_version), $l_abt_t); ?></div></div>
<div class="conts">
<?php
$cachesize=0;
$fd=opendir($c_cache_path);

while( $file=readdir($fd) )
	if( is_file("$c_cache_path/$file") )
		$cachesize+=filesize("$c_cache_path/$file");


echo str_replace( array('%PRGM_V%'), array(prgm_version), $l_abt_akt_v);
echo "<span style='float:right'>Cache: ".FileEasySize($cachesize)."</span><br/>";

$up_avail=false;
$up_nvers="";
$up_link="";

/* check 4 new version */
// connect to server
$fp=fsockopen(prgm_update_host,80,$errno, $errstr, 10);
if (!$fp) {  echo "ERROR while querying for update: $errstr ($errno)<br />\n";}
else
{
  // Send query
  fputs($fp,$q= "GET ".prgm_update_site."?".prgm_update_post." HTTP/1.0\r\n".
                "User-Agent: php\r\n".
                "Accept: text/html, image/jpeg, image/png, text/*, image/*, */*\r\n".
                "Accept-Charset: utf-8, utf-8;q=0.5, *;q=0.5\r\n".
                "Accept-Language: en\r\n".
                "Host: ".prgm_update_host."\r\n".
                "Connection: Keep-Alive\r\n\r\n");

  // Get query to var
  $input="";
  while(!feof($fp) )
    $input.=fgets($fp,1024);

  if(preg_match('/^Location:\shttp\:\/\/(.*?)$/ms',$input,$forward) )
  {
    fclose($fp);
    $fp=fsockopen(substr($forward[1],0,strpos($forward[1],'/')),80,$errno,$errstr,10);
    fputs($fp,$q= "GET ".prgm_update_site."?".prgm_update_post." HTTP/1.0\r\n".
                "User-Agent: php\r\n".
                "Accept: text/html, image/jpeg, image/png, text/*, image/*, */*\r\n".
                "Accept-Charset: utf-8, utf-8;q=0.5, *;q=0.5\r\n".
                "Accept-Language: en\r\n".
                "Host: ".substr($forward[1],0,strpos($forward[1],'/'))."\r\n".
                "Connection: Keep-Alive\r\n\r\n");
    $input="";
    while(!feof($fp) )
      $input.=fgets($fp,1024);
  }
  
  // close connection
  fclose($fp);

  // parse 4 update
  $c=strpos($input,"Update available");
  // parse for link
  $a=preg_match('/href=\"([^\"]+)\"/',$input,$m4link);
  // parse for new version
  $b=preg_match('/v([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{1,2})/',$input,$m4vers);
  
  if( $a && $b && $c )
  {
    $up_avail=true;
    $up_nvers=$m4vers[1].".".$m4vers[2].".".$m4vers[3];
    $up_link=$m4link[1];
  }
}

if( $up_avail )
  echo str_replace( array( '%v_num%', '%link_start%', '%link_stop%'), array( $up_nvers, "<a href='$up_link' target='_blank'>", '</a>'), $l_abt_new_v_a)."<br/>";

echo "<br/>".$l_abt_freew_by;
?><br/>
<blockquote style="margin-left:20px">
<?php
$lngs=lang_index_files();
array_multisort($lngs);
foreach($lngs as $lang)
{
  echo str_replace( array('%lang%','%name%'),array($lang['language'],$lang['author']), $l_abt_langby ).
	   (isset($lang['mail']) && $lang['mail']!=""?"&nbsp;<a class='mlink' href='mailto:".$lang['author']." &lt;".$lang['mail']."&gt;?subject=".prgm_name." ".prgm_version.":%20".$lang['language']."%20translation'><img src='theme/mail_sil.png' border='0' alt='Mail'/></a>":"").
       (isset($lang['url']) && $lang['url']!=""?"&nbsp;<a class='mlink' href='http://".$lang['url']."' target='_blank'><img src='theme/hp_sil.png' border='0' alt='Homepage'/></a>":"").
	   "<br/>";
}
?>
</blockquote>
</div>
</body>
</html>