<?php
/*MODF: 08:54:00,10.07.07*/

/* @FILE:<this> */
$l_language="Deutsch";              //@DESC: Language description
$l_file    =__FILE__;               //@DESC: Absolut path to file; @HANDLE: nedit
$l_shortcuts="de";                  //@DESC: Alpha-2 code of ISO-639-1: Shorthand symbol for language
$l_author  ="Daniel M&auml;der";    //@DESC: Author's name
$l_author_m="";   					//@DESC: Author's email
$l_author_h="";   				    //@DESC: Author's homepage
$l_time="d.m.y H:i";                //@DESC: timeformat
$l_charset="UTF-8";                 //@DESC: Charset

/* @FILE:index.php */
$l_idx_err_jsblk="Es ist ein JavaScript/Ad-Blocker im Einsatz.<br/>Um dieses Anwendung nutzen zu k&ouml;nnen, muss dieser jedoch ausgeschaltet werden um unvorhergesehene Ereignisse zu verhindern."; //@DESC: Message

/* @FILE:address.php */
$l_nav_t        ="Adresszeile";                 //@DESC: Window
$l_nav_back     ="zur&uuml;ck";                 //@DESC: Button
$l_nav_forward  ="vorw&auml;rts";               //@DESC: Button
$l_nav_open_dlm ="Uploadmanager &ouml;ffnen";   //@DESC: Button
$l_nav_browseUrl="zu dieser Adresse springen";  //@DESC: Button
$l_nav_multis_on="Mehrfachauswahl aktivieren";  //@DESC: Button
$l_nav_multis_of="Mehrfachauswahl deaktivieren";//@DESC: Button
$l_nav_crdir    ="Ordner erstellen";            //@DESC: Button
$l_nav_search   ="Suche";                       //@DESC: Button; New:02

/* @FILE:files.php */
$l_fil_t        ="Dateien";                     //@DESC: Window
$l_fil_fname    ="Dateiname";                   //@DESC: Col
$l_fil_fdir     ="Ornder";                      //@DESC: Row; New:02
$l_fil_atime    ="Letzter Zugriff";             //@DESC: Col
$l_fil_mtime    ="Ge&auml;ndert am";            //@DESC: Col
$l_fil_ctime    ="Erstellt";                    //@DESC: Col
$l_fil_fsize    ="Gr&ouml;sse";                 //@DESC: Col
$l_fil_chmod    ="Zugriffsrechte";              //@DESC: Col
$l_fil_asc      ="Aufsteigend sortieren";       //@DESC: Image
$l_fil_dsc      ="Absteigend sortieren";        //@DESC: Image
$l_fil_download ="Download";                    //@DESC: Menu item
$l_fil_view_hex ="Hex-Anzeige &ouml;ffnen";     //@DESC: Menu item
$l_fil_view_html="Als Webseite anzeigen";       //@DESC: Menu item
$l_fil_view_text="Text anzeigen";               //@DESC: Menu item
$l_fil_view_dia ="Mit Dia-Anzeige &ouml;ffnen"; //@DESC: Menu item
$l_fil_edit_text="Text editieren";              //@DESC: Menu item
$l_fil_opendir  ="&Ouml;ffnen";                 //@DESC: Menu item
$l_fil_preview  ="... lade Vorschau ...";       //@DESC: Image
$l_fil_ren      ="Umbennenen";                  //@DESC: Menu item
$l_fil_renPrompt="Bitte neuen Namen eingeben:"; //@DESC: Prompt
$l_fil_del      ="L&ouml;schen";                //@DESC: Menu item
$l_fil_del4f_p  ="Soll die Datei '%name%' wirklich gel&ouml;scht werden?";  //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_del4d_p  ="Soll der Ordner '%name%' wirklich gel&ouml;scht werden?"; //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_delall   ="Sollen alle Elemente gel&ouml;scht werden?";              //@DESC: Prompt;
$l_fil_cpy      ="Kopieren nach ...";           //@DESC: Menu item
$l_fil_mov      ="Verschieben nach ...";        //@DESC: Menu item
$l_fil_chm      ="Zugriffrechte &auml;ndern";   //@DESC: Menu item
$l_fil_zipcreate="ZIP-Archiv erstellen";        //@DESC: Menu item
$l_fil_zipextrct="ZIP-Archiv hier entpacken";   //@DESC: Menu item
$l_fil_crdir_pt	="Bitte Namen des neuen Ordners eingeben:"; //@DESC: Prompt
$l_fil_ndirname	="neuer Ordner";                //@DESC: Button
$l_fil_srcname  ="Suche";						//@DESC: Button; New:02
$l_fil_srcpath  ="Pfad";						//@DESC: Button; New:02
$l_fil_srcstp   ="Anhalten";					//@DESC: Button; New:02

/* @FILE:folder.php */
$l_dvw_t      ="Ordner Ansicht";  //@DESC: Window

/* @FILE:upload.php */
$l_upl_t        ="Upload Manager";//@DESC: Window
$l_upl_expand   ="erweitern";     //@DESC: Button
$l_upl_collapse ="reduzieren";    //@DESC: Button

/* @FILE:uploadmod.php */
$l_upm_t        ="Upload Modul";                //@DESC: Window
$l_upm_nex_dir  ="Zielordner existiert nicht."; //@DESC: JS
$l_upm_2bigFsize="Datei ist zu gross.";         //@DESC: JS
$l_upm_partly   ="Die Datei wurde nur Teilweise hochgeladen.";  //@DESC: JS
$l_upm_nofile   ="Es wurde keine Datei hochgeladen.";           //@DESC: JS
$l_upm_nofilemov="Die Datei konnte nicht in den Zielordner verschoben werden.";       //@DESC: JS
$l_upm_ren_file ="Um ein &uuml;berschreiben zu verhindern wurde die Datei umbenannt.";//@DESC: JS
$l_upm_uploading="Die Datei wird gerade hochgeladen.";          //@DESC: Image
$l_upm_queueing ="Die Datei steht in der Warteschlange.";       //@DESC: Image
$l_upm_savefile ="Datei hochladen";             //@DESC: Button
$l_upm_seldir   ="Zielordner ausw&auml;hlen";   //@DESC: Button
$l_upm_infobox  ="Informationen\n=============";//@DESC: JS
$l_upm_errbox   ="Fehler\n======";              //@DESC: JS

/* @FILE:foldersel.php */
$l_sld_t        ="Ordner w&auml;hlen";  //@DESC: Window

/* @FILE:menu.php */
$l_men_inval_img="Ung&uuml;ltiges Bildformat";            //@DESC: Message
$l_men_no_rename="\"%f\" konnte nicht umbenannt werden!"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_ren="ERLAUBNIS VERWEIGERT!\nRechte zum Umbenennen nicht gesetzt."; //@DESC: JS
$l_men_no_delete="\"%f\" konnte nicht gelöscht werden,\nevtl. gibts ein Problem aufgrund der Rechtevergabe,\nein anderer Prozess greift darauf zu oder\n die Datei existiert  nicht (mehr)!"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_del="ERLAUBNIS VERWEIGERT!\nRechte zum Löschen nicht gesetzt.";    //@DESC: JS
$l_men_block_crd="ERLAUBNIS VERWEIGERT!\nRechte zum erstellen eines Ordners nicht gesetzt.";  //@DESC: JS
$l_men_no_crdir ="Ordner konnte nicht erstellt werden.";  //@DESC: JS
$l_men_block_mNc="ERLAUBNIS VERWEIGERT!\nRechte zum Kopieren und Verschieben nicht gesetzt."; //@DESC: JS
$l_men_mv_failed="Die Datei \"%sfile%\"\nkonnte nicht nach\n\"%dfile%\"\nverschoben werden."; //@DESC: JS; @REPLACE: %sfile% => source file; @REPLACE: %dfile% => destination file
$l_men_mv_f_ex  ="Verschieben erfolglos: Die Zieldatei\n\"%dfile%\"\nexistiert bereits.";     //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_mv_d_nex ="Verschieben erfolglos: Der Zielpfad\n\"%dpath%\"\nexistiert nicht.";        //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_mv_f_nex ="Verschieben erfolglos: Die Quelldatei\n\"%sfile%\"\nexistiert nicht.";      //@DESC: JS
$l_men_cy_failed="Die Datei \"%sfile%\"\nkonnte nicht nach\n\"%dfile%\"\nkopiert werden.";    //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_f_ex  ="Kopieren erfolglos: Die Zieldatei\n\"%dfile%\"\nexistiert bereits.";        //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_d_nex ="Kopieren erfolglos: Der Zielpfad\n\"%dpath%\"\nexistiert nicht.";           //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_cy_f_nex ="Kopieren erfolglos: Die Quelldatei\n\"%sfile%\"\nexistiert nicht.";         //@DESC: JS; @REPLACE: %sfile% => source file
$l_men_block_chm="ERLAUBNIS VERWEIGERT!\\nRechte zum &auml;ndern nicht gesetzt.";             //@DESC: JS
$l_men_chm_nw   ="Beim Versuch die Dateirechte von '%file%' zu &auml;ndern ist ein Fehler aufgetreten.";  //@DESC: JS; @REPLACE: %file% => file name
$l_men_chm_nex  ="Die Datei \"%file%\" existiert nicht.";  //@DESC: JS; @REPLACE: %file% => file

/* @FILE:chmod.php */
$l_chm_t    ="Zugriffrechte Manager"; //@DESC: Window
$l_chm_r    ="lesen";           //@DESC: Col
$l_chm_w    ="schreiben";       //@DESC: Col
$l_chm_x    ="ausf&uuml;hren";  //@DESC: Col
$l_chm_owner="Eigent&uuml;mer"; //@DESC: Row
$l_chm_group="Gruppe";          //@DESC: Row
$l_chm_world="Global";          //@DESC: Row
$l_chm_save ="Speichern";       //@DESC: Button

/* @FILE:viewer.php */
$l_viw_hx_th_hx ="Hexadezimal"; //@DESC: Col
$l_viw_hx_th_tx ="Text";        //@DESC: Col
$l_viw_hx_file  ="Datei";       //@DESC: Description
$l_viw_hx_page  ="Seite";       //@DESC: Description
$l_viw_hx_hex   ="Hex";         //@DESC: Description
$l_viw_hx_dec   ="Dez";         //@DESC: Description
$l_viw_hx_chr   ="Zeichen";	//@DESC: Description
$l_viw_cp_dia   ="Diashow";     //@DESC: Description
$l_viw_cp_interv="Intervall";   //@DESC: Description
$l_viw_cp_srt   ="starten";     //@DESC: Description
$l_viw_cp_end   ="anhalten";    //@DESC: Description
$l_viw_cp_file  ="Datei";    //@DESC: Description
$l_viw_er_noread="Kann von Datei nicht lesen."; //@DESC: Message; #######NEW

/* @FILE:about.php */
$l_abt_t        ="&Uuml;ber %PRGM_N%";        //@DESC: Window Title; @REPLACE: %PRGM_N% => program name
$l_abt_akt_v    ="Aktuelle Version: %PRGM_V%";//@DESC: Message; @REPLACE: %PRGM_V% => program version
$l_abt_new_v_a  ="Neuste Version: %v_num% -&gt; %link_start%herunterladen%link_stop%";  //@DESC: Message; @REPLACE: %v_num% => new version number; @REPLACE: %link_start% => Downloadlink start; @REPLACE: %link_stop% => Downloadlink end
$l_abt_freew_by ='Frei verf&uuml;gbare Software von <a href="http://www.bluevirus.ch.vu" target="_blank">bluevirus-design</a>.<br/>Dank an alle &Uuml;bersetzer:';  //@DESC: Message
$l_abt_langby   ="%lang% durch %name%";       //@DESC: Message; @REPLACE: %lang% => language name; @REPLACE: %name% => author's name


/* @FILE:packer.php */
$l_pck_t          ="Packer";                            //@DESC: Window
$l_dpck_t         ="Entpacker";                         //@DESC: Window
$l_pck_unpacking  ="... entpacke Datei ...";            //@DESC: Image; #######NEW
$l_pck_abort_op   ="Unterbreche ZIP Operation mit folgendem Fehler:"; //@DESC: JS
$l_pck_start2zip  ="Starte ZIP Prozess";                //@DESC: Button
$l_pck_def_zfile  ="Zipdatei.zip";                      //@DESC: Default input
$l_pck_choose_dir ="Zielordner ausw&auml;hlen";         //@DESC: Button
$l_pck_erno_100   ="OK";                                //@DESC: Message
$l_pck_erno_101   ="Keine Datei angegeben.";            //@DESC: Message
$l_pck_erno_102   ="Zipdatei zeigt auf Ordner.";        //@DESC: Message
$l_pck_erno_103   ="Zipdatei existiert bereits.";       //@DESC: Message
$l_pck_erno_104   ="Kann Zipdatei nicht anlegen.";      //@DESC: Message
$l_pck_erno_105   ="Zipdatei existiert nicht.";         //@DESC: Message
$l_pck_erno_106   ="Kann Zipdatei nicht &ouml;ffnen.";  //@DESC: Message
$l_pck_erno_201   ="Dateipfad ung&uuml;ltig";           //@DESC: Message
$l_pck_erno_202   ="Datei/Ordner existiert nicht.";     //@DESC: Message
$l_pck_erno_301   ="Pfad zur Zipdatei ung&uuml;ltig.";  //@DESC: Message
$l_pck_erno_302   ="Zipdatei kein g&uuml;tiges Archiv.";//@DESC: Message
$l_pck_erno_303   ="Zielpfad ung&uuml;ltig.";           //@DESC: Message
$l_pck_erno_304   ="Kann Zielordner nicht erstellen.";  //@DESC: Message
$l_pck_erno_401   ="Kann Zielstruktur nicht erstellen.";//@DESC: Message
$l_pck_erno_999   ="Fertig mit Fehlern.";               //@DESC: Message

/* @FILE:editor.php */
$l_edt_but_save   ="Speichern";             // @DESC: Button;
$l_edt_txt_t      ="Text Editor";           // @DESC: Window;
$l_edt_err_nodata ="Das Dokument kann nicht geladen werden."; //@DESC: Message;
$l_edt_txt_fname  ="Dokument";              // @DESC: Message;
$l_edt_err_ns_tmp ="Speichern unm&ouml;glich: Die Tempor&auml;re Datei kann nicht erstellt oder ge&ouml;ffnet werden."; //@DESC: Message;
$l_edt_err_ns_mov ="Speichern unm&ouml;glich: Die Tempor&auml;re Datei kann nicht verschoben werden."; //@DESC: Message;
$l_edt_err_ns_unlk="Speichern unm&ouml;glich: Die alte Datei kann nicht gel&ouml;scht werden."; //@DESC: Message;
$l_edt_err_gl_noac="Dokument kann nicht geladen werden. Zugang wurde verweigert."; //@DESC: Message;

?>