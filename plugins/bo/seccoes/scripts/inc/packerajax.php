<?php
function terminate($erno,$file=null)
{
  $lf="";
  eval("global \$l_pck_erno_$erno;\r\n\$lf=\$l_pck_erno_$erno;");
  die($erno."_=_".string2jscode( html_entity_decode($lf) ).($file!=null?'_=_'.string2jscode( $file['name']):'') );
}

// no \'s
foreach($_POST as $key => $var)
  $_POST[$key]=str_replace('\\','',$var);

if( isset($_POST['lg']) )
{
  $_COOKIE['language']=$_POST['lg'];
  include_once(dirname(__FILE__).'/lang.php');
  $zipfile=new ZipArchive();

  
  // unzipping
  if( isset($_POST['p'],$_POST['unzip'],$_POST['unp2']) )
  {
    // file to unzip valid?
    if( securl($_POST['unzip'])!=$_POST['unzip'] )
      terminate(301);
    $zfile=t_folder.'/'.$_POST['unzip'];
    
    // zipfile not a valid archiv
    $re=$zipfile->open($zfile);
    if( $re!==true )
      termiante(302);
    
    // destination invalid?
    if( securl($_POST['unp2'])!=$_POST['unp2'] )
      terminate(303);
    $ddir=t_folder.'/'.$_POST['unp2'];
    
    // need to create the destination-folder
    if( !is_dir($ddir) && !@mkdir($ddir) )
      terminate(304);
    
    // extracting actual file:
    $d_info=$zipfile->statIndex($_POST['p']);
    $d_info2=$zipfile->statIndex($_POST['p']+1);
    
    // do the destination folders exist
    $d_dir=t_folder.'/'.securl($_POST['unp2'].'/'.$d_info['name']);
    $d_dira=explode('/',$d_dir);
    
    // erstelle zielstruktur
    for($i=0;$i<count($d_dira);$i++)
    {
      if($d_dira[$i]!="")
      {
        if( !is_dir($ddir) && !@mkdir($ddir) )
        {
          global $l_pck_erno_401;
          $l_pck_erno_401.=" p:".$d_dir;
          terminate(401,$d_info2);
        }
      }
    }
    
    // erstelle Datei
    if(!$zipfile->extractTo($ddir,array($d_info['name']) ) )
      terminate(402,$d_info2);
    else
      terminate(100,$d_info2);
  }
  // zipping
  elseif( isset($_POST['file2add'],$_POST['t_add2file'],$_POST['t_add2dir'] ) )
  {
    // Filename given?
    if( $_POST['t_add2file']=="" )
      terminate(101);
  
    // create filepath
    $zfile=t_folder.'/'.securl($_POST['t_add2dir']).'/'.basename($_POST['t_add2file']);
  
    // is path 2 dir?
    if( is_dir($zfile) )
      terminate(102);
  
    // Should a file be created?
    if( isset($_POST['createzipfile']) && $_POST['createzipfile']==1 )
    {
      // ex. file bereits
      if( is_file($zfile) )
        terminate(103);
      // try to create archive
      if( $zipfile->open($zfile, ZIPARCHIVE::CREATE)!==TRUE )
        terminate(104);
      else
        $zipfile->setArchiveComment('File created with '.prgm_name.' v'.prgm_version.' on '.date('r').'.');
    }
    else
    {
      // does file not exist
      if( !is_file($zfile) )
        terminate(105);
      // try to open archive
      $re=$zipfile->open($zfile);
      
      /*if( $re!=true );
        terminate(106);/**/
    }
  
    // is given file a valid path
    if( securl($_POST['file2add'])!=$_POST['file2add'] )
      terminate(201);

    $afile=t_folder.'/'.securl($_POST['file2add']);

    // does given file exist
    if( !is_file($afile) && !is_dir($afile) )
      terminate(202);
    
    // alles i.O. beginn adding prozess
    $ret=false;
    if( is_file($afile) )
      $ret=zip_addfile($zipfile,$afile,basename($afile) );
    else
      $ret=zip_addfolder($zipfile,$afile,basename($afile) );
  
    $zipfile->close();
  
    if( $ret )
      terminate(100);
    else
      terminate(999);
  }
}

/** Add a dir to a zip stream
 * @param zipstream  ZIP Stream
 * @param localpath  Path on local machine
 * @param pathinzip  Path in zip file        */ 
function zip_addfolder($zipstream,$localpath,$pathinzip)
{
    $ret=true;
    // öffne Ordner
    if( is_dir($localpath) && $fd=opendir($localpath) )
    {
      while($res=readdir($fd) )
      {
        if( $res!=".." && $res!="." )
          if( is_dir("$localpath/$res") )
            $ret=$ret && zip_addfolder($zipstream,"$localpath/$res","$pathinzip/$res");
          else
            $ret=$ret && zip_addfile($zipstream,"$localpath/$res","$pathinzip/$res");
      }
    }
    return $ret;
}

/** Add a file to a zip stream
 * @param zipstream  ZIP Stream
 * @param localpath  Path on local machine
 * @param pathinzip  Path in zip file        */ 
function zip_addfile($zipstream,$localpath,$pathinzip)
{
        return $zipstream->addFile($localpath,$pathinzip);
}
?>