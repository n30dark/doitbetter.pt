<?php
/*MODF:	22:15:00,14.03.07*/

if( !class_exists('Clips') )
{
  $FileViews[]="FV_Clips";

class FV_Clips /*implements FileView*/
{
  var $FileViewType=array("en" => "Clips", "de" => "Miniaturansicht", "fr" => "Vignettes", "es" => "Vista miniatura", "sr" => "Slicice" );
  
  function printview($path,$dirs,$files)
  {
    global 	$l_fil_fname,$l_fil_atime,$l_fil_mtime,$l_fil_ctime,
                    $l_fil_fsize,$l_fil_chmod,$l_time,$l_fil_asc,$l_fil_dsc,
                    $c_menu_img_h, $c_menu_img_w, $c_fileview_thb_h, $c_fileview_thb_w;
    
    $path="$path/";
    $spath=substr($path,strlen(t_folder)+1);
    // What was sorted by before
    $sb4=(isset($_GET['sb4'])?$_GET['sb4']:"name");
    // What is wished to be sorted by now
    $srt=(isset($_GET['srt'])?$_GET['srt']:"name");
    define("srt",$srt);
    // Order direction
    $ord=(isset($_GET['ord'])?$_GET['ord']:"asc");

    $link="?".(isset($_GET['bf'])?"bf=".$_GET['bf']."&amp;":"");

		// Inlcude Header
		$outpt="<link rel='stylesheet' href='theme/fileviews/clips.css' />
<style type=\"text/css\" media=\"all\">
div#fileviews_clip div		{	width: ".($c_fileview_thb_w+2)."px;	}
div#fileviews_clip div img	{	height: ".$c_fileview_thb_h."px; width: ".$c_fileview_thb_h."px;	}
div#fileviews_clip div label{	max-width: ".$c_fileview_thb_w."px; }
</style>
<script language=\"javascript\" type=\"text/javascript\">
<!--//
c_img_thb=false;
//-->
</script>
<div id='fileviews_clip'>";

		$all=array();
	foreach($dirs as $key => $dir)
		if( f_show_hidden_file("$path/$dir") )
		{
			$all[]=array( 'name' => $dir,
						  'atime'=> fileatime($path.$dir),
						  'mtime'=> filemtime($path.$dir),
						  'ctime'=> filectime($path.$dir),
						  'size' => 0,
						  'chmod'=> fileperms($path.$dir) );
		}
	foreach($files as $key => $file)
		if( f_show_hidden_file("$path/$file") )
		{
			$all[]=array( 'name' => $file,
						  'atime'=> fileatime($path.$file),
						  'mtime'=> filemtime($path.$file),
						  'ctime'=> filectime($path.$file),
						  'size' => FileSize2($path.$file),
						  'chmod'=> fileperms($path.$file) );
		}
		
		function cmpsrt($a,$b)
		{
			return $a[srt]<$b[srt]?-1:1;
		}
		
		if( $srt!="name" )
			usort($all,"cmpsrt");
		
		if( $ord=="desc" )
			$all=array_reverse($all);
		
		$u=-1;
		$jscript="";
		$showabletypes=GiveShowableTypes();
		foreach($all as $file)
		{
			$outpt.="\r\n<div class='unmarked' id='fifo_".(++$u)."' onmouseup='drag_end()' onmousedown='setTimeout(\"end_selection();\",10);drag_start()' ondblclick='stopmenu();".
						(is_dir($path.$file['name'])?
							"parent.folderview.change2dir(curdir+\"/\"+hexcode2string(\"".string2jscode($file['name'])."\"))":
							"download(\"".urlencode($file['name'])."\")").
						"' onclick='javascript:fileinfo(\"fifo_$u\",\"".string2jscode($file['name'])."\",\"".date($l_time,$file['atime'])."\",\"".date($l_time,$file['mtime'])."\",\"".date($l_time,$file['ctime']).
						"\",\"".(is_dir($path.$file['name'])?"-1":str_replace("&nbsp;"," ",FileEasySize($file['size'])))."\",\"".FilePermsDecode($file['chmod'])."\");'>\r\n".
						"\t<img src='".(in_array(strtolower(FileExtension($file['name'])),$showabletypes)?"menu.php?do=prv&amp;typ=clip&amp;chf=".urlencode($spath.$file['name']):"theme/leer.gif")."' style='background-image:url(\"theme/ico48/".give_filetype_image($file['name'],$path).".png\")' border='0' alt=''/><br/>\r\n".
					 "\t<label title='".htmlentities($file['name'])."'>".htmlentities($file['name'])."</label>\r\n</div>";
				
			$jscript.="all_items[$u]={'name': '".string2jscode($file['name'])."', 'atime': '".date($l_time,$file['atime'])."', ".
					  "'mtime': '".date($l_time,$file['mtime'])."', 'ctime': '".date($l_time,$file['ctime'])."', ".
					  "'size': '".(is_dir($path.$file['name'])?"-1":str_replace("&nbsp;"," ",FileEasySize($file['size']))).
					  "', 'chmod': '".FilePermsDecode($file['chmod'])."' };\r\n";
		}
		// Include Footer
		$outpt.="</div>
<script language=\"javascript\" type=\"text/javascript\">
<!--//
$jscript
//-->
</script>";		

		
		return $outpt;
	}
	
	function getFileViewType($lang)
	{
		if( !array_key_exists($lang,$this->FileViewType) )
			$lang="en";	// Default Value
		return 	$this->FileViewType[$lang];
	}
	
	function selectionOffsetY()
  	{
  		return 0;
  	}
	
}

}
?>