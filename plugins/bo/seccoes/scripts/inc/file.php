<?php
/*MODF:	22:15:00,14.03.07*/

function FilePermsDecode( $perms )
{
  $oct=strrev( decoct( $perms ) );
  //              0      1      2      3      4      5      6      7
  $masks = array( '---', '--x', '-w-', '-wx', 'r--', 'r-x', 'rw-', 'rwx' );
  return(
          sprintf( '%s %s %s',
                  array_key_exists( $oct[ 2 ], $masks ) ? $masks[ $oct[ 2 ] ] : '###',
                  array_key_exists( $oct[ 1 ], $masks ) ? $masks[ $oct[ 1 ] ] : '###',
                  array_key_exists( $oct[ 0 ], $masks ) ? $masks[ $oct[ 0 ] ] : '###'
                  )
         );
}

/** Converts filesize in bytes to an easy readable format
 * @param   $size   Filesize in bytes
 * @return  string  Easy readable filesize format */
function FileEasySize($size)
{
  $dims=array('&nbsp;','K','M','G','T','P');
  $dim=0;

  while( ($size/1024) > 0.95)
  {
    $size/=1024;
    $dim++;
  }
  return round($size,2).$dims[$dim]."B";
}

/** Removes bug for files bigger than 2gb
 * @param  $file  Path to file 		*/
function FileSize2($file)
{
	global $f_filesize_alternativ;

	$size=filesize($file); //sprintf("%u",filesize($file));
	
	// handling files above 4gb
	if( $f_filesize_alternativ )		//$size<0 does not work with filesize higher than 4 resp 8 GB on 32 resp 64 bit machines
		// UNIX:
		if (	!(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN'))
		{
			$fileL=escapeshellarg ($file);
			$size = trim(`stat -c%s $fileL`);
		}
		else
		// WIN
		{
			$fsobj = new COM("Scripting.FileSystemObject");
			$f = $fsobj->GetFile($file);
			$size = $f->Size;
		}

	return $size;
}

/*	 Inpt: file.xyz -> return .xyz
			xyz		-> return xyz	*/
function FileExtension($file)
{
	$file=basename($file);
	$pos=strrpos($file,".");
	if($pos===false)
		return $file;
	else
		return substr($file,$pos);
}

function GiveShowableTypes()
{
	global $c_imagemodul,$c_video_ext,$c_bmp2img,$c_video2img,$c_ick2image,$c_ick_ext;
	$showabletypes=array();
	$img_sup=gd_info();	// Get List of supported image
	if($c_imagemodul)
	{
		// Include Imagetypes
		if($img_sup["GIF Read Support"])
			$showabletypes[]=".gif";
		if($img_sup["JPG Support"])
		{
			$showabletypes[]=".jpg";
			$showabletypes[]=".jpeg";
		}
		if($img_sup["PNG Support"])
			$showabletypes[]=".png";
		if($img_sup["WBMP Support"])
			$showabletypes[]=".wbmp";
		if($img_sup["XBM Support"])
			$showabletypes[]=".xbm";
		if($c_bmp2img)
			$showabletypes[]=".bmp";
		if($c_video2img)
			$showabletypes=array_merge($showabletypes,$c_video_ext);
		if($c_ick2image)
			$showabletypes=array_merge($showabletypes,$c_ick_ext);
	}
	
	return $showabletypes;
}

function f_show_hidden_file($str2file)
{
	if( !f_show_hidden_files && substr(basename($str2file),0,1)=='.' )
		return false;
	if( !f_show_hidden_winfiles )
	{
		$str2file=preg_replace('/\\\\/','/',$str2file);
		$cmd="attrib \"$str2file\"";
		$ret=`$cmd`;
		/*$fd=fopen(dirname(__FILE__).'/../attrib.log','a');
		fwrite($fd,"$cmd\r\n\t=>$ret\r\n\t=>".(substr($ret,4,1) == "H"?"HIDE IT":"SHOW IT")."\r\n");
		fclose($fd);/**/
		if( substr($ret,4,1) == "H" )
			return false;
	}
	return true;
}

?>