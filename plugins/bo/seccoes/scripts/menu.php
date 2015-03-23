<?php
/*MODF:	01:00:00,27.09.07*/

// Loadsettings
include_once("inc/settings.php");

define('loc1',"",true);

function remdir($dir)
{
  if(!isset($GLOBALS['remerror']))
   $GLOBALS['remerror'] = false;

  if($handle = opendir(loc1 . $dir)){          // if the folder exploration is sucsessful, continue
   while (false !== ($file = readdir($handle))){ // as long as storing the next file to $file is successful, continue
     $path = $dir . '/' . $file;
     if(is_file(loc1 . $path)){
       if(!@unlink(loc1 . $path)){
         //echo '<u><font color="red">"' . $path . '" could not be deleted. This may be due to a permissions problem.</u><br>Directory cannot be deleted until all files are deleted.</font><br>';
         $GLOBALS['remerror'] = true;
         return false;
       }
     } else
     if(is_dir(loc1 . $path) && substr($file, 0, 1) != '.'){
       remdir($path);
       @rmdir(loc1 . $path);
     }
   }
   closedir($handle); // close the folder exploration
  }

  if(!$GLOBALS['remerror']) // if no errors occured, delete the now empty directory.
   if(!@rmdir(loc1 . $dir)){
     1; //echo '<b><font color="red">Could not remove directory "' . $dir . '". This may be due to a permissions problem.</font></b><br>';
     return false;
   } else
     return true;

  return false;
} // end of remdir()
function microtime_float()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

/** Clean text from \'s infront of unwanted chars like '
 * @param   $string Text to clean
 * @return  String  Cleaned text   */
function string_clean($string)
{
  $string=preg_replace('/\\\/','',$string);
  
  return $string;
}


if( isset($_GET['do']) )
{
  switch ($_GET['do'])
  {
  	case 'srch' :
	{
		if( trim($_GET['term'])=="" || !$c_srch_enabled )
			die('NOQUERY');

		include_once('inc/icons.php');

		$path=str_replace('\\','/','/'.$_GET['chf']);
		$path=split("/",$path);
		unset($path[0]);
		unset($path[1]);
		$path=implode('/',$path);
		
		$path=securl($path);
		$fpath=t_folder.'/'.$path.'/';
		$fdir=opendir($fpath);
		
		$hits=array();
		$dirs=array();
		
		while($fdir && $file=readdir($fdir) )
		{
			if($file!=".." && $file!="." && f_show_hidden_file("$fpath/$file") )
			{
				if( /*strpos($file,$_GET['term']) ||*/ preg_match('/'.$_GET['term'].'/i',$file) )
				{
					$hits[count($hits)]=$file;
				}

				if( is_dir("$fpath/$file") )
					$dirs[count($dirs)]=string2jscode($file);
			}
		}
		
		echo count($dirs).'&&'.count($hits).'&&'.string2jscode($path).'&&'.implode('::',$dirs).'&&';
		
		foreach($hits as $file)
		{
			echo string2jscode($file)."::".
					date($l_time,fileatime("$fpath/$file")).'::'.
					date($l_time,filemtime("$fpath/$file")).'::'.
					date($l_time,filectime("$fpath/$file")).'::'.
					(is_dir("$fpath/$file")?'-1':FileEasySize(FileSize2("$fpath/$file"))).'::'.
					FilePermsDecode(fileperms("$fpath/$file")).'::'.
					give_filetype_image($file,$fpath).'@@';
		}
		echo "&&";
		break;
	}
    case "dl" :		// download
    {
      $_GET['chf']=securl($_GET['chf']);
      $file=t_folder."/".$_GET['chf'];
      //$file=str_replace("\\'","'",$_GET['file']);
      //die($file);
      
      if(is_file($file))
      {	
        @set_time_limit(0);	//Falls DL l�nger dauert
        $constart=0;							// Wo starten
        $conend=@filesize($file);	// Wo fetisch
        
        $p1=NULL;
        $p2=NULL;
        if( isset($_SERVER['HTTP_RANGE']) and strpos($_SERVER['HTTP_RANGE'],"bytes=")!==false )
        {
          $s=$_SERVER['HTTP_RANGE'];
          $p1=strpos($s,"bytes=")+6;
          $p2=strpos($s,"-",$p1);
          
          $constart=substr($s,$p1,$p2-$p1);
                  settype($constart,"integer");
          $conend=  substr($s,$p2+1);
                  settype($conend,"integer");
          if($conend<=$constart)
                  $conend=@filesize($file);
        }
        header("Accept-Ranges: bytes");
        header("Content-Type: application/x-download");
        header("Content-Range: bytes $constart-$conend/".($conend+1));
        header("Content-Length: ".($conend-$constart),true);
        header("Age: ".(time()-@filemtime($file)) );
        header("Date: ".gmdate("D, d M Y H:i:s")." GMT");
        header("Last-Modified: ".gmdate("r",filemtime($file)) );
        header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
        header("Content-Transfer-Encoding: binary");

        $fd=fopen($file,"rb");
        @fseek($fd,$constart,SEEK_SET);
        
        $i=$constart;
        while($i<$conend)
        {
                $dif=($conend-1-$i)%(1024*1024+1) +1;
                $postion=$conend+1;
                echo @fread($fd,$dif);
                $i+=$dif;
        }
      }
      break;
    }
    
    case "prv" :	// Show preview for thumbnail,clip or viewer
    {
      define("now",microtime_float());
      // Get filepath
      $file=t_folder."/".securl($_GET['chf']);
      
      // make $_GET['typ'] a save-to-use-in-filepath-variable
			if( !isset($_GET['typ']) )
				$_GET['typ']='thb';
      switch( $_GET['typ'] )
      {
        case 'clip':
        case 'big':
        case 'thb':
          break;
        default:
          $_GET['typ']="thb";
      }
      
      // generate unique cache name depending on file name, frame, and modification date
      srand(crc32($file));
	  if( isset( $_GET['tp'] ) )
	  	settype($_GET['tp'],'integer');
      $pfile=$c_cache_path."/".$_GET['typ']."_".rand(1000,9999)."-".rand(1000,9999)."-".( isset($_GET['tp'])?$_GET['tp']:'0').'-'; // basic cache file name
	  	// add filetype
      $cfile=$pfile.filemtime($file);
	  
      //clear all existing but no more valid clips of this file
      $dd=opendir($c_cache_path);
      while( $indirfile=readdir($dd) )
      {
        $indirfile=$c_cache_path."/".$indirfile;
        if( substr($indirfile,0,strlen($pfile)) == $pfile && $indirfile!=$cfile)
          unlink($indirfile);
      }
			
      // if this file exist, send this and don't recalculate it
      if( is_file($cfile) && $img_info=@getimagesize($cfile) )
      {
        $ctype="png";
        switch($img_info['2'])
        {
          case 1: 
            $ctype="gif";
            break;
          case 2:
            $ctype="jpg";
            break;
          case 3:
            $ctype="png";
            break;
        }
        header("Content-type: image/".$ctype);
        $fd=fopen($cfile,"rb");
        fpassthru($fd);
        fclose($fd);
        exit;
      }

      header("Last-Modified: " . gmdate("D, d M Y H:i:s",filemtime($file) ) . " GMT");

      $img_info=$bq_source=false;

      // See if file might be openable with some 2img plugins
      if( in_array(FileExtension($file),$c_ick_ext) && $c_ick2image)
      {
        include("inc/2img/imagemagick.php");
        $width=$c_fileview_thb_w;
        $height=$c_fileview_thb_h;
        
        if( isset($_GET,$_GET['typ']) )
        {
          switch($_GET['typ'])
          {
            case 'clip' :
              $width=$c_menu_img_w;
              $height=$c_menu_img_h;
              break;
            case 'big'  :
              $width=$c_show_w;
              $height=$c_show_h;
              break;
          }
        }
        $bq_source=imagecreatefromick($file,$width,$height);
      }
      elseif( in_array(FileExtension($file),$c_video_ext) && $c_video2img )
      {
        include("inc/2img/video.php");
        $bq_source=imagecreatefromvideo($file, isset($_GET['tp'])?$_GET['tp']:0);
	  }

      // 
      if($bq_source || $img_info=@getimagesize($file) )
      {
        $stop=false;
        if(!$bq_source)
          switch($img_info['2'])
          {
            case 1: 
              $bq_source=imagecreatefromgif ($file);
              break;
            case 2:
              $bq_source=imagecreatefromjpeg($file);
              break;
            case 3:
              $bq_source=imagecreatefrompng($file);
              break;
            case 6:
              if($c_bmp2img)
              {
                include("inc/2img/bmp.php");
                $bq_source=imagecreatefrombmp($file);
                break;
              }
            case 15:
              $bq_source=imagecreatefromwbmp($file);
              break;
            case 16:
              $bq_source=imagecreatefromxbm($file);
              break;
            default:
              $bq_source=NULL;	//unknown
              $stop=true;
              break;
          }
        $img_typ='jpg';	// wollen als ausgabe unbedingt ein jpg
        if(!$c_imagemodul)
                $stop=false;
        if(!$stop && $bq_source)
        {
          $whatbig=0;
          $bq_breite=imagesx($bq_source);
          $bq_hoehe=imagesy($bq_source);
          $qdim='thb';
          $stretch=false;
          if(isset($_GET['typ']))
            $qdim=$_GET['typ'];
          
          $prev_big=(isset($_GET['typ']) && $_GET['typ']=="big");
          
          switch($qdim)
          {
            case 'big' :
              $height=min($bq_hoehe,$c_show_h);
              $width =min($bq_breite,$c_show_w);
              $img_typ="png";
              break;
            case 'clip' :
              $width=$c_fileview_thb_w;
              $height=$c_fileview_thb_h;
              $stretch=true;
              break;
            case 'thb' :
            default :
              $width=$c_menu_img_w;
              $height=$c_menu_img_h;
              break;
          }

          $r = $bq_hoehe/$bq_breite;
          $r2= $height/$width;

          if($r>$r2)
          {
            $new_h = $height; //H�he max
            $new_w = $height/$r;
          }
          else
          {
            $new_w = $width; //Breite max
            $new_h = $width*$r;
            $whatbig=1;
          }

          $zb_source=imagecreatetruecolor(($stretch?$c_fileview_thb_w:$new_w),($stretch?$c_fileview_thb_h:$new_h)); //truecolor


          $kek=imagecolorallocate($zb_source,$menu_color_dec[0],$menu_color_dec[1],$menu_color_dec[2]);
          if($stretch)
            $kek=imagecolorallocate($zb_source,255,255,255);
          imagefill($zb_source,0,0,$kek);

          imagecopyresized( $zb_source,$bq_source,( (!$whatbig and $stretch) ?(($c_fileview_thb_w-$new_w)/2):0),
                            ( ($whatbig and $stretch)?(($c_fileview_thb_h-$new_h)/2):0),0,0,$new_w,$new_h,$bq_breite,$bq_hoehe); 
          if(isset($ftyp))
            $bq_typ=$ftyp;

          //imagestring($zb_source,1,0,0,"Time: ".(microtime_float()-now),0);
          
          // no caching? -> no cache-file
          if(!$c_cache_enable)
            $cfile=null;

          //header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // some day in the past
          header("Content-type: image/".$img_typ);	
          switch ($img_typ)
          {
            case 'jpg' : 
            case 'jpeg':
					imagejpeg($zb_source,$cfile,$menu_clip_quality);
              break;
            case 'gif' :
				if($cfile!=null)
					imagegif($zb_source,$cfile);
				else
					imagegif($zb_source);					
              break;
            case 'png' :
				if($cfile!=null)
			 		imagepng($zb_source,$cfile);
				else
			 		imagepng($zb_source);
              break;
          }
          // caching, so file was not send but only saved instead: send it
          if($c_cache_enable)
          {
            $fd=fopen($cfile,'rb');
            fpassthru($fd);
            fclose($fd);
          }
        }
        else
        {
	header("Content-type: image/gif");
	$fd=fopen("theme/invalidfile.png","rb"); //leer.gif
	fpassthru($fd);
	imagedestroy($gdim);
	break;
        /*  $zb_source=imagecreatetruecolor(min($c_menu_img_w,180),min($c_menu_img_h,8));
          $kek=imagecolorallocate($zb_source,$menu_color_dec[0],$menu_color_dec[1],$menu_color_dec[2]);
          imagefill($zb_source,0,0,$kek);
          imagestring($zb_source,1,0,0, str_replace('%f',$img_info['2'],html_entity_decode($l_men_inval_img)),$menu_color_error);
          header("Content-type: image/jpg");
          imagejpeg($zb_source,"",$menu_clip_quality); /**/
        }
        imagedestroy($zb_source);
        break;
      }
      header("Content-type: image/gif");
      $fd=fopen("theme/invalidfile.png","rb"); //leer.gif
      fpassthru($fd);
      imagedestroy($gdim);
      break;
    }

    case "ren" :	// renaming
    {
      if( isset($_GET['file'],$_GET['nname'],$_GET['path'],$_GET['oname']) && is_array($_GET['file']) )
      {
        if($f_right_to_rename)
        {	
          $error="";
          $_GET['nname']=preg_replace("@(\\\\|\"|\/|\:|\*|\?|\<|\>|\|)@si","-",str_replace("\'","'",$_GET['nname']));
          //	Get to know what has changed: Handle extension and name seperatly
          $next=pathinfo($_GET['nname'],PATHINFO_EXTENSION);  $ncut=(strlen($next)>=1?strlen($next)+1:0);
          $oext=pathinfo($_GET['oname'],PATHINFO_EXTENSION);  $ocut=(strlen($oext)>=1?strlen($oext)+1:0);
          $nnam=substr($_GET['nname'],0,strlen($_GET['nname'])-$ncut);
          $onam=substr($_GET['oname'],0,strlen($_GET['oname'])-$ocut);

          // either change name or extension. if all same, change extension, if both changed, change name
          $changename=($nnam!=$onam );
          $changeext =( ($next!=$oext && ($nnam==$onam || count($_GET['file'])==1 ) ) || ($next==$oext && $nnam==$onam));

          //die("CHN: '$changename'<br/>EXT: '$changeext'<br/>NEXT: '$nnam'.'$next'<br/>OEXT: '$onam'.'$oext'<br/>");

          // get path
          $path=securl($_GET['path']);

          foreach($_GET['file'] as $file)
          {
            $fext=pathinfo($file,PATHINFO_EXTENSION); $fcut=strlen($fext);
            $fnam=substr($file,0,max(0,strlen($file)-$fcut-(strpos($file,'.')?1:0) )  );

            $source=t_folder."/".str_replace("\\'","'",$path."/".$file);
            $extens=($changeext?($next!=""?".".$next:""):($fext!=""?".".$fext:""));
            $destin=t_folder."/".str_replace("\\'","'",$path."/".($changename?$nnam:$fnam)).$extens;
            $count=0;
            while( is_file($destin) || is_dir($destin) )
              $destin=t_folder."/".str_replace("\\'","'",$path."/".($changename?$nnam:$fnam)." (".(++$count).")".$extens );

            /*echo "$source<br/>$destin<br/>";
            exit;/**/

            if(!@rename( $source, $destin))
              $error.=str_replace("%f",basename($source),$l_men_no_rename)."\n\n";
          }
        }
        else
          $error.=$l_men_block_ren."\n\n";
              ?>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
<?php
if($error!="")
  echo "alert(hexcode2string(\"".string2jscode(html_entity_decode($error))."\"));\n";
echo "parent.folderview.opendir_spec(\"".string2jscode( securl($_GET['path']) ) ."\",true);\n";
?>//-->
</script>
<?php
      }
      break;
    }

    case "mov" :	// move
    {
      if( isset($_GET['file'],$_GET['path'],$_GET['dpath']) && is_array($_GET['file']) )
      {
        // get path
        $path=securl($_GET['path']);
        $dpath=securl($_GET['dpath']);
        if($f_right_to_moveNcopyto)
        {
          if( is_dir(t_folder."/".$dpath) )
          {
            $error="";
            foreach($_GET['file'] as $file)
            {
              // replace unwanted \'s
              $file=string_clean($file);
              if( is_dir(t_folder."/$path/$file") || is_file(t_folder."/$path/$file") )
              {
                if( !is_dir(t_folder."/$dpath/$file") && !is_file(t_folder."/$dpath/$file") )
                {
                  $source=securl($path."/".$file);
                  $destin=securl($dpath."/".$file);
                  if(!@rename( t_folder."/".$source, t_folder."/".$destin))
                          $error.=str_replace(array("%sfile%","%dfile%"),array("$path/$file","$dpath/$file"),$l_men_mv_failed)."\n\n";
                }
                else
                  $error.=str_replace("%dfile%","$dpath/$file",$l_men_mv_f_ex)."\n\n";
              }
              else
                $error.=str_replace("%sfile%","$path/$file",$l_men_mv_f_nex)."\n\n";
            }
          }
          else
            $error.=str_replace("%dfile%",$dpath,$l_men_mv_d_nex)."\n\n";
        }
        else
          $error.=$l_men_block_mNc."\n\n";
              ?>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
<?php
if($error!="")
  echo "alert(hexcode2string(\"".string2jscode(html_entity_decode($error))."\"));\n";
echo "parent.folderview.change2dir(parent.folderview.hexcode2string(\"".string2jscode($error==""?$dpath:$path)."\"));\n";
?>//-->
</script>
<?php
        }
      break;
    }
    case "cpy" :	// copy
    {
      if( isset($_GET['file'],$_GET['path'],$_GET['dpath']) && is_array($_GET['file']) )
      {
        // get path
        $path=securl($_GET['path']);
        $dpath=securl($_GET['dpath']);
        if($f_right_to_moveNcopyto)
        {
          if( is_dir(t_folder."/".$dpath) )
          {
            $error="";
            foreach($_GET['file'] as $file)
            {
              // replace unwanted \'s
              $file=string_clean($file);
              if( is_dir(t_folder."/$path/$file") || is_file(t_folder."/$path/$file") )
              {
                  if( !is_dir(t_folder."/$dpath/$file") && !is_file(t_folder."/$dpath/$file") )
                  {
                    include_once("inc/cpydir.php");
                    $source=securl($path."/".$file);
                    $destin=securl($dpath."/".$file);
                    if( (is_dir(t_folder."/".$source) && !dircpy(t_folder."/",$source,$destin) ) ||
                        (is_file(t_folder."/".$source) && !@copy( t_folder."/".$source, t_folder."/".$destin) ) )
                      $error.=str_replace(array("%sfile%","%dfile%"),array("$path/$file","$dpath/$file"),$l_men_cy_failed)."\n\n";
                  }
                  else
                    $error.=str_replace("%dfile%","$dpath/$file",$l_men_cy_f_ex)."\n\n";
              }
              else
                $error.=str_replace("%sfile%","$path/$file",$l_men_cy_f_nex)."\n\n";
            }
          }
          else
            $error.=str_replace("%dfile%",$dpath,$l_men_cy_d_nex)."\n\n";
        }
        else
          $error.=$l_men_block_mNc."\n\n";
        ?>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
<?php
if($error!="")
  echo "alert(hexcode2string(\"".string2jscode(html_entity_decode($error))."\"));\n";
echo "parent.folderview.change2dir(parent.folderview.hexcode2string(\"".string2jscode($error==""?$dpath:$path)."\"));\n";
?>//-->
</script>
<?php
        }
        break;
      }
		
      case "del" :	// deleting
      {
        if( isset($_GET['file']) && is_array($_GET['file']) )
        {
          $error="";
          foreach($_GET['file'] as $file)
          {
            $source=t_folder."/".securl(str_replace("\\'","'",$file) );
            if(	$f_right_to_delete)
            {
              if( strrpos($source,"/")==(strlen($source)-1) )						//	Letztes / entfernen, falls vorhandne
                $source=substr($source,0,strlen($source)-1);
              
              if(is_dir($source))
              {
                if(!remdir($source))
                  $error.=str_replace("%f",basename($source),$l_men_no_delete)."\n\n";
              }
              else
                if(!@unlink($source))
                  $error.=str_replace("%f",basename($source),$l_men_no_delete)."\n\n";
            }
            else
              $error.=$l_men_block_del."\n\n";
          }
?>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
<?php
			if($error!="")
				echo "alert(hexcode2string(\"".string2jscode(html_entity_decode($error))."\"));\n";
			echo "parent.folderview.opendir_spec(\"".string2jscode( dirname(securl($_GET['file'][0]) ) )."\",true);\n";
?>//-->
</script>
<?php
        }
        break;
      }
      case "crdir" :	// renaming
      {
        $destin=securl(str_replace("\\'","'",$_GET['path']));
        $namerec=$name=t_folder."/".securl( $destin."/".preg_replace("@(\\\\|\"|\/|\:|\*|\?|\<|\>|\|)@si","-",str_replace("\\'","'",$_GET['name'])));
        
        $error="";	

        if($f_right_to_crdir)
        {	
            // Rename file if path already exists
            $count=0;
            while( is_file($name) || is_dir($name) )
              $name="$namerec (".(++$count).")";

            if(!@mkdir($name))
              $error.="$l_men_no_crdir\n\n";
        }
        else
          $error.=$l_men_block_crd."\n\n";
?>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
<?php
if($error!="")
  echo "alert(hexcode2string(\"".string2jscode(html_entity_decode($error))."\"));\n";
echo "parent.folderview.opendir_spec(\"".string2jscode( securl($_GET['path']) )."\",true);\n";
?>//-->
</script>
<?php
      break;
      }
      case "chm";		// changing file permissons
      {
        if( isset($_GET['file'],$_GET['path'],$_GET['chm']) && is_array($_GET['file']) && !preg_match('/[^01234567]/',$_GET['chm']) && strlen($_GET['chm'])==3 )
        {
          $error="";
          if($f_right_to_chmod)
          {
            $path=securl($_GET['path'])."/";
            foreach($_GET['file'] as $file)
            {
              $npath=t_folder."/".securl($path.$file);
              if(is_dir($npath) || is_file($npath) )
              {
                $octv=decoct(base_convert($_GET['chm'],8,10));
                if( !chmod($npath,base_convert($_GET['chm'],8,10)) )
                  $error.=str_replace('%file%',$file,$l_men_chm_nw)."\n";
              }
              else
                $error.=str_replace('%file%',$file,$l_men_chm_nex)."\n";							
            }
          }
          else
            $error.=$l_men_block_chm."\n";
?>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
<?php
if($error!="")
  echo "alert(hexcode2string(\"".string2jscode(html_entity_decode($error))."\"));\n";
echo "parent.folderview.change2dir(parent.folderview.hexcode2string(\"".string2jscode($path)."\"));\n";
?>//-->
</script>
<?php
        }
      break;
      }
    }
}
?>