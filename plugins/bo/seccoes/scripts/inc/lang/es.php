<?php
/*MODF:	18:04:00,22.08.07*/

/* @FILE:<this> */
$l_language="Spanish";                //@DESC: Language description
$l_file    =__FILE__;                 //@DESC: Absolut path to file; @HANDLE: nedit
$l_shortcuts="es";                    //@DESC: Shorthand symbol for language
$l_author  ="Isma De Andres Presa";   //@DESC: Author's name
$l_author_m="isma.deandres@gmail.com";//@DESC: Author's email
$l_author_h="www.pormiswebs.com";     //@DESC: Author's homepage
$l_time="d.m.y H:i";                  //@DESC: timeformat
$l_charset="UTF-8";                   //@DESC: Charset

/* @FILE:index.php */
$l_idx_err_jsblk="Puede que tenga activado un Bloqueador de JavaScript o de publicidad.<br/>Para poder usar esta aplicación sin inesperados problemas se recomienda que lo desactive."; //@DESC: Message

/* @FILE:address.php */
$l_nav_t        ="Barra de Direcciones";       //@DESC: Window title
$l_nav_back     ="Atr&aacute;s";               //@DESC: Button
$l_nav_forward  ="Adelante";                   //@DESC: Button
$l_nav_open_dlm ="Abrir gestor de descargas";  //@DESC: Button
$l_nav_browseUrl="ir a esta direcci&oacute;n"; //@DESC: Button
$l_nav_multis_on="Habilitar la selecci&oacute;n m&uacute;ltiple";   //@DESC: Button
$l_nav_multis_of="Deshabilitar la selecci&oacute;n m&uacute;ltiple";//@DESC: Button
$l_nav_crdir    ="Nueva carpeta";              //@DESC: Button
$l_nav_search   ="buscar";      			   //@DESC: Button; New:02

/* @FILE:files.php */
$l_fil_t        ="Vista de archivo";      //@DESC: Window title
$l_fil_fname    ="Nombre";                //@DESC: Col
$l_fil_atime    ="accedido";              //@DESC: Col
$l_fil_fdir     ="carpeta";     		  //@DESC Row; New:02
$l_fil_mtime    ="modificado";            //@DESC: Col
$l_fil_ctime    ="creado";                //@DESC: Col
$l_fil_fsize    ="tamano";                //@DESC: Col
$l_fil_chmod    ="permisos";              //@DESC: Col
$l_fil_asc      ="orden ascendente";      //@DESC: Image
$l_fil_dsc      ="orden descendente";     //@DESC: Image
$l_fil_download ="descargar";             //@DESC: Menu item
$l_fil_view_hex ="abrir con el visor de hexadecimal";      //@DESC: Menu item
$l_fil_view_html="abrir como p&acute;gina web";         //@DESC: Menu item
$l_fil_view_text="abrir como archivo texto";            //@DESC: Menu item
$l_fil_view_dia ="abrir con slideshow";     //@DESC: Menu item
$l_fil_edit_text="editar como texto";            //@DESC: Menu item; New:01
$l_fil_opendir  ="abrir";                    //@DESC: Menu item
$l_fil_preview  ="... cargando vista preliminar ..."; //@DESC: Image
$l_fil_ren      ="renombrar";                  //@DESC: Menu item
$l_fil_renPrompt="Por favor introduzca su nombre:";  //@DESC: Prompt
$l_fil_del      ="eliminar";                  //@DESC: Menu item
$l_fil_del4f_p  ="Est&aacute; seguro de que quiere eliminar el archivo '%name%'?";  //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_del4d_p  ="Est&aacute; seguro de que quiere eliminar la carpeta '%name%'?";//@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_delall   ="Est&aacute; seguro de que quiere eliminar todos estos archivos?";     //@DESC: Prompt;
$l_fil_cpy      ="copiar a...";        //@DESC: Menu item
$l_fil_mov      ="mover a...";        //@DESC: Menu item
$l_fil_chm      ="cambiar permisos";//@DESC: Menu item
$l_fil_zipcreate="crear archivo-ZIP";//@DESC: Menu item
$l_fil_zipextrct="extraer archivo-ZIP";//@DESC: Menu item
$l_fil_crdir_pt	="Introduzca el nombre de la carpeta:";//@DESC: Prompt
$l_fil_ndirname	="Nueva carpeta";        //@DESC: Button
$l_fil_srcname  ="buscar";      		//@DESC: Button; New:02
$l_fil_srcpath  ="ruta";        		//@DESC: Button; New:02
$l_fil_srcstp   ="detener";        		//@DESC: Button; New:02

/* @FILE:folder.php */
$l_dvw_t        ="vista de carpeta";  //@DESC: Window title

/* @FILE:upload.php */
$l_upl_t        ="gestor de subidas";//@DESC: Window title
$l_upl_expand   ="expandir";        //@DESC: Button
$l_upl_collapse ="reducir";        //@DESC: Button

/* @FILE:uploadmod.php */
$l_upm_t        ="m&oacute;dulo de subida";              //@DESC: Window title
$l_upm_nex_dir  ="La carpeta de destino ya existe.";        //@DESC: JS
$l_upm_2bigFsize="El archivo supera el tamano de fichero permitido por la directiva."; //@DESC: JS
$l_upm_partly   ="El archivo no fue completamente subido.";         //@DESC: JS
$l_upm_nofile   ="No se ha subido ning&uacute; archivo.";                     //@DESC: JS
$l_upm_nofilemov="No se puede mover el archivo a la carpeta destino.";//@DESC: JS
$l_upm_ren_file ="El archivo ha sido renombrado para evitar que sobreescriba a otro archivo.";//@DESC: JS
$l_upm_uploading="El archivo se est&aacute; subiendo.";          //@DESC: Image
$l_upm_queueing ="El archivo se encuentra en la cola.";         //@DESC: Image
$l_upm_savefile ="Subir archivo";               //@DESC: Button
$l_upm_seldir   ="seleccione la carpeta destino"; //@DESC: Button
$l_upm_infobox  ="Informaci&oacute;n\n=============";//@DESC: JS
$l_upm_errbox   ="Error\n======";             //@DESC: JS

/* @FILE:foldersel.php */
$l_sld_t        ="selecci&oacute;n de carpeta";  //@DESC: Window title

/* @FILE:menu.php */
$l_men_inval_img="Formato de imagen incorrecto";              //@DESC: Message
$l_men_no_rename="\"%f\" no ha podido ser renombrado!";        //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_ren="ACCESO DENEGADO!\nNo tiene permisos para renombrar."; //@DESC: JS
$l_men_no_delete="\"%f\" no ha podido ser borrado,\nesto puede deberse a los permisos,\na que otro proceso est&aacute; accediendo al archivo o\n que este archivo no exista!"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_del="ACCESO DENEGADO!\nNo tiene permisos para eliminar."; //@DESC: JS
$l_men_block_crd="ACCESO DENEGADO!\nNo tiene permisos para crear carpetas.";       //@DESC: JS
$l_men_no_crdir ="No se ha podido crear la carpeta.";            //@DESC: JS
$l_men_block_mNc="ACCESO DENEGADO!\nNo tiene permisos para copiar o mover archivos.";       //@DESC: JS
$l_men_mv_failed="El archivo \"%sfile%\"\nno ha podido ser movido a \n\"%dfile%\"."; //@DESC: JS; @REPLACE: %sfile% => source file; @REPLACE: %dfile% => destination file
$l_men_mv_f_ex  ="No se ha movido correctamente: El archivo destino\n\"%dfile%\"\nya existe.";    //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_mv_d_nex ="No se ha movido correctamente: La carpeta destino\n\"%dpath%\"\nno existe.";  //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_mv_f_nex ="No se ha movido correctamente: El archivo a copiar\n\"%sfile%\"\nno existe.";         //@DESC: JS
$l_men_cy_failed="El archivo \"%sfile%\"\nno ha podido ser copiado a\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_f_ex  ="No se ha podido copiar: El archivo destino\n\"%dfile%\"\nya existe.";   //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_d_nex ="No se ha podido copiar: La carpeta destino\n\"%dpath%\"\nno existe."; //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_cy_f_nex ="No se ha podido copiar: El archivo origen\n\"%sfile%\"\nno existe.";        //@DESC: JS; @REPLACE: %sfile% => source file
$l_men_block_chm="ACCESO DENEGADO!\\nNo tiene permisos para cambiar los permisos de archivos.";//@DESC: JS
$l_men_chm_nw   ="Fallo al intentar cambiar los permisos de '%file%'.";//@DESC: JS; @REPLACE: %file% => file name
$l_men_chm_nex  ="El archivo \"%file%\" no existe.";     //@DESC: JS; @REPLACE: %file% => file

/* @FILE:chmod.php */
$l_chm_t    ="gestor de permisos"; //@DESC: Window title
$l_chm_r    ="leer";    //@DESC: Col
$l_chm_w    ="escribir";   //@DESC: Col
$l_chm_x    ="ejecuci&oacute;n"; //@DESC: Col
$l_chm_owner="propietario";    //@DESC: Row
$l_chm_group="grupo";   //@DESC: Row
$l_chm_world="otros";  //@DESC: Row
$l_chm_save ="guardar";    //@DESC: Button

/* @FILE:viewer.php */
$l_viw_hx_th_hx ="hexadecimal"; //@DESC: Col
$l_viw_hx_th_tx ="texto";        //@DESC: Col
$l_viw_hx_file  ="archivo";        //@DESC: Description
$l_viw_hx_page  ="p&aacute;gina";        //@DESC: Description
$l_viw_hx_hex   ="Hex";         //@DESC: Description
$l_viw_hx_dec   ="Dec";         //@DESC: Description
$l_viw_hx_chr   ="Caracter";        //@DESC: Description
$l_viw_cp_dia   ="Slideshow";   //@DESC: Description
$l_viw_cp_interv="Intervalo";    //@DESC: Description
$l_viw_cp_srt   ="iniciar";       //@DESC: Description
$l_viw_cp_end   ="parar";        //@DESC: Description
$l_viw_cp_file  ="archivo";        //@DESC: Description
$l_viw_er_noread="No se puede el archivo."; //@DESC: Message; #######NEW

/* @FILE:about:php */
$l_abt_t        ="Acerca de %PRGM_N%";        //@DESC: Window title Title; @REPLACE: %PRGM_N% => program name
$l_abt_akt_v    ="Current Version: %PRGM_V%";//@DESC: Message; @REPLACE: %PRGM_V% => program version
$l_abt_new_v_a  ="Most recent version: %v_num% -&gt; %link_start%download%link_stop%";  //@DESC: Message; @REPLACE: %v_num% => new version number; @REPLACE: %link_start% => Downloadlink start; @REPLACE: %link_stop% => Downloadlink end
$l_abt_freew_by ='Freeware by <a href="http://www.bluevirus.ch.vu" target="_blank">bluevirus-design</a>.<br/>Thank to all translators:';  //@DESC: Message
$l_abt_langby   ="%lang% by %name%";       //@DESC: Message; @REPLACE: %lang% => language name; @REPLACE: %name% => author's name


/* @FILE:packer.php */
$l_pck_t          ="Packer";                      //@DESC: Window title
$l_dpck_t         ="Unpacker";                    //@DESC: Window title
$l_pck_unpacking  ="... unpacking ...";           //@DESC: Image
$l_pck_abort_op   ="Cancel ZIP process with following error:"; //@DESC: JS
$l_pck_start2zip  ="Starting ZIP process";        //@DESC: Button
$l_pck_def_zfile  ="ziparchive.zip";              //@DESC: Default input
$l_pck_choose_dir ="elija la carpeta destino";   //@DESC: Button
$l_pck_erno_100   ="OK";                          //@DESC: Message
$l_pck_erno_101   ="No se ha selecciona archivos.";              //@DESC: Message
$l_pck_erno_102   ="ZIP file points to folder.";  //@DESC: Message
$l_pck_erno_103   ="El archivo ZIP ya existe.";     //@DESC: Message
$l_pck_erno_104   ="No se puede crear el archivo ZIP.";    //@DESC: Message
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
$l_edt_but_save   ="Guardar";                          // @DESC: Button; New:01
$l_edt_txt_t      ="editor texto";                   // @DESC: Window title; New:01
$l_edt_err_nodata ="No se ha podido cargar el documento."; //@DESC: Message; New:01
$l_edt_txt_fname  ="Documento";                      // @DESC: Message: New:01
$l_edt_err_ns_tmp ="No se ha podido guardar: No se ha podido acceder al archivo temporal."; //@DESC: Message: New:01
$l_edt_err_ns_mov ="No se ha podido guardar: No se puede mover al directorio temporal.";  //@DESC: Message: New:01
$l_edt_err_ns_unlk="No se ha podido guardar: No se puede eliminar el anterior archivo.";      //@DESC: Message: New:01
$l_edt_err_gl_noac="No se ha podido cargar el documento: acceso denegado.";       //@DESC: Message: New:01
?>