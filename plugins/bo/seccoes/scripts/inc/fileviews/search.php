<?php
/*MODF:	22:15:00,14.03.07*/

$FileViews['search']="FV_Search";
$FileViewsExt['search']="FV_Search";

class FV_Search /*implements FileView*/
{
	var $FileViewType=array("en" => "Search", "de" => "Suche", "fr" => "Cherche", "es" => "???", "sr" => "???" );
	var $noDirectSelection=true;
	
	function printview($path,$dirs,$files)
	{
		$outpt="";
		
		$outpt.=FV_Search::printsearchform($path);
		
		global 	$l_fil_fname,$l_fil_atime,$l_fil_mtime,$l_fil_ctime,$l_fil_fdir,
				$l_fil_fsize,$l_fil_chmod,$l_time,$l_fil_asc,$l_fil_dsc,$c_path;
		
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
		$outpt.=
"<link rel='stylesheet' href='theme/fileviews/details.css' />
<script language='javascript' type='text/javascript' src='theme/fileviews/search.js'></script>
<script language='javascript' type='text/javascript' src='theme/ajax.js'></script>
<table id='fileviews_details' border='0' cellpadding='0' cellspacing='0'>
	<tr class='t'>
		<th><a "./*href='$link"."srt=name&amp;sb4=$srt&amp;ord=".($srt=="name" && $ord=="asc"?"de":"a")."sc'*/">".
			//($srt=="name"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc)."'/>":"").
			"$l_fil_fname</a></th>
		<th><a "./*href='$link"."srt=dir&amp;sb4=$srt&amp;ord=".($srt=="dir" && $ord=="asc"?"de":"a")."sc'*/">".
			//($srt=="dir"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc)."'/>":"").
			"$l_fil_fdir</a></th>
		<th width='60'><a "./*href='$link"."srt=size&amp;sb4=$srt&amp;ord=".($srt=="size" && $ord=="asc"?"de":"a")."sc'*/">".
			//($srt=="fsize"?"<img border='0' src='theme/".($ord=="asc"?"A":"DE")."SC_order.png' alt='".($ord=="asc"?$l_fil_asc:$l_fil_dsc)."'/>":"").
			"$l_fil_fsize</a></th>
	</tr>";

		
		return $outpt.'</table>'; /**/

		/* $all=array();
		$dircutfrom=strlen(t_folder);
		
		foreach($dirs as $key => $dir)
		{
			$all[]=array( 'name' => $dir,
						  'atime'=> fileatime($path.$dir),
						  'mtime'=> filemtime($path.$dir),
						  'ctime'=> filectime($path.$dir),
						  'dir'  => substr(dirname($path.$dir),$dircutfrom),
						  'size' => 0,
						  'chmod'=> fileperms($path.$dir)
						 );
		}
		foreach($files as $key => $file)
		{
			$all[]=array( 'name' => $file,
						  'dir'  => substr(dirname($path.$file),$dircutfrom),					  
						  'atime'=> fileatime($path.$file),
						  'mtime'=> filemtime($path.$file),
						  'ctime'=> filectime($path.$file),
						  'size' => FileSize2($path.$file),
						  'chmod'=> fileperms($path.$file)
						);
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
					"\t\t<td style='text-align:left'>".$file['dir']."</td>\r\n".
					"\t\t<td style='text-align:right'>".FileEasySize($file['size'])."</td>\r\n".
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
		/**/
	}
	
	function getFileViewType($lang)
	{
		if( $lang==NULL || !array_key_exists($lang,$this->FileViewType) )
			$lang="en";	// Default Value
		return 	$this->FileViewType[$lang];
	}
	
	function printsearchform($path)
	{
		global $l_fil_srcname, $l_fil_srcpath;
		$dircutfrom=strlen(t_folder);		
		ob_start();
		?>
<form name="searchform" method="get" class="toolbar" onsubmit="return FV_search_start()">
	<table>
		<tr>
			<td><?php echo $l_fil_srcname; ?></td>
			<td><input type="text" name="srch_term" class="ltext" onclick="this.focus();"/><input type="submit" value="<?php echo $l_fil_srcname; ?>" id='srchbut' class="button"/></td>
		</tr>
		<tr>
			<td><?php echo $l_fil_srcpath; ?></td>
			<td><input type="text" name="srch_path" value="<?php echo substr($path,$dircutfrom); ?>" class="ltext" onclick="this.focus();" style="background-image:url(seldir.gif); background-repeat:no-repeat"/><img src="theme/seldir.gif" class="button" onclick="FV_search_opendir()"/></td>
		</tr>
	</table>
</form>
		<?php
		$ret=ob_get_contents();
		ob_end_clean();
		
		return $ret;
	}
	
	function selectionOffsetY()
  	{
  		return 68;
  	}
	
}
?>