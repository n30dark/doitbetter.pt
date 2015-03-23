<?php
/*MODF: 08:54:00,10.07.07*/
/*
ERRORTABLE
 1    all ok
-1    invalid request
-2    can't read/write/create document
-3    can't rename file
-4    can't delete old file
*/

if( isset($_POST['cmd']) )
{
  switch( $_POST['cmd'] )
  {
    case 'qsave' :
    {
      $file2save=null;
      $fd=null; // filepointer
      $fn=null; // filename
      
      // needs a file be created
      if( isset($_POST['create']) )
      {
        // find an inexisting filename
        do
        {
          $fn='SvTXT-'.rand(100,999).'-'.rand(100,999).'.tmp';
        } while( is_file("$c_cache_path/$fn") && is_dir("$c_cache_path/$fn") );

        $fd=@fopen("$c_cache_path/$fn",'a');
      }
      // or is a filename given
      else
      {
        $fn=$_POST['tfilename'];
        $fd=@fopen("$c_cache_path/$fn",'a');
      }

      // error while opening document?
      if( !$fd )
        die('-2');

      fwrite($fd,str_replace(array('\\\'',"\\\"","\\\\"),array('\'',"\"","\\"),$_POST['cmdtxt']));
      fclose($fd);
      
      // is document finished?
      $end='0';
      $perms=NULL;
      $own=NULL;
      $grp=NULL;
      if( isset($_POST['end']) )
      {
        $perms=fileperms($file);
        $own=fileowner($file);
        $grp=filegroup($file);
        
        if( is_file($file) && !@unlink($file) )
        {
          @unlink("$c_cache_path/$fn");
          die('-4');
        }

        if(!@rename("$c_cache_path/$fn",$file))
          $end='-3';
        else
          $end='1';
        
        @chmod($file,$perms);
        @chown($file,$own);
        @chgrp($file,$grp);
      }

      die('1|'.$end.'|'.string2jscode($fn));

      break;
    }
    // get amount of lines in document
    case 'qline' :
    {
      $fd=@fopen($file,'r');
      // document not readable? 
      if( !$fd )
        die('-2');
      // amount of lines:
      /*$c=1;
      while(!feof($fd) )
      {
        fgets($fd);
        $c++;
      }*/
      fclose($fd);
      $c=filesize($file);
      die('1|'.$c);
      break;
    }
    // get lines in document
    case 'qtext' :
    {
      if( !isset($_POST['from'],$_POST['to'] ) )
        die('-1');

      // go to specified line
      $fd=@fopen($file,'r');
      /*for($i=0;$i<$_POST['from'] && !feof($fd);$i++)
        fgets($fd);/**/
      @fseek($fd,$_POST['from'],SEEK_SET);
      // read lines
      $outpt="";
      /*for($i=0;$i<$_POST['to'] && !feof($fd);$i++)
        $outpt.=fgets($fd);/**/
      $outpt=@fread($fd,$_POST['to']);

      die('1|'.string2jscode($outpt));
      break;
    }
  }
}
die('-1');
?>