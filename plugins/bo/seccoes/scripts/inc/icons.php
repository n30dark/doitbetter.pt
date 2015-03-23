<?php 
/*MODF:	22:15:00,14.03.07*/

function give_filetype_image($filename,$path)
{
	if(is_dir($path."/".$filename) )
		return "dir";
	switch ( strtolower(substr($filename,strrpos($filename,".")+1 )) )
	{
		/* Picturefiles	*/
		case "tif" :
		case "cpt" :
			return "cpt";
		/* Picturefiles with clips	*/
		case "bmp" :
			return "bmp";
		case "gif" :
			return "gif";
		case "jpg" :
		case "jpeg" :
			return "jpg";
		case "png" :
			return "png";			
		
		/* Soundfiles	*/
		case "mp2" :
		case "mp3" :
		case "snd" :
		case "wav" :
		case "wma" :
			return "snd";
		
		/* Moviefiles	*/
		case "avi" :
		case "asf" :
		case "divx" :
		case "dvx" :
		case "flc" :
		case "mov" :
		case "mp4" :
		case "mpg" :
		case "mpv" :
		case "vob" :
		case "wmv" :
			return "flick";
		case "rmm" :
		case "rm" :
			return "real";
			
		/* Web Files */
		case "asp" :
			return "asp";
		case "html" :
		case "htm" :
		case "htx" :
			return "html";
		case "php" :
			return "php";
		case "xmp" :
			return "xml";
		
			
		/* Office */
		case "doc" :
		case "dot" :
			return "doc";
		case "pws" :
		case "pps" :
		case "ppt" :
			return "pws";
		case "xls" :
			return "xls";
		case "pdf" :
			return "pdf";
		case "mdb" :
			return "mdb";
    case 'odt' :
      return 'odt';
    case 'ods' :
      return 'ods';
    case 'odp' :
      return 'odp';
    case 'odg' :
      return 'odg';
    
		/* C, C++, Java, Executables, SWF*/
		case "cpp"	:
		case "c"	:
			return "cpp";
		case "h":
			return "h";
		case "jar" :
		case "java" :
			return "java";	
		case "exe" :
		case "bat" :
		case "com" :
			return "exe";
		case "rc" :
			return "rc";
		case "sln" :
			return "sln";
		case "vcproj" :
			return "vcproj";
		case "swf" :
			return "swf";
		case "ncb" :
			return "ncb";
			
		/* Compression */
		case "rar" :
			return "rar";
		case "zip" :
		case "gz" :
		case "tar" :
		case "cab" :
			return "zip";
			
		
		
		
		case "txt":
			return "txt";
			
			
		default :
			return "file";
	}
}
?>