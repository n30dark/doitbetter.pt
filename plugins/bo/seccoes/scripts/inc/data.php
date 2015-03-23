<?php
/*MODF:	01:00:00,27.09.07*/
define("prgm_name","PH Pexplorer",true);
define("prgm_version","0.4.7.1",true);
define("prgm_update_host","bvus.dyndns.org"); 
define("prgm_update_site","/~dmaeder/bluevirus/update/");
define("prgm_update_post","updi=".base64_encode(prgm_name."2|".prgm_version."|0|a@b.c"),true);
define("c_langpath","inc/lang/");
define('debug',false);
define('f_show_hidden_files',$f_show_hidden_files);
define('f_show_hidden_winfiles',$f_show_hidden_winfiles);

// Remove unwanted chars
	//	\ -> /
$c_path=preg_replace("@(\\\\)@si","/",$c_path);
	//	// -> /
$c_path=preg_replace('@([\/]{2,})@si',"/",$c_path);
	//	:: -> :
$c_path=preg_replace('@([\:]{2,})@si',":",$c_path);

// get absolut path
$c_path=realpath($c_path);

//	Find out path above this dir
define("t_folder",dirname($c_path)/**/,true);			// (preg_match('/^[A-z]\:(\/|\\\\)?$/i',dirname($c_path))?'':dirname($c_path) )
//	Find out about first dir
define("t_c_folder",(preg_match('/^[A-z]\:$/i',basename($c_path))?'/':basename($c_path) )/**/,true);

//die("t_folder: &gt;".t_folder."&lt;<br/>t_c_folder: &gt;".t_c_folder."&lt;");
// check whether image thumbnails are possible or not
$c_imagemodul=extension_loaded("gd")?$c_imagemodul:false;
// check whether video thumbnails are possible or not
$c_video2img=extension_loaded("ffmpeg")?$c_video2img:false;

include("inc/lang.php");
include_once("inc/securl.php");
include_once("inc/tree.php");
include_once("inc/file.php");

$c_upl_err="";
if(false===ini_set("memory_limit",$f_max_upload_size) and (get_cfg_var("memory_limit")+1-1)<($f_max_upload_size/1024/1024) )
	$c_upl_err.="ERR:memory_limit (".get_cfg_var("memory_limit")." / ".round($f_max_upload_size/1024/1024)."M)\\n";
if(false===ini_set("post_max_size",$f_max_upload_size/*+1024*512*/) and ini_get("post_max_size")<($f_max_upload_size+1024*512) )
	$c_upl_err.="ERR:post_max_size (".ini_get("post_max_size")."/".round(($f_max_upload_size)/1024/1024,0)."M)\\n";
if(false===ini_set('upload_max_filesize',$f_max_upload_size) and ini_get("upload_max_filesize")<$f_max_upload_size )
	$c_upl_err.="ERR:upload_max_filesize (".ini_get("upload_max_filesize")."/".round(($f_max_upload_size)/1024/1024,0)."M)\\n";
if(false===ini_set('file_uploads ',"1") and ini_get("file_uploads")!="1" )
	$c_upl_err.="ERR:file_uploads (".ini_get("file_uploads").")\\n";
if(false===ini_set('max_execution_time',"300") and ini_get("max_execution_time")<300)	// maximum standart configuration of Apache or IIS
	$c_upl_err.="ERR:max_execution_time (".ini_get("max_execution_time").")\\n";
if(false===ini_set('max_input_time',"300") and ini_get("max_input_time")<300)		// ''
	$c_upl_err.="ERR:max_input_time (".ini_get("max_input_time").")\\n";

?>