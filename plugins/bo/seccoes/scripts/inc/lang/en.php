<?php
/*MODF:	18:04:00,27.06.07*/

/* @FILE:<this> */
$l_language="English";              //@DESC: Language description
$l_file    =__FILE__;               //@DESC: Absolut path to file; @HANDLE: nedit
$l_shortcuts="en";                  //@DESC: Alpha-2 code of ISO-639-1: Shorthand symbol for language
$l_author  ="Daniel M&auml;der";    //@DESC: Author's name
$l_author_m="";   					//@DESC: Author's email
$l_author_h="";   				    //@DESC: Author's homepage
$l_time="d.m.y H:i";                //@DESC: timeformat
$l_charset="UTF-8";                 //@DESC: Charset

/* @FILE:index.php */
$l_idx_err_jsblk="There might be a JavaScript/Ad-Blocker in use.<br/>To use this application without unexpected events you are advised to disable it."; //@DESC: Message

/* @FILE:address.php */
$l_nav_t        ="Addressbar";                //@DESC: Window title
$l_nav_back     ="back";                      //@DESC: Button
$l_nav_forward  ="forward";                   //@DESC: Button
$l_nav_open_dlm ="open upload manager";       //@DESC: Button
$l_nav_browseUrl="go to this address";        //@DESC: Button
$l_nav_multis_on="enable multiple selection"; //@DESC: Button
$l_nav_multis_of="disable multiple selection";//@DESC: Button
$l_nav_crdir    ="create folder";             //@DESC: Button
$l_nav_search   ="search";                    //@DESC: Button; New:02

/* @FILE:files.php */
$l_fil_t        ="file view";               //@DESC: Window title
$l_fil_fname    ="filename";                //@DESC: Col
$l_fil_fdir     ="folder";                  //@DESC: Col; New:02
$l_fil_atime    ="accessed";                //@DESC: Col
$l_fil_mtime    ="modified";                //@DESC: Col
$l_fil_ctime    ="created";                 //@DESC: Col
$l_fil_fsize    ="size";                    //@DESC: Col
$l_fil_chmod    ="permissions";             //@DESC: Col
$l_fil_asc      ="sort ascending";          //@DESC: Image
$l_fil_dsc      ="sort descending";         //@DESC: Image
$l_fil_download ="download";                //@DESC: Menu item
$l_fil_view_hex ="open with hex-view";      //@DESC: Menu item
$l_fil_view_html="open as website";         //@DESC: Menu item
$l_fil_view_text="open as text";            //@DESC: Menu item
$l_fil_view_dia ="open with slideshow";     //@DESC: Menu item
$l_fil_edit_text="edit as text";            //@DESC: Menu item
$l_fil_opendir  ="open";                    //@DESC: Menu item
$l_fil_preview  ="... loading preview ..."; //@DESC: Image
$l_fil_ren      ="rename";                  //@DESC: Menu item
$l_fil_renPrompt="Please enter new name:";  //@DESC: Prompt
$l_fil_del      ="delete";                  //@DESC: Menu item
$l_fil_del4f_p  ="Do you really want to delete this file '%name%'?";  //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_del4d_p  ="Do you really want to delete this folder '%name%'?";//@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_delall   ="Do you really want to delete all these files?";     //@DESC: Prompt;
$l_fil_cpy      ="copy to...";        //@DESC: Menu item
$l_fil_mov      ="move to...";        //@DESC: Menu item
$l_fil_chm      ="change permissions";//@DESC: Menu item
$l_fil_zipcreate="create ZIP-archive";//@DESC: Menu item
$l_fil_zipextrct="extract ZIP-archiv";//@DESC: Menu item
$l_fil_crdir_pt	="Enter folder name:";//@DESC: Prompt
$l_fil_ndirname	="new folder";        //@DESC: Button
$l_fil_srcname  ="Search";			  //@DESC: Button; New:02
$l_fil_srcpath  ="Path";			  //@DESC: Button; New:02
$l_fil_srcstp   ="Stop";			  //@DESC: Button; New:02

/* @FILE:folder.php */
$l_dvw_t        ="folder view";  //@DESC: Window title

/* @FILE:upload.php */
$l_upl_t        ="upload manager";//@DESC: Window title
$l_upl_expand   ="expand";        //@DESC: Button
$l_upl_collapse ="reduce";        //@DESC: Button

/* @FILE:uploadmod.php */
$l_upm_t        ="upload modul";              //@DESC: Window title
$l_upm_nex_dir  ="Destination folder already exists.";        //@DESC: JS
$l_upm_2bigFsize="File exceeds maximal file size directive."; //@DESC: JS
$l_upm_partly   ="File was only partially uploaded.";         //@DESC: JS
$l_upm_nofile   ="No file was uploaded.";                     //@DESC: JS
$l_upm_nofilemov="Could not move file to destination folder.";//@DESC: JS
$l_upm_ren_file ="The file has been renamed to prevent overwriting another file.";//@DESC: JS
$l_upm_uploading="File is currently being uploaded.";          //@DESC: Image
$l_upm_queueing ="File is in queue.";         //@DESC: Image
$l_upm_savefile ="Upload file";               //@DESC: Button
$l_upm_seldir   ="select destination folder"; //@DESC: Button
$l_upm_infobox  ="Information\n=============";//@DESC: JS
$l_upm_errbox   ="Error\n======";             //@DESC: JS

/* @FILE:foldersel.php */
$l_sld_t        ="select folder";  //@DESC: Window title

/* @FILE:menu.php */
$l_men_inval_img="invalid picture format";              //@DESC: Message
$l_men_no_rename="\"%f\" could not be renamed!";        //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_ren="ACCESS DENIED!\nNo renaming rights."; //@DESC: JS
$l_men_no_delete="\"%f\" could not be deleted,\nthis might be due missing permission,\nanother process is accessing this file or\n this file does not exist (no more)!"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_del="ACCESS DENIED!\nNo deleting rights."; //@DESC: JS
$l_men_block_crd="ACCESS DENIED!\nNo rights do create any folder.";       //@DESC: JS
$l_men_no_crdir ="Could not create folder.";            //@DESC: JS
$l_men_block_mNc="ACCESS DENIED!\nNo rights to copy or move file.";       //@DESC: JS
$l_men_mv_failed="File \"%sfile%\"\ncould not be moved to\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %sfile% => source file; @REPLACE: %dfile% => destination file
$l_men_mv_f_ex  ="Moving without success: Destination file\n\"%dfile%\"\nalready exists.";    //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_mv_d_nex ="Moving without success: Destination folder\n\"%dpath%\"\ndoes not exist.";  //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_mv_f_nex ="Moving without success: Source file\n\"%sfile%\"\ndoes not exist.";         //@DESC: JS
$l_men_cy_failed="File \"%sfile%\"\ncould not be copied to\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_f_ex  ="Copying without success: Destination file\n\"%dfile%\"\nalready exists.";   //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_d_nex ="Copying without success: Destination folder\n\"%dpath%\"\ndoes not exist."; //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_cy_f_nex ="Copying without success: Source file\n\"%sfile%\"\ndoes not exist.";        //@DESC: JS; @REPLACE: %sfile% => source file
$l_men_block_chm="ACCESS DENIED!\\nNo rights to change file permissions.";//@DESC: JS
$l_men_chm_nw   ="Failed while trying to change permissions of '%file%'.";//@DESC: JS; @REPLACE: %file% => file name
$l_men_chm_nex  ="File \"%file%\" does not exist.";     //@DESC: JS; @REPLACE: %file% => file

/* @FILE:chmod.php */
$l_chm_t    ="permission manager"; //@DESC: Window title
$l_chm_r    ="read";    //@DESC: Col
$l_chm_w    ="write";   //@DESC: Col
$l_chm_x    ="execute"; //@DESC: Col
$l_chm_owner="owner";    //@DESC: Row
$l_chm_group="group";   //@DESC: Row
$l_chm_world="others";  //@DESC: Row
$l_chm_save ="save";    //@DESC: Button

/* @FILE:viewer.php */
$l_viw_hx_th_hx ="hexadecimal"; //@DESC: Col
$l_viw_hx_th_tx ="text";        //@DESC: Col
$l_viw_hx_file  ="file";        //@DESC: Description
$l_viw_hx_page  ="page";        //@DESC: Description
$l_viw_hx_hex   ="Hex";         //@DESC: Description
$l_viw_hx_dec   ="Dec";         //@DESC: Description
$l_viw_hx_chr   ="Char";        //@DESC: Description
$l_viw_cp_dia   ="Slideshow";   //@DESC: Description
$l_viw_cp_interv="Interval";    //@DESC: Description
$l_viw_cp_srt   ="start";       //@DESC: Description
$l_viw_cp_end   ="stop";        //@DESC: Description
$l_viw_cp_file  ="file";        //@DESC: Description
$l_viw_er_noread="Can not read from file."; //@DESC: Message; #######NEW

/* @FILE:about:php */
$l_abt_t        ="About %PRGM_N%";        //@DESC: Window title Title; @REPLACE: %PRGM_N% => program name
$l_abt_akt_v    ="Current Version: %PRGM_V%";//@DESC: Message; @REPLACE: %PRGM_V% => program version
$l_abt_new_v_a  ="Most recent version: %v_num% -&gt; %link_start%download%link_stop%";  //@DESC: Message; @REPLACE: %v_num% => new version number; @REPLACE: %link_start% => Downloadlink start; @REPLACE: %link_stop% => Downloadlink end
$l_abt_freew_by ='Freeware by <a href="http://www.bluevirus.ch.vu" target="_blank">bluevirus-design</a>.<br/>Thank to all translators:';  //@DESC: Message
$l_abt_langby   ="%lang% by %name%";       //@DESC: Message; @REPLACE: %lang% => language name; @REPLACE: %name% => author's name


/* @FILE:packer.php */
$l_pck_t          ="Packer";                      //@DESC: Window title
$l_dpck_t         ="Unpacker";                    //@DESC: Window title
$l_pck_unpacking  ="... unpacking ...";           //@DESC: Image  #########NEW
$l_pck_abort_op   ="Cancel ZIP process with following error:"; //@DESC: JS
$l_pck_start2zip  ="Starting ZIP process";        //@DESC: Button
$l_pck_def_zfile  ="ziparchive.zip";              //@DESC: Default input
$l_pck_choose_dir ="choose destination folder";   //@DESC: Button
$l_pck_erno_100   ="OK";                          //@DESC: Message
$l_pck_erno_101   ="No file given.";              //@DESC: Message
$l_pck_erno_102   ="ZIP file points to folder.";  //@DESC: Message
$l_pck_erno_103   ="ZIP file already exist.";     //@DESC: Message
$l_pck_erno_104   ="Can not create ZIP file.";    //@DESC: Message
$l_pck_erno_105   ="ZIP file does not exist.";    //@DESC: Message
$l_pck_erno_106   ="Can not open ZIP file.";      //@DESC: Message
$l_pck_erno_201   ="Invalid file path";           //@DESC: Message
$l_pck_erno_202   ="File/Folder does not exist."; //@DESC: Message
$l_pck_erno_301   ="Invalid path to ZIP file.";   //@DESC: Message
$l_pck_erno_302   ="ZIP file contains unknown/invalid archiv."; //@DESC: Message
$l_pck_erno_303   ="Invalid destination path.";   //@DESC: Message
$l_pck_erno_304   ="Can not create destination folder.";  //@DESC: Message
$l_pck_erno_401   ="Can not create file structure.";      //@DESC: Message
$l_pck_erno_999   ="Finished with some errors";   //@DESC: Message


/* @FILE:editor.php */
$l_edt_but_save   ="Save";                          // @DESC: Button; New:01
$l_edt_txt_t      ="text editor";                   // @DESC: Window title; New:01
$l_edt_err_nodata ="Document could not be loaded."; //@DESC: Message; New:01
$l_edt_txt_fname  ="Document";                      // @DESC: Message: New:01
$l_edt_err_ns_tmp ="Unable to save: Temporary file could not be accessed."; //@DESC: Message: New:01
$l_edt_err_ns_mov ="Unable to save: Can not move temporary file.";  //@DESC: Message: New:01
$l_edt_err_ns_unlk="Unable to save: Can not delete old file.";      //@DESC: Message: New:01
$l_edt_err_gl_noac="Unable to load document: access denied.";       //@DESC: Message: New:01
?>