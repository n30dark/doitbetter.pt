<?php
/*MODF:	22:15:00,14.03.07*/

$FileViews[]="FV_Details";

class FV_Details /*implements FileView*/
{
	var $FileViewType=array("en" => "Details", "de" => "Details", "fr" => "D&eacute;tails", "es" => "Vista detalle", "sr" => "Detalji" );
	
	function printview($path,$dirs,$files)
	{
		global 	$l_fil_fname,$l_fil_atime,$l_fil_mtime,$l_fil_ctime,
				$l_fil_fsize,$l_fil_chmod,$l_time,$l_fil_asc,$l_fil_dsc;
		
		$path="$path/";
		// What was sorted by before
		$sb4=(isset($_GET['sb4'])?$_GET['sb4']:"name");
		// What is wished to be sorted by now
		$srt=(isset($_GET['srt'])?$_GET['srt']:"name");
		define("srt",$srt);
		// Order direction
		$ord=(isset($_GET['ord'])?$_GET['ord']:"asc");

		$link="?".(isset($_GET['bf'])?"bf=".$_GET['bf']."&amp;":"");

		// Inlcude Header
		$outpt=
"<link rel='stylesheet' href='theme/fileviews/details.css' />
<table id='fileviews_details' border='0' cellpadding='0' cellspacing='0' >
	<tr class='t'>
		<th><a href='$link"."srt=name&amp;sb4=$srt&amp;ord=".($srt=="name" && $ord=="asc"?"de":"a")."sc'>".
			($srt=="name"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc).
			"'/>":"")."$l_fil_fname</a></th>
		<th width='82'><a href='$link"."srt=atime&amp;sb4=$srt&amp;ord=".($srt=="atime" && $ord=="asc"?"de":"a")."sc'>".
			($srt=="atime"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc).
			"'/>":"")."$l_fil_atime</a></th>
		<th width='74'><a href='$link"."srt=mtime&amp;sb4=$srt&amp;ord=".($srt=="mtime" && $ord=="asc"?"de":"a")."sc'>".
			($srt=="mtime"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc).
			"'/>":"")."$l_fil_mtime</a></th>
		<th width='74'><a href='$link"."srt=ctime&amp;sb4=$srt&amp;ord=".($srt=="ctime" && $ord=="asc"?"de":"a")."sc'>".
			($srt=="ctime"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc).
			"'/>":"")."$l_fil_ctime</a></th>
		<th width='60'><a href='$link"."srt=size&amp;sb4=$srt&amp;ord=".($srt=="size" && $ord=="asc"?"de":"a")."sc'>".
			($srt=="fsize"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc).
			"'/>":"")."$l_fil_fsize</a></th>
		<th width='88'><a href='$link"."srt=chmod&amp;sb4=$srt&amp;ord=".($srt=="chmod" && $ord=="asc"?"de":"a")."sc'>".
			($srt=="chmod"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc).
			"'/>":"")."$l_fil_chmod</a></th>
	</tr>";

		$all=array();
	foreach($dirs as $key => $dir)
		if(f_show_hidden_file("$path/$dir") )
		{
			$all[]=array( 'name' => $dir,
						  'atime'=> fileatime($path.$dir),
						  'mtime'=> filemtime($path.$dir),
						  'ctime'=> filectime($path.$dir),
						  'size' => 0,
						  'chmod'=> fileperms($path.$dir) );
		}
	foreach($files as $key => $file)
		if(f_show_hidden_file("$path/$file") )
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
		foreach($all as $file)
		{
			$outpt.="\r\n\t<tr>\r\n".
					"\t\t<td class='unmarked' id='fifo_".(++$u)."' onmouseup='drag_end()' onmousedown='setTimeout(\"end_selection();\",10);drag_start()' style='background-image:url(\"theme/ico/".give_filetype_image($file['name'],$path).".gif\")'><a ".
						"ondblclick='stopmenu();".
						(is_dir($path.$file['name'])?
							"parent.folderview.change2dir(curdir+\"/\"+hexcode2string(\"".string2jscode($file['name'])."\"))":
							"download(\"".urlencode($file['name'])."\")").
						"' href='javascript:fileinfo(\"fifo_$u\",\"".string2jscode($file['name'])."\",\"".date($l_time,$file['atime'])."\",\"".date($l_time,$file['mtime'])."\",\"".date($l_time,$file['ctime']).
						"\",\"".(is_dir($path.$file['name'])?"-1":str_replace("&nbsp;"," ",FileEasySize($file['size'])))."\",\"".FilePermsDecode($file['chmod'])."\");'>".htmlentities($file['name'])."</a></td>\r\n".
					"\t\t<td>".date($l_time,$file['atime'])."</td>\r\n".
					"\t\t<td>".date($l_time,$file['mtime'])."</td>\r\n".
					"\t\t<td>".date($l_time,$file['ctime'])."</td>\r\n".
					"\t\t<td style='text-align:right'>".(is_dir($path.$file['name'])?'':FileEasySize($file['size']))."</td>\r\n".
					"\t\t<td>".FilePermsDecode($file['chmod'])."</td>\r\n".
					"\t</tr>";

				$jscript.="all_items[$u]={'name': '".string2jscode($file['name'])."', 'atime': '".date($l_time,$file['atime'])."', ".
						  "'mtime': '".date($l_time,$file['mtime'])."', 'ctime': '".date($l_time,$file['ctime'])."', ".
						  "'size': '".(is_dir($path.$file['name'])?"-1":str_replace("&nbsp;"," ",FileEasySize($file['size']))).
						  "', 'chmod': '".FilePermsDecode($file['chmod'])."' };\r\n";
		}

		// Include Footer
		$outpt.="</table>
<script language=\"javascript\" type=\"text/javascript\">
<!--//
$jscript
//-->
</script>";		
		return $outpt;
	}
	
	function getFileViewType($lang)
	{
		if( $lang==NULL || !array_key_exists($lang,$this->FileViewType) )
			$lang="en";	// Default Value
		return 	$this->FileViewType[$lang];
	}
	
	function selectionOffsetY()
  	{
  		return 16;
  	}
	
}
?>