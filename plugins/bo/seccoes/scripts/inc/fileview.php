<?php
/*	only supported on php v.5.1 or higher
interface FileView
{
	/*	Prints the whole view out
	@param	$path	Stringpath to browsing directory
			$dirs	Array with all directories
			$files	Array with all containing files	* /
	public function printview($path,$dirs,$files);
	/*	Get the Name of this FileView type
	@param	$lang	Wished language to be returned
	@return	String	Name of this ViewType* /
	public function getFileViewType($lang);
	/*	Get offset from Top where selection can start * /
	public function selectionOffsetY();
} */
$FileViews=array();		// Add here all possible fileview classes
$FileViewsExt=array();	// Add here all possible fileview classes that shall not be loaded in selection

// Load all Views
$path="inc/fileviews/";
$fd=opendir($path);
while($file=readdir($fd) )
	if(is_file($path.$file) )
		include($path.$file);
closedir($fd);
?>