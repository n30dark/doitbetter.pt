<?php
// Determinds whether language has to be found out 
$loadlang=true;

//	Setting been saved in Cookie?
if(array_key_exists("Language",$_COOKIE))
{
	// Open dir with languagefiles
	$dir=opendir(c_langpath);
	$langs=Array();
	
	//	Browse dir and save all language shorthand symbols of existing files
	while($res=readdir($dir))
		if( $res!="." and $res!=".." and is_file(c_langpath."$res") )
		{
			$t=basename(is_file($res),".php");
			if( strlen($t)==2 ||  strlen($t)==5 )
				$langs[]=$t;
		}

	//	Close dir
	closedir($dir);
	
	//	Lade Sprache, falls vorhanden
	$filename=c_langpath.$_COOKIE['Language'].".php";
	if( in_array($_COOKIE['Language'],$langs) and is_file($filename) )
	{
		include($filename);
		$loadlang=false;
	}
}

//	
$chos_lang_file="";

// Find out about client language
if($loadlang)
{
	//	Set default language as used language
	$loadl=$c_language;
	
	//	Get submittet languages
	array_key_exists("HTTP_ACCEPT_LANGUAGE",$_SERVER)?NULL:$_SERVER["HTTP_ACCEPT_LANGUAGE"]=$c_language;
	
	//	Split language data
	$client_lang=explode(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']);
	//	Save language in right order
	foreach($client_lang as $key => $var)
	{
		$tmp=explode(";",$var,2);		// Eliminiere ;q=0.x
		$tmp2=explode("-",$tmp[0],2);	// Eliminiere -xx (i.e.: de-ch)
		if( !preg_match('/[^a-z\-]/',$tmp2[0]) )
			$client_lang[$key]=$tmp2[0];
		else
			unset($client_lang[$key]);
	}

	//	Try each one to load
	foreach($client_lang as $file)
	{
		if( is_file(c_langpath.$file.".php") )
		{
			$loadl=$file;
			break;
		}
	}
	
	//	Save language as cookie
	setcookie("Language",$loadl);
	//	Load language
	include(c_langpath.$loadl.".php");
}

function lang_index_files()
{
  global $l_file;

  $fd=opendir(c_langpath);
  
  $avail_langs=array();
  
  $tmp_act_lang=$l_file;
  
  while($file=readdir($fd) )
  {
    if( is_file(c_langpath.$file) && preg_match('/[a-z\-]{2,5}\.php$/',$file) && $file!="htmlentities.php" )
    {
      include(c_langpath.$file);
      $avail_langs[]=array('language' => $l_language, 'file' => $l_file, 'author' => $l_author, 'mail' => $l_author_m, 'url' => $l_author_h, 'short' => $l_shortcuts);
    }
  }
  
  include($l_file);
  
  return $avail_langs;
}
?>