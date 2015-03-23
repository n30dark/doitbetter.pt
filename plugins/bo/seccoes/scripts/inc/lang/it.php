<?php
/*MODF:	18:04:00,27.06.07*/

/* @FILE:<this> */
$l_language="Italiano";              //@DESC: Language description
$l_file    =__FILE__;               //@DESC: Absolut path to file; @HANDLE: nedit
$l_shortcuts="it";                  //@DESC: Alpha-2 code of ISO-639-1: Shorthand symbol for language
$l_author  ="milter";    //@DESC: Author's name
$l_author_m="";   					//@DESC: Author's email
$l_author_h="";   				    //@DESC: Author's homepage
$l_time="d.m.y H:i";                //@DESC: timeformat
$l_charset="UTF-8";                 //@DESC: Charset

/* @FILE:index.php */
$l_idx_err_jsblk="Ci potrebbe essere un JavaScript/Ad-Blocker in uso.<br/>Ti informiamo che per utilizzare questa applicazione senza eventi inattesi lo dovresti disabilitare."; //@DESC: Message

/* @FILE:address.php */
$l_nav_t        ="Barra degli indirizzi";                //@DESC: Window title
$l_nav_back     ="indietro";                      //@DESC: Button
$l_nav_forward  ="avanti";                   //@DESC: Button
$l_nav_open_dlm ="apri download manager";     //@DESC: Button
$l_nav_browseUrl="vai a questo indirizzo";        //@DESC: Button
$l_nav_multis_on="abilita le selezioni multiple"; //@DESC: Button
$l_nav_multis_of=" disabilita le selezioni multiple ";//@DESC: Button
$l_nav_crdir    ="crea cartella";             //@DESC: Button
$l_nav_search   ="cerca";                    //@DESC: Button; New:02

/* @FILE:files.php */
$l_fil_t        ="visualizzazione file";               //@DESC: Window title
$l_fil_fname    ="nome";                //@DESC: Col
$l_fil_fdir     ="cartella";                  //@DESC: Col; New:02
$l_fil_atime    ="ultimo accesso";                //@DESC: Col
$l_fil_mtime    ="modificato";                //@DESC: Col
$l_fil_ctime    ="creato";                 //@DESC: Col
$l_fil_fsize    ="dimensione";                    //@DESC: Col
$l_fil_chmod    ="permessi";             //@DESC: Col
$l_fil_asc      ="ordinamento crescente";          //@DESC: Image
$l_fil_dsc      ="ordinamento decrescente";         //@DESC: Image
$l_fil_download ="scarica";                //@DESC: Menu item
$l_fil_view_hex ="leggi modalità esadecimale";      //@DESC: Menu item
$l_fil_view_html="apri come pagina web";         //@DESC: Menu item
$l_fil_view_text="apri come testo";            //@DESC: Menu item
$l_fil_view_dia ="apri con slideshow";     //@DESC: Menu item
$l_fil_edit_text="modifica come testo";            //@DESC: Menu item
$l_fil_opendir  ="apri";                    //@DESC: Menu item
$l_fil_preview  ="... caricamento anteprima ..."; //@DESC: Image
$l_fil_ren      ="rinomina";                  //@DESC: Menu item
$l_fil_renPrompt="Scrivi un nuovo nome:";  //@DESC: Prompt
$l_fil_del      ="cancella";                  //@DESC: Menu item
$l_fil_del4f_p  ="Confermi la cancellazione del file '%name%'?";  //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_del4d_p  =" Confermi la cancellazione della cartella '%name%'?";//@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_delall   =" Confermi la cancellazione di tutti questi files?";     //@DESC: Prompt;
$l_fil_cpy      ="copia in...";        //@DESC: Menu item
$l_fil_mov      ="muovi in...";        //@DESC: Menu item
$l_fil_chm      ="cambia i permessi";//@DESC: Menu item
$l_fil_zipcreate="crea un archivio ZIP";//@DESC: Menu item
$l_fil_zipextrct="estrai l’archivio ZIP";//@DESC: Menu item
$l_fil_crdir_pt	="Scrivi il nome della cartella:";//@DESC: Prompt
$l_fil_ndirname	="nuova cartella";        //@DESC: Button
$l_fil_srcname  ="Cerca";			  //@DESC: Button; New:02
$l_fil_srcpath  ="Percorso";			  //@DESC: Button; New:02
$l_fil_srcstp   ="Stop";			  //@DESC: Button; New:02

/* @FILE:folder.php */
$l_dvw_t        ="visualizza cartella";  //@DESC: Window title

/* @FILE:upload.php */
$l_upl_t        ="gestione upload";//@DESC: Window title
$l_upl_expand   ="espandi";        //@DESC: Button
$l_upl_collapse ="riduci";        //@DESC: Button

/* @FILE:uploadmod.php */
$l_upm_t        ="modulo upload";              //@DESC: Window title
$l_upm_nex_dir  ="La certella di destinazione esiste già.";        //@DESC: JS
$l_upm_2bigFsize="Il file supera la dimensione massima concessa."; //@DESC: JS
$l_upm_partly   ="Il file è stato solo parzialmente caricato.";         //@DESC: JS
$l_upm_nofile   ="Nessun file è stato caricato.";                     //@DESC: JS
$l_upm_nofilemov="Non è possible spostare il file nella cartella di destinazione.";//@DESC: JS
$l_upm_ren_file ="Il file è stato rinominato per evitare di sovrascrivere un altro file.";//@DESC: JS
$l_upm_uploading="Il file è in caricamento.";          //@DESC: Image
$l_upm_queueing ="Il file è in coda.";         //@DESC: Image
$l_upm_savefile ="Caricamento file";               //@DESC: Button
$l_upm_seldir   ="seleziona la cartella di destinazione"; //@DESC: Button
$l_upm_infobox  ="Informazione=============";//@DESC: JS
$l_upm_errbox   ="Errore\n======";             //@DESC: JS

/* @FILE:foldersel.php */
$l_sld_t        =" seleziona la cartella ";  //@DESC: Window title

/* @FILE:menu.php */
$l_men_inval_img="formato imagine non ammesso";              //@DESC: Message
$l_men_no_rename="\"%f\" non può essere rinominato!";        //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_ren="ACCESSO RIFIUTATO!\nNon hai i privilegi per rinominare"; //@DESC: JS
$l_men_no_delete="\"%f\" non può essere cancellato,\n o a causa di mancanza di provilegi,\no un altro processo sta accedendo al file\n o il file non esiste"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_del="ACCESSO RIFIUTATO!\nNon hai i privilegi per cancellare"; //@DESC: JS
$l_men_block_crd="ACCESSO RIFIUTATO!\nNon hai i privilege per creare cartelle";       //@DESC: JS
$l_men_no_crdir ="Non puoi creare cartelle";            //@DESC: JS
$l_men_block_mNc="ACCESSO RIFIUTATO!\nNon hai i privilegi per copiare o spostare il file";       //@DESC: JS
$l_men_mv_failed="Il file \"%sfile%\"\nnon può essere spostato in\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %sfile% => source file; @REPLACE: %dfile% => destination file
$l_men_mv_f_ex  ="Spostamento non riuscito. Il file \n\"%dfile%\"\n esiste già.";    //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_mv_d_nex =" Spostamento non riuscito. La cartella di destinazione \n\"%dpath%\"\nnon esiste.";  //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_mv_f_nex =" Spostamento non riuscito.\n\"%sfile%\"\n Il file origine non esiste .";         //@DESC: JS
$l_men_cy_failed="Il file \"%sfile%\"\n non può essere copiato su\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_f_ex  ="Copia file non effettuata. Il file\n\"%dfile%\"\nesiste già";   //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_d_nex =" Copia file non effettuata. La cartella\n\"%dpath%\"\nnon esiste."; //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_cy_f_nex =" Copia file non effettuata. Il file\n\"%sfile%\"\nnon esiste.";        //@DESC: JS; @REPLACE: %sfile% => source file
$l_men_block_chm=" ACCESSO RIFIUTATO!\\nNon hai I privilege per cambiare i permessi al file. ";//@DESC: JS
$l_men_chm_nw   ="Errore durante il cambio permessidel file '%file%'.";//@DESC: JS; @REPLACE: %file% => file name
$l_men_chm_nex  ="Il file \"%file%\" non esiste.";     //@DESC: JS; @REPLACE: %file% => file

/* @FILE:chmod.php */
$l_chm_t    ="gestione permessi"; //@DESC: Window title
$l_chm_r    ="leggi";    //@DESC: Col
$l_chm_w    ="scrivi";   //@DESC: Col
$l_chm_x    ="esegui"; //@DESC: Col
$l_chm_owner="proprietario";    //@DESC: Row
$l_chm_group="gruppo";   //@DESC: Row
$l_chm_world="altri";  //@DESC: Row
$l_chm_save ="salva";    //@DESC: Button

/* @FILE:viewer.php */
$l_viw_hx_th_hx ="esadecimale"; //@DESC: Col
$l_viw_hx_th_tx ="testo";        //@DESC: Col
$l_viw_hx_file  ="file";        //@DESC: Description
$l_viw_hx_page  ="pagina";        //@DESC: Description
$l_viw_hx_hex   ="Hex";         //@DESC: Description
$l_viw_hx_dec   ="Dec";         //@DESC: Description
$l_viw_hx_chr   ="Carattere";        //@DESC: Description
$l_viw_cp_dia   ="Slideshow";   //@DESC: Description
$l_viw_cp_interv="Intervallo";    //@DESC: Description
$l_viw_cp_srt   ="partenza";       //@DESC: Description
$l_viw_cp_end   ="stop";        //@DESC: Description
$l_viw_cp_file  ="file";        //@DESC: Description
$l_viw_er_noread="Non è possible leggere dal file."; //@DESC: Message; #######NEW

/* @FILE:about:php */
$l_abt_t        ="Informazioni su  %PRGM_N%";        //@DESC: Window title Title; @REPLACE: %PRGM_N% => program name
$l_abt_akt_v    ="Versione attuale: %PRGM_V%";//@DESC: Message; @REPLACE: %PRGM_V% => program version
$l_abt_new_v_a  ="Versione precedente: %v_num% -&gt; %link_start%download%link_stop%";  //@DESC: Message; @REPLACE: %v_num% => new version number; @REPLACE: %link_start% => Downloadlink start; @REPLACE: %link_stop% => Downloadlink end
$l_abt_freew_by ='Freeware by <a href="http://www.bluevirus.ch.vu" target="_blank">bluevirus-design</a>.<br/>Un grazie e tutti i traduttori:';  //@DESC: Message
$l_abt_langby   ="%lang% by %name%";       //@DESC: Message; @REPLACE: %lang% => Lingua; @REPLACE: %name% => Traduttore


/* @FILE:packer.php */
$l_pck_t          ="Comprimi";                      //@DESC: Window title
$l_dpck_t         ="Estrai";                    //@DESC: Window title
$l_pck_unpacking  ="... dcomprimi ...";           //@DESC: Image  #########NEW
$l_pck_abort_op   ="Processo ZIP cancellato con errore:"; //@DESC: JS
$l_pck_start2zip  ="Inizia processo ZIP";        //@DESC: Button
$l_pck_def_zfile  ="archiviozip.zip";              //@DESC: Default input
$l_pck_choose_dir ="scegli la cartella di destinazione";   //@DESC: Button
$l_pck_erno_100   ="OK";                          //@DESC: Message
$l_pck_erno_101   ="Non è stato dato alcun file.";              //@DESC: Message
$l_pck_erno_102   ="Il file ZIP punta alla cartella.";  //@DESC: Message
$l_pck_erno_103   ="Il file ZIP esiste già";     //@DESC: Message
$l_pck_erno_104   ="Non posso creare il file ZIP";    //@DESC: Message
$l_pck_erno_105   ="Il file ZIP non esiste.";    //@DESC: Message
$l_pck_erno_106   ="Non posso aprire il file ZIP";      //@DESC: Message
$l_pck_erno_201   ="Percorso del file non corretto";           //@DESC: Message
$l_pck_erno_202   ="Il file o la cartella non esistono."; //@DESC: Message
$l_pck_erno_301   ="File ZIP con percorso non corretto.";   //@DESC: Message
$l_pck_erno_302   ="Il file ZIP contiene archivi non corretti."; //@DESC: Message
$l_pck_erno_303   ="Percorso di destinazione non corretto.";   //@DESC: Message
$l_pck_erno_304   ="Non posso creare la cartella di destinazione.";  //@DESC: Message
$l_pck_erno_401   ="Non posso creare la struttura del file.";      //@DESC: Message
$l_pck_erno_999   ="Terminato con alcuni errori.";   //@DESC: Message


/* @FILE:editor.php */
$l_edt_but_save   ="Salva";                          // @DESC: Button; New:01
$l_edt_txt_t      ="editor di test";                   // @DESC: Window title; New:01
$l_edt_err_nodata ="Il documento non può essere caricato."; //@DESC: Message; New:01
$l_edt_txt_fname  ="Documento";                      // @DESC: Message: New:01
$l_edt_err_ns_tmp ="Non è possible salvare: impossibile accedere al file temporaneo."; //@DESC: Message: New:01
$l_edt_err_ns_mov =" Non è possible salvare: impossibile spostare il file temporaneo.";  //@DESC: Message: New:01
$l_edt_err_ns_unlk=" Non è possible salvare: impossibile cancellare il file vecchio.";      //@DESC: Message: New:01
$l_edt_err_gl_noac="Imposibile caricare il documento: accesso rifiutato.";       //@DESC: Message: New:01
?>
