<?php
/*MODF:	18:04:00,27.06.07*/

/* @FILE:<this> */
$l_language="Portugu&ecirc;s";              //@DESC: Language description
$l_file    =__FILE__;               //@DESC: Absolut path to file; @HANDLE: nedit
$l_shortcuts="pt";                  //@DESC: Alpha-2 code of ISO-639-1: Shorthand symbol for language
$l_author  ="Daniel M&auml;der";    //@DESC: Author's name
$l_author_m="";   					//@DESC: Author's email
$l_author_h="";   				    //@DESC: Author's homepage
$l_time="d.m.y H:i";                //@DESC: timeformat
$l_charset="UTF-8";                 //@DESC: Charset

/* @FILE:index.php */
$l_idx_err_jsblk="Poder&aacute; exister um bloqueador de JavaScript/Ad-Blocker em uso.<br/>Para usar esta aplica&ccedil;&atilde;o sem precal&ccedil;os &eacute; aconselh&aacute;vel desactiv&aacute;-lo."; //@DESC: Message

/* @FILE:address.php */
$l_nav_t        ="Barra de Endere&ccedil;os";                //@DESC: Window title
$l_nav_back     ="anterior";                      //@DESC: Button
$l_nav_forward  ="seguinte";                   //@DESC: Button
$l_nav_open_dlm ="abrir gestor de uploads";       //@DESC: Button
$l_nav_browseUrl="ir para este endere&ccedil;o";        //@DESC: Button
$l_nav_multis_on="activar selec&ccedil;&atilde;o m&uacute;ltipla"; //@DESC: Button
$l_nav_multis_of="desactivar selec&ccedil;&atilde;o m&uacute;ltipla";//@DESC: Button
$l_nav_crdir    ="criar pasta";             //@DESC: Button
$l_nav_search   ="procurar";                    //@DESC: Button; New:02

/* @FILE:files.php */
$l_fil_t        ="vista de ficheiros";               //@DESC: Window title
$l_fil_fname    ="nome de ficheiro";                //@DESC: Col
$l_fil_fdir     ="pasta";                  //@DESC: Col; New:02
$l_fil_atime    ="acedido";                //@DESC: Col
$l_fil_mtime    ="modificado";                //@DESC: Col
$l_fil_ctime    ="criado";                 //@DESC: Col
$l_fil_fsize    ="tamanho";                    //@DESC: Col
$l_fil_chmod    ="permiss&otilde;es";             //@DESC: Col
$l_fil_asc      ="colocar por ordem ascendente";          //@DESC: Image
$l_fil_dsc      ="colocar por ordem descendente";         //@DESC: Image
$l_fil_download ="download";                //@DESC: Menu item
$l_fil_view_hex ="abrir com vista-hex";      //@DESC: Menu item
$l_fil_view_html="abrir como website";         //@DESC: Menu item
$l_fil_view_text="abrir como textp";            //@DESC: Menu item
$l_fil_view_dia ="abrir com slideshow";     //@DESC: Menu item
$l_fil_edit_text="editar como texto";            //@DESC: Menu item
$l_fil_opendir  ="abrir";                    //@DESC: Menu item
$l_fil_preview  ="... a carregar preview ..."; //@DESC: Image
$l_fil_ren      ="renomear";                  //@DESC: Menu item
$l_fil_renPrompt="Introduza o novo nome:";  //@DESC: Prompt
$l_fil_del      ="eliminar";                  //@DESC: Menu item
$l_fil_del4f_p  ="Deseja eliminar o ficheiro '%name%'?";  //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_del4d_p  ="Deseja eliminar a pasta '%name%'?";//@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_delall   ="Deseja eliminar todos estes ficheiros?";     //@DESC: Prompt;
$l_fil_cpy      ="copiar para...";        //@DESC: Menu item
$l_fil_mov      ="mover para...";        //@DESC: Menu item
$l_fil_chm      ="mudar permiss&otilde;es";//@DESC: Menu item
$l_fil_zipcreate="criar arquivo ZIP";//@DESC: Menu item
$l_fil_zipextrct="extrair arquivo ZIP";//@DESC: Menu item
$l_fil_crdir_pt	="Introduza o nome da pasta:";//@DESC: Prompt
$l_fil_ndirname	="nova pasta";        //@DESC: Button
$l_fil_srcname  ="Procurar";			  //@DESC: Button; New:02
$l_fil_srcpath  ="Caminho";			  //@DESC: Button; New:02
$l_fil_srcstp   ="Parar";			  //@DESC: Button; New:02

/* @FILE:folder.php */
$l_dvw_t        ="vista de pastas";  //@DESC: Window title

/* @FILE:upload.php */
$l_upl_t        ="gestor de uploads";//@DESC: Window title
$l_upl_expand   ="expandir";        //@DESC: Button
$l_upl_collapse ="reduzir";        //@DESC: Button

/* @FILE:uploadmod.php */
$l_upm_t        ="m&oacute;dulo de upload";              //@DESC: Window title
$l_upm_nex_dir  ="Pasta de destino j&aacute; existe.";        //@DESC: JS
$l_upm_2bigFsize="O ficheiro excede o tamanho m&aacute;ximo."; //@DESC: JS
$l_upm_partly   ="O upload de ficheiro foi apenas parcial.";         //@DESC: JS
$l_upm_nofile   ="N&atilde;o houve upload de ficheiro.";                     //@DESC: JS
$l_upm_nofilemov="N&atilde;o foi possivel mover o ficheiro para a pasta de destino.";//@DESC: JS
$l_upm_ren_file ="O ficheiro foi renomeado para prevenir a substitui&ccedil;&atilde;o de outro ficheiro.";//@DESC: JS
$l_upm_uploading="Upload de ficheiro a decorrer.";          //@DESC: Image
$l_upm_queueing ="O ficheriro est&aacute; em fila.";         //@DESC: Image
$l_upm_savefile ="Upload de ficheiro";               //@DESC: Button
$l_upm_seldir   ="Seleccione pasta de destino"; //@DESC: Button
$l_upm_infobox  ="Informa&ccedil;&atilde;o\n=============";//@DESC: JS
$l_upm_errbox   ="Erro\n======";             //@DESC: JS

/* @FILE:foldersel.php */
$l_sld_t        ="seleccione pasta";  //@DESC: Window title

/* @FILE:menu.php */
$l_men_inval_img="formato de imagem inv&aacute;lido";              //@DESC: Message
$l_men_no_rename="\"%f\" n&atilde;o pode ser renomeado!";        //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_ren="ACESSO NEGADO!\nSem direitos de renomea&ccedil;&atilde;o."; //@DESC: JS
$l_men_no_delete="\"%f\" n&atilde;o pode ser eliminado,\npode ter a ver com as permiss&otilde;es,\noutro processo estar a aceder ao ficheiro ou\n este ficheiro n&atilde;o existe (mais)!"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_del="ACESSO NEGADO!\nSem direitos de elimina&ccedil;&atilde;o."; //@DESC: JS
$l_men_block_crd="ACESSO NEGADO!\nSem direitos para criar qualquer pasta.";       //@DESC: JS
$l_men_no_crdir ="N&atilde;o conseguiu criar pasta.";            //@DESC: JS
$l_men_block_mNc="ACESSO NEGADO!\nSem direitos para copiar ou mover ficheiro.";       //@DESC: JS
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
$l_edt_but_save   ="Salvar";                          // @DESC: Button; New:01
$l_edt_txt_t      ="Editor de texto";                   // @DESC: Window title; New:01
$l_edt_err_nodata ="Document could not be loaded."; //@DESC: Message; New:01
$l_edt_txt_fname  ="Document";                      // @DESC: Message: New:01
$l_edt_err_ns_tmp ="Unable to save: Temporary file could not be accessed."; //@DESC: Message: New:01
$l_edt_err_ns_mov ="Unable to save: Can not move temporary file.";  //@DESC: Message: New:01
$l_edt_err_ns_unlk="Unable to save: Can not delete old file.";      //@DESC: Message: New:01
$l_edt_err_gl_noac="Unable to load document: access denied.";       //@DESC: Message: New:01
?><?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
