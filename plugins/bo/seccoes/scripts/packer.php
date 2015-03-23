<?php 
/*MODF:	19:50:00,17.04.07*/

// Loadsettings
include_once("inc/settings.php");
// Include Icon selector
include_once("inc/icons.php");

$firstfile="First file";
$destfolder="UndefinedFolder";


// shortens a file name
function shorten($filepath)
{
  $maxlen=34;
  
  // nothing to make shorter
  if(strlen($filepath)<=$maxlen)
    return $filepath;

  $part1=substr($filepath,0,round($maxlen/2-5) );
  $part2=substr($filepath,strlen($filepath)-round($maxlen/2)-2);
  return $part1."...".$part2;
}

/*if( !class_exists('ZIPARCHIVE') )
	die('No Zipclass');
else
	die('Zipclass'); /**/

// gets zip error
function geterror($err)
{
  switch($err)
  {
  	default:
  	case ZIPARCHIVE::ER_OK : 
      die('No error.');
      break; 
    case ZIPARCHIVE::ER_MULTIDISK :
      die('Multi-disk zip archives not supported.');
      break;
    case ZIPARCHIVE::ER_RENAME :
      die('Renaming temporary file failed.');
      break; 
    case ZIPARCHIVE::ER_CLOSE :
      die('Closing zip archive failed');
      break; 
    case ZIPARCHIVE::ER_SEEK:
      die('Seek error');
      break; 
    case ZIPARCHIVE::ER_READ :
      die('Read error');
      break; 
    case ZIPARCHIVE::ER_WRITE :
      die('Write error');
      break; 
    case ZIPARCHIVE::ER_CRC :
      die('CRC error');
      break; 
    case ZIPARCHIVE::ER_ZIPCLOSED :
      die('Containing zip archive was closed');
      break; 
    case ZIPARCHIVE::ER_NOENT :
      die('No such file.');
      break; 
    case ZIPARCHIVE::ER_EXISTS :
      die('File already exists ');
      break; 
    case ZIPARCHIVE::ER_OPEN :
      die('Can\'t open file.');
      break; 
    case ZIPARCHIVE::ER_TMPOPEN :
      die('Failure to create temporary file.');
      break; 
    case ZIPARCHIVE::ER_ZLIB :
      die('Zlib error ');
      break; 
    case ZIPARCHIVE::ER_MEMORY :
      die('Memory allocation failure');
      break; 
    case ZIPARCHIVE::ER_CHANGED :
      die('Entry has been changed ');
      break; 
    case ZIPARCHIVE::ER_COMPNOTSUPP :
      die('Compression method not supported.');
      break; 
    case ZIPARCHIVE::ER_EOF :
      die('Premature EOF');
      break; 
    case ZIPARCHIVE::ER_INVAL :
      die('Invalid argument ');
      break; 
    case ZIPARCHIVE::ER_NOZIP :
      die('Not a zip archive');
      break; 
    case ZIPARCHIVE::ER_INTERNAL :
      die('Internal error ');
      break; 
    case ZIPARCHIVE::ER_INCONS :
      die('Zip archive inconsistent ');
      break; 
    case ZIPARCHIVE::ER_REMOVE :
      die('Can\'t remove file ');
      break; 
    case ZIPARCHIVE::ER_DELETED :
      die('Entry has been deleted');
      break; /**/
  }
}

/** check if only a single and valid zip file has been passed **/
function checkifsinglezipfile()
{
  global $firstfile,$destfolder;

  // No GET or array with files does not exists or has more than one file..
  if( !isset($_GET,$_GET['file']) || !is_array($_GET['file']) || count($_GET['file'])!=1 )
    // so report
    return false;

  // path violation given for file and path to extract to
  if( securl($_GET['chd'].'/'.$_GET['file'][0])!=$_GET['chd'].'/'.$_GET['file'][0] || securl($_GET['chd'])!=$_GET['chd'] )
    return false;

  $zfile=t_folder.'/'.$_GET['chd'].'/'.$_GET['file'][0];

  // is folder?
  if(is_dir($zfile) )
    return false;

  $zipfile=new ZipArchive();

  $fp=$zipfile->open($zfile);//zip_open($zfile);
  //geterror($fp);

  if( !$fp )
    return false;

  // Count elements in zip
  $count=0;
  while($f=$zipfile->statIndex($count))
  {
    if($count==0)
      $firstfile=$f['name'];
    $count++;
  }
  if($count==0)
    return false;

  //find folder to extract
  $c=0;
  $odir=$_GET['chd'].'/'.substr($_GET['file'][0],0,(strrpos($_GET['file'][0],'.')>0?strrpos($_GET['file'][0],'.'):strlen($_GET['file'][0])));
  $cdir=$odir;
  while( is_dir(t_folder."/".$cdir) || is_file(t_folder."/".$cdir) )
  {
    // prevent endless loop
    if( $c>2000 )
      return false;
    $cdir="$odir (".(++$c).")";
  }
  $destfolder=$cdir;

  return $count;
}


// Get opened folder
$opendir=isset($_GET['chf'])?securl($_GET['chf']):t_c_folder;

//Set fullpath
$fullpath=t_folder."/$opendir";

if( isset($_POST['dozip']) )
{
  include('inc/packerajax.php');
}
else
{
  $is_valid_single_zip=checkifsinglezipfile();
?>
<?php echo "<?xml version=\"1.0\" encoding=\"$l_charset\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ($is_valid_single_zip!==false?$l_dpck_t:$l_pck_t); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l_charset; ?>"/>
<link rel="stylesheet" href="theme/format.css" type="text/css" media="all"/>
<style type="text/css">
div#progress        {   border: 1px solid #36c; background-color: #eee; width: 195px; height: 14px; padding: 1px;       }
div#progress_value  {   width:0px; height:14px; background-color: #36f; }
div#terminal        {   background-color: black; color: #ccc; height: 100%; width: 100%; font-size: 12px;
                        position: absolute; z-index: -1; padding: 2px; padding-top: 26px; white-space: nowrap;  }
div#inprogress      {   display: none; position: absolute; top: 0; left: 0; width: 100%; height: 34px;
                        background-image:url(theme/bg_half.gif); text-align:center; padding-top: 18px;  }
div#inprogress img  {}
</style>
<script language="javascript" type="text/javascript" src="theme/ajax.js"></script>
<script language="javascript" type="text/javascript" src="theme/packer.js"></script>
<script language="javascript" type="text/javascript" src="theme/general.js"></script>
<?php
if( $is_valid_single_zip!==false )
{
?>
<script language="javascript" type="text/javascript">
<!--//
// Amount of files to extract
var files=<?php echo $is_valid_single_zip; ?>;
var curfile=hexcode2string("<?php echo string2jscode($firstfile); ?>");
var unpack2=hexcode2string("<?php echo string2jscode($destfolder); ?>"); // unpack destination
var filesdone=0;

// Terminal history
var terminal_text=Array('&nbsp;','&nbsp;','&nbsp;','&nbsp;','&nbsp;','&nbsp;','&nbsp;','&nbsp;');

/** Adds new line to terminal
 * @param string Line to add to terminal */
function terminal_newline(string)
{
  terminal_text[terminal_text.length]='&gt;'+string;
  terminal_redraw();
}
/** Redefines current line and redraws terminal
 * @param string Line to add to terminal */
function terminal_reline(string)
{
  terminal_text[terminal_text.length-1]='&gt;'+string;
  terminal_redraw();
}
/** Redraws terminal window */
function terminal_redraw()
{
  var conts="";
  for(var i=(terminal_text.length-8);i<terminal_text.length;i++)
    conts+=terminal_text[i]+"<br/>";
  document.getElementById('terminal').innerHTML=conts;
}

/** shortens a filepath
 * @param filepath  Path that has the be shortened  */
function shorten(filepath)
{
  var maxlen=34;
  
  // nothing to make shorter
  if(filepath.length<=maxlen)
    return filepath;

  var part1=filepath.substr(0,Math.round(maxlen/2-5) );
  var part2=filepath.substr(filepath.length-Math.round(maxlen/2)-2);
  return part1+"..."+part2;
}

function start2unpack(string)
{
  if( filesdone>0 )
  {
    // status%statustext%filename
    var comm=string.split('_=_',3);

    //alert(string);

    var error2abort=Array(301,302,303,304);
    // do we need to abort
    if( error2abort.contains(comm[0]) )
    {
      alert(hexcode2string("<?php echo string2jscode($l_pck_abort_op); ?>")+'\r\n('+comm[0]+'): '+hexcode2string(comm[1]) );
      terminal_reline(shorten(curfile)+" -> "+hexcode2string(comm[1]));
      return;
    }
    
    //alert(comm[0]+"\n"+hexcode2string(comm[1])+"\n"+hexcode2string(comm[2])+"\n"+(error2abort.contains(comm[0])?"CONTS":"DNC"));
    
    // report in terminal, did one file
    terminal_reline(shorten(curfile)+" -> "+hexcode2string(comm[1]));
    
    // actualize filename
    curfile=hexcode2string(comm[2]);
  }
  
  // finished?
  if(files<=filesdone)
  {
    if( typeof opener.curdir != undefined )
      opener.parent.folderview.change2dir(unpack2);
    terminal_newline("===============");
    return;
  }
  
  // info in terminal about unzipping
  terminal_newline(curfile+" .. unpacking");
  
  var q='dozip=1&lg=<?php echo ($l_shortcuts); ?>&unzip=<?php echo urlencode($_GET['chd'].'/'.$_GET['file'][0]);?>&p='+filesdone+'&unp2=<?php echo urlencode($destfolder); ?>';
  sendRequest('packer.php', q, 2, 98 );
  
  // Increase count for extracted files
  filesdone++;
  
  // Draw Statusbar
  progress_value(filesdone/files*100);
}
//-->
</script>
</head>
<body onload="start2unpack();">
 <div style="top:0px" class="toolbar">
  <div class='text' id="progress"><div id="progress_value"></div></div>
 </div>
 <div id='terminal'>
 </div>
</body>
</html>
<?php
}
else
{
?>
<script language="javascript" type="text/javascript">
<!--//
// Vars to temporarly save informations while zip in process:
var flno="";  //  Original Name
var flnp="";  //  Pointer to option element
var flnn=-1;  //  Index number in select-ion area
var flns=0;   //  State of processed file: 1 => OK, 0 => failed

/** Start zipping process */
function start2zip()
{
  // prevent user from starting zipping again
  document.getElementById('inprogress').style.display='block';
  // reset Statusbar
  progress_value(0);
  // Run zip process
  flnn=-1;
  zipnext("");
}

/** shortens a filepath
 * @param filepath  Path that has the be shortened  */
function shorten(filepath)
{
  var maxlen=34;
  
  // nothing to make shorter
  if(filepath.length<=maxlen)
    return filepath;

  var part1=filepath.substr(0,Math.round(maxlen/2-5) );
  var part2=filepath.substr(filepath.length-Math.round(maxlen/2)-2);
  return part1+"..."+part2;

}

/** Zips next element in row
 * @param i Indexnummer of last processed element   */
function zipnext(retstr)
{
  //alert(retstr);
  var i=flnn;
  i++;
  
  // Trigger Statusbar
  progress_value(i/window.document.packerform.files.length*100);

  // Actualize state of current file
  if( flnn!=-1 )
  {
    rets=retstr.split('_=_');
    //alert(retstr);
    rets[1]=hexcode2string(rets[1]);

    // abort needed?
    var abort_codes=Array( 101,102,103,104,105,106 );

    flnp.text=shorten(flno)+" -> "+rets[1];

    if( abort_codes.contains(rets[0]) )
    {
      alert(hexcode2string("<?php echo string2jscode($l_pck_abort_op); ?>")+'\r\n('+rets[0]+'): '+rets[1]);
      // allow user to unzip again
      document.getElementById('inprogress').style.display='none';
      return;
    }
   }

  // is there another file
  if(i<window.document.packerform.files.length)
  {
    // Process it: save pointer to option
    flnp=window.document.packerform.files.options[i];
    // Save text
    flno=flnp.value;
    // Save index
    flnn=i;
    // Reset processing state variable
    flns=0;
    // Indicate zipping process on display
    flnp.text=shorten(flno)+" ...zipping";
    // focus to element... donno

    // Send ajax rqst
    var q='dozip=1&lg=<?php echo ($l_shortcuts); ?>&file2add='+urlencode(flnp.value)+'&t_add2file='+urlencode(window.document.packerform.filename.value)+'&t_add2dir='+urlencode(window.document.packerform.chd.value)+(i==0?'&createzipfile=1':'');
    //alert("POST:"+q);
    sendRequest('packer.php', q, 2, 99 );
     // window.setTimeout('zipnext('+i+')',400);
  }
  // else, finish with zipping
  else
  {
    if( typeof opener.curdir != undefined )
      opener.location.href='files.php?bf='+urlencode(opener.curdir);
    // allow user to unzip again
    document.getElementById('inprogress').style.display='none';
  }
}

var dirselwin=null;
/** Opens dialog to choose a destination folder */
function opendirsel()
{
  var path=window.document.packerform.chd.value;
  var mkdr=window.document.packerform.chd.value;

  if(!dirselwin || dirselwin.closed)
    parent.dirselwin=window.open("foldersel.php?nod="+urlencode(path)+"&sd="+urlencode(mkdr),"",
                                 "dependent=yes, height=300, width=240, left=200, top=100, location=no, menubar=no, resizable=no, status=no, toolbar=no")
  else
    parent.dirselwin.focus();
}

/** Saves a wanted path to submitted input field in form
 * @param path  Path to destination folder where to save the zip */
function foldersel_onselect(path)
{
  window.document.packerform.chd.value=path;
}
//-->
</script>
</head>
<body>
<form style="margin:0; padding:0;" name="packerform" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return false">
 <div class="toolbar">
  <img src="theme/pack-it.gif" title="<?php echo $l_pck_start2zip; ?>" alt="<?php echo $l_pck_start2zip; ?>" class="button" onclick="start2zip();"/>
  <input type="text" name="filename" value="<?php echo $l_pck_def_zfile; ?>" class="text" /><br/>
 </div>
 <div style="top:26px" class="toolbar">
  <label for="chd"><img src="theme/seldir.gif" style="margin-right:3px;" title="<?php echo $l_pck_choose_dir; ?>" alt="<?php echo $l_pck_choose_dir; ?>" class="button" onclick="opendirsel()" /></label>
  <input type="text" class="text" value="<?php echo str_replace('\\','',isset($_GET['chd'])?htmlentities($_GET['chd']):""); ?>"  id="chd" name="chd"/>
 </div>
 <div style="top:52px" class="toolbar">
  <div class='text' id="progress"><div id="progress_value"></div></div>
 </div>
 <?php
$selfil="";
$cnt=0;

foreach($_GET['file'] as $file)
{
  $cnt++;
  $selfil.="<option value='".htmlentities(str_replace('\\','',$_GET['chd']."/$file"),ENT_QUOTES)."'>".
           htmlentities(shorten(str_replace('\\','',$_GET['chd']."/$file")),ENT_QUOTES)."</option>\r\n";
}

echo "<select style='position:absolute;top:78px;margin:0;padding:0px;width:100%;border-width:0;' size='".min(4,$cnt)."' name='files'>\r\n".
      $selfil."\r\n</select>";
?>
 </form>
<div id='inprogress'><img src='theme/hourglass.gif' alt='<?php echo $l_pck_unpacking;?>' title='<?php echo $l_pck_unpacking;?>' /></div>
</body>
</html>
<?php }
} ?>
