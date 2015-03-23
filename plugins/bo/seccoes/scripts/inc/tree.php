<?php
$TreeDirCount=0;

class TreeDir
{
  var $isopen=false;      //  Is Directory open?
  var $islast=false;      //
  var $name;              //  Dir Name
  var $path;              //  Path, relative only, no full path information
  var $depth=array();     //  Depth struktur to this folder: 1|0|1|0 -> 1= | , 0=  ;
  var $haschildren=false; //  Are there any subdirs in folder?
  var $children=array();  //  Subpath
  
  function TreeDir($opendirs=array(),$path=t_c_folder,$islast=true ,$depth=array())
  {		
    $this->path=$path;
    $this->name=basename($path);
    $this->depth=$depth;
    $this->islast=$islast;
    
    if( in_array($path,$opendirs) )
      $this->isopen=true;

    //	Find out if there are any subfolders
    $basepath=t_folder."/$this->path";
    $fd=@opendir($basepath);

    $subdirs=array();
    while($fd && $file=readdir($fd) )
    {
      if( $file!=".." && $file!="." && is_dir("$basepath/$file") && f_show_hidden_file("$basepath/$file") )
        $subdirs[]=$file;
    }
    //	Save result
    $this->haschildren=(count($subdirs)>=1);

    if($this->isopen)
    {
      natcasesort($subdirs);
      $c=0;
      foreach($subdirs as $dir)
      {
        $c++;
        $this->children[]=new TreeDir($opendirs,"$this->path/$dir",($c==count($subdirs)),array_merge($this->depth,array(!$islast) ) );
      }
    }
  }
  
  
  function printtree($selel=NULL)
  {
    global $TreeDirCount;
    foreach($this->depth as $c)
      echo "<img src='theme/".($c?"netzI.gif":"leer.gif")."' alt=''/>";
    echo "<img ".($this->haschildren?'onclick="expanddir(\''.string2jscode($this->path).'\');" ':'').
          "src='theme/netz".($this->islast?"u":"m").($this->haschildren?($this->isopen?"-":"+"):"").".gif' alt=''/>".
          "<a onmouseover='drag_select(\"".string2jscode($this->path)."\");' onmouseout='drag_deselect()' href='javascript:opendir(\"".string2jscode($this->path)."\",$TreeDirCount)' ondblclick='selectdir(\"".
          string2jscode($this->path)."\",$TreeDirCount)'><img src='theme/folderc.gif' alt=''/><span id='fn_sp_".($TreeDirCount++)."' class='foldername".
          ( $selel==$this->path?" marked":"")."'>".htmlentities($this->name)."</span></a><br/>";
    foreach($this->children as $child)
      $child->printtree($selel); 
  }
}
?>