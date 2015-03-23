<?php
/*MODF: 23:52:00,10.07.07*/

function chcksum($string)
{
  $val=0;
  for($i=0;$i<strlen($string);$i++)
    $val+=ord(substr($string,$i,1))*(($i%11)+1);
  return $val;
}

/** Function creates return a gd-stream image from a given file (supported by imagemagick)
 * @param   $file       any file supported by imagemagick to create an gd-stream from
 * @param   $maxwidth   Maximal width of requested image
 * @param   $maxheight  Maximal height of requested image
 * @return  gd-stream   GD-Stream of given imagemagick file or NULL if something went wrong */
function imagecreatefromick($file,$maxwidth,$maxheight)
{
  global $c_ick2img_exec,$c_ick2img_timeout,$c_ick2img_retry,$c_cache_path,$c_ick2img_abrtOnMsg;

  //  Dateispezifische Daten bestimmen
  $extension="png";
  srand(chcksum($file));
  $rand=rand(100000,999999);
  $output="$c_cache_path/ick2img$rand.$extension";

  // escape file and output
  $file=str_replace('"','\\"',$file);
  $output=str_replace('"','\\"',$output);

  // Delete cached image if it may exist
  @unlink($output);
  
  // create command
  $cmd=str_replace(array("%INPUT%","%OUTPUT%",'%WIDTH%','%HEIGHT%','\\'),array($file,$output,$maxwidth,$maxheight,'/'),$c_ick2img_exec).' 2>&1';

  // Process-tries counter
  $i=0;
  //while process has not time outed and destination file does not yet exist
  while(!is_file($output) && $i<$c_ick2img_timeout )
  {
    // while passing amount of seconds where to retry
    if($i%$c_ick2img_retry==0 )
    {
      // rerun program
      $fd=popen($cmd,"r");
      $ret=fgets($fd);
      pclose($fd);
      if( strpos($ret,$c_ick2img_abrtOnMsg)!==false )
        return null;
    }

    // Count up tries
    $i++;

    // wait a moment before restarting loop again
    sleep(1);
  }

  // if finally succeeded
  if( is_file($output) )
  {
    $gd=NULL;
    // Load file as stream
    $gd=imagecreatefrompng($output);
    unlink($output);
    // return stream
    return $gd;
  }
  
  // any other case return NULL
  return NULL;
}
?>