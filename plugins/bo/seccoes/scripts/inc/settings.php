<?php
/*MODF: 08:54:00,10.07.07*/

/*  Set your (relative/absolute) path, you wish to browser from.
  i.e.: "/../../test", "example_dir", "C:/Program Files/www", "../../" . 'C:/' does not work */
$c_path='../../../../uploads';

/*  Error reporting. Visit http://ch2.php.net/manual/en/function.error-reporting.php for more informations.*/
error_reporting(0);   	  //  If noone should see any errors  ->  error_reporting(0);
                          //  If you want to see the errors   ->  error_reporting(E_ALL);

/*  Language Settings */
$c_language="pt";         //  Sets the standard language, that will be used if no other fits to wished one submit by browser.
                          //  If you want a specific language to be shown, delete all the other language files or change submit
                          //  language in browser and delete cookie. - Make your own file according to '/inc/lang/en.php' .

/*  Setting File Permissions */
$f_show_hidden_files=true;      //  Set to display hidden UNIX files (all those files who begining with a point)
$f_show_hidden_winfiles=true;   //  Set to display hidden files ( WORKS ON WINDOWS SYSTEMS ONLY!!), does not work in Save-Mode or if shell_exec() is disabled
$f_filesize_alternativ=false;    //  Use alternative method to get filesize, does not work on UNIX if in Save-Mode or if shell_exec()'s are disabled.
								//	Recommended to be enabled for files higher than 2 (4) GB on 32 (64) bit processors.
$f_right_to_rename=true;        //  Set permission to rename files/folders
$f_right_to_delete=true;        //  Set permission to delete files/folders
$f_right_to_crdir =true;        //  Set permission to create direcotries
$f_right_to_moveNcopyto=true;   //  Set permission to move/copy files. It also make no sense to enable this but disable renaming option.
$f_right_to_chmod=true;         //  Set permission to use chmod command (change file mode), may not work correctly on windows machines
$f_right_to_upload=true;        //  Set permission to upload files
$f_max_upload_size=20*1024*1024; //  Max filesize in Bytes, 20 MB = 20*1024*1024


/* It might be good but not absolutely necessary, if yout check the following variables in php.ini file:
  max_execution_time  ->  value in seconds: set it high enough (time client needs to upload file)
  max_input_time      ->  value in seconds: set it high enough (time client needs to upload file)
  file_uploads        ->  set it high enough, at lest $f_max_upload_size
  upload_max_filesize ->  set it high enough, at lest $f_max_upload_size
  memory_limit        ->  (as above)
  post_max_size       ->  (as above)
*/

/*  Zip Function */
$f_right_to_zip=true;     //  Set permission to zip. Attention: Is not depending on other rights

/*  Clip/Thumbnail settings	*/
$c_cache_enable=true;     //  En/disables cache
$c_cache_path=dirname(dirname(__FILE__)).'/tmp';  //  Absolute! path to folder where to save cached images. Must be valid and writable even if caching is disabled
$c_imagemodul=true;       //  If there is the graphic library for php (GD-Lib) installed and you wish to see preview pictures set true
$c_video2img=true;        //  If GD and ffmpeg extension is installed you can enable preview
$c_video_ext=array(".avi",".mpg",".mpeg",".asf",".flv",".rmv",".rm",".mov",".qkt",".mp4",".tiff",".mjpeg",".wmv",".vob",".flv");
                          //  All Extensions that can/should be handled by video modul (ffmpeg)
$c_bmp2img=true;          //  If you wish to have clips of .bmp too (seperated because this function may be quite slow)
$c_fileview_thb_w=96;     //  Thumbnail width in clip view, minimal 48
$c_fileview_thb_h=96;     //  Thumbnail height in clip view, minimal 48
$c_menu_img_w   =144;     //  Image width in fileinfo menu , maximal 198
$c_menu_img_h   =144;     //  Image height in fileinfo menu, maximal 198
$c_show_w       =800;     //  Max. width in px in image viewer
$c_show_h       =600;     //  Max. height in px in image viewer

/*  Imagemagick - Thumbnails */
$c_ick2image      =true;  //  Enable preview of pdf files,set to true //TIFF, JPEG, PNG, PDF, and SVG.
$c_ick_ext		  =array(".tif",".tiff",".pdf",".svg",/*".bmp",*/".pcx",".tga",".ai",".ps");
$c_ick2img_timeout=25;    //  Maximal time to wait for generated picture in seconds
$c_ick2img_retry  =6;     //  Each X seconds the scripts retries to execute the batch again
  /* execution command to convert:  %INPUT% is input file and %OUTPUT% is output file
     In this example I used the freely available 'convert' from ImageMagick library see http://www.imagemagick.org */
$c_ick2img_exec='convert  -quiet -resize %WIDTH%x%HEIGHT% -border 1x1 -bordercolor "grey" -sharpen 10 "%INPUT%"[0] "%OUTPUT%"';  
						  // this line may only work one UNIX machines. It's for getting a callback from ick2img convertion program
	// To make it work "out of the box" I've add this Windows-Only exceptions, just modify path. Path with whitespaces may not work!
if( isset($_SERVER['WINDIR']) )
	$c_ick2img_exec='C:/Programme/ImageMagick-6.3.6-Q16/convert.exe -quiet -resize %WIDTH%x%HEIGHT% -border 1x1 -bordercolor "grey" -sharpen 10 "%INPUT%"[0] "%OUTPUT%"';

$c_ick2img_abrtOnMsg="convert:"; //Aborting on receiving message containing this string

/*  View files */
$c_view_files          =true; //  View files with hex or other viewers
$c_view_text_maxsize_kb=2;    //  Maximal sizes to send from a text document in html viewer, in kilobytes
$c_view_html_maxsize_kb=100;  //  Maximal sizes to send from a html document in html viewer, in kilobytes
$c_view_html_ext       =Array( ".html",".htm",".htx");  // Filetypes to open with html viewer
$c_view_text_ext       =Array('.txt','.log','.ini','.php','.c','.cpp','.java','.h','.htm','.html', '.js', '.sh','.svg','.css');

/* Edit files */
$c_edit_files          =true; //  Enables to edit files
$c_edit_txt_ext        =$c_view_text_ext; // Filetypes to edit with text editor

/* Suche */
$c_srch_enabled        =true;	// Allow to search for files?

/*  Menu Settings */
$menu_color_dec=Array(239,235,222); //  Set the background color for the thumbnail picture (used with .gif's) in decimals (Array(r,g,b))
$menu_color_error="#999999";        //  Set the image stream error color
$menu_color_hex="#ccf";             //  Background color that will be used in some apps
$menu_clip_quality=80;              //  Set the quality of thumbnail jpeg
$menu_doubleclicktime_ms=200;       //  If you really think this needs a change, change it!
                                    //  Set's how long a doubleclick more or less lasts generelly. After that amount of time the
                                    //  menu is displayed. Due to compatibility reasons don't set this value to short.

/*  Password protection start */
/*  If you are planning to have a password protection (not based on links, but possibly 
    on cookies... whatever) you can add it here.
     Like: */
//include_once('inc/pwdcheck.php');
/*  Password protection end */

include("data.php");
?>