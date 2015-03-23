<?php
/*MODF:	01:00:00,27.09.07*/

/* @FILE:<this> */
$l_language="Fran&ccedil;ais";              //@DESC: Language description
$l_file    =__FILE__;               //@DESC: Absolut path to file; @HANDLE: nedit
$l_shortcuts="fr";                  //@DESC: Shorthand symbol for language
$l_author  ="Thierry Floquet";       //@DESC: Author's name
$l_author_m="";//@DESC: Author's email
$l_author_h="";      //@DESC: Author's homepage
$l_time="d.m.y H:i";                //@DESC: timeformat
$l_charset="UTF-8";              //@DESC: Charset

/* @FILE:index.php */
$l_idx_err_jsblk="Il semble qu'un bloqueur de JavaScript/Popups soit actif.<br/>Pour utiliser pleinement cette application, nous vous conseillons de le d&eacute;sactiver."; //@DESC: Message

/* @FILE:address.php */
$l_nav_t        ="Barre d'adresses";                //@DESC: Window title
$l_nav_back     ="reculer";                      //@DESC: Button
$l_nav_forward  ="avancer";                   //@DESC: Button
$l_nav_open_dlm ="ouvrir le gestionnaire d'envois";     //@DESC: Button
$l_nav_browseUrl="aller &agrave; cette adresse";        //@DESC: Button
$l_nav_multis_on="autoriser la selection multiple"; //@DESC: Button
$l_nav_multis_of="interdire la selection multiple";//@DESC: Button
$l_nav_crdir    ="cr&eacute;er un dossier";             //@DESC: Button
$l_nav_search   ="rechercher";                       //@DESC: Button; New:02

/* @FILE:files.php */
$l_fil_t        ="d&eacute;tails du fichier";               //@DESC: Window title
$l_fil_fname    ="nom";                //@DESC: Col
$l_fil_fdir     ="dossier";                      //@DESC: Row; New:02
$l_fil_atime    ="acc&eacute;d&eacute;";                //@DESC: Col
$l_fil_mtime    ="modifi&eacute;";                //@DESC: Col
$l_fil_ctime    ="cr&eacute;&eacute;";                 //@DESC: Col
$l_fil_fsize    ="taille";                    //@DESC: Col
$l_fil_chmod    ="permissions";             //@DESC: Col
$l_fil_asc      ="tri ascendant";          //@DESC: Image
$l_fil_dsc      ="tri descendant";         //@DESC: Image
$l_fil_download ="t&eacute;l&eacute;charger";                //@DESC: Menu item
$l_fil_view_hex ="ouvrir avec hex-view";      //@DESC: Menu item
$l_fil_view_html="ouvrir en tant que site web";         //@DESC: Menu item
$l_fil_view_text="voir en tant que texte";            //@DESC: Menu item
$l_fil_view_dia ="ouvrir avec le diaporama";     //@DESC: Menu item
$l_fil_edit_text="&eacute;diteur de texte";            //@DESC: Menu item
$l_fil_opendir  ="ouvrir";                    //@DESC: Menu item
$l_fil_preview  ="... chargement de l'aperçu ..."; //@DESC: Image
$l_fil_ren      ="renommer";                  //@DESC: Menu item
$l_fil_renPrompt="Entrer le nouveau nom svp:";  //@DESC: Prompt
$l_fil_del      ="effacer";                  //@DESC: Menu item
$l_fil_del4f_p  ="Voulez-vous vraiment effacer le fichier '%name%'?";  //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_del4d_p  ="Voulez-vous vraiment effacer le dossier '%name%'?";//@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_delall   ="Voulez-vous vraiment effacer ces fichiers ?";     //@DESC: Prompt;
$l_fil_cpy      ="copier vers...";        //@DESC: Menu item
$l_fil_mov      ="d&eacute;placer vers...";        //@DESC: Menu item
$l_fil_chm      ="changer les permissions";//@DESC: Menu item
$l_fil_zipcreate="cr&eacute;er archive ZIP";//@DESC: Menu item
$l_fil_zipextrct="extraire le ZIP";//@DESC: Menu item
$l_fil_crdir_pt	="Entrer le nom du dossier:";//@DESC: Prompt
$l_fil_ndirname	="nouveau dossier";        //@DESC: Button
$l_fil_srcname  ="rechercher";						//@DESC: Button; New:02
$l_fil_srcpath  ="chemin";						//@DESC: Button; New:02
$l_fil_srcstp   ="arr&ecirc;ter";					//@DESC: Button; New:02

/* @FILE:folder.php */
$l_dvw_t        ="voir dossier";  //@DESC: Window title

/* @FILE:upload.php */
$l_upl_t        ="gestionnaire d'envois";//@DESC: Window title
$l_upl_expand   ="d&eacute;velopper";        //@DESC: Button
$l_upl_collapse ="r&eacute;duire";        //@DESC: Button

/* @FILE:uploadmod.php */
$l_upm_t        ="module d'envois";              //@DESC: Window title
$l_upm_nex_dir  ="Le dossier de destination existe d&eacute;j&agrave;.";        //@DESC: JS
$l_upm_2bigFsize="La taille du fichier d&eacute;passe la directive syst&egrave;me."; //@DESC: JS
$l_upm_partly   ="Le fichier n'a &eacute;t&eacute; que partiellement envoy&eacute;.";         //@DESC: JS
$l_upm_nofile   ="Aucun fichier n'a &eacute;t&eacute; envoy&eacute;.";                     //@DESC: JS
$l_upm_nofilemov="Impossible de d&eacute;placer le fichier vers le dossier de destination.";//@DESC: JS
$l_upm_ren_file ="Le fichier a &eacute;t&eacute; renomm&eacute; pour pr&eacute;venir l'&eacute;crasement d'un autre fichier.";//@DESC: JS
$l_upm_uploading="Le fichier est en cours d'envoi.";          //@DESC: Image
$l_upm_queueing ="Le fichier est en file d'attente.";         //@DESC: Image
$l_upm_savefile ="Envoyer le fichier";               //@DESC: Button
$l_upm_seldir   ="choisir le dossier de destination"; //@DESC: Button
$l_upm_infobox  ="Information\n=============";//@DESC: JS
$l_upm_errbox   ="Erreur\n======";             //@DESC: JS

/* @FILE:foldersel.php */
$l_sld_t        ="choisir le dossier";  //@DESC: Window title

/* @FILE:menu.php */
$l_men_inval_img="format d'image invalide";              //@DESC: Message
$l_men_no_rename="\"%f\" n'a pu &ecirc;tre renomm&eacute;!";        //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_ren="ACCES REFUSE!\nDroit manquant pour renommer."; //@DESC: JS
$l_men_no_delete="\"%f\" n'a pu &ecirc;tre effac&eacute;,\nc'est sans doute d&ucirc; &agrave; une permission manquante,\nun autre processus acc&egrave;derait &agrave; ce fichier ou\n ce fichier n'existe plus!"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_del="ACCES REFUSE!\nDroit manquant pour supprimer."; //@DESC: JS
$l_men_block_crd="ACCES REFUSE!\nDroit manquant pour cr&eacute;er un dossier.";       //@DESC: JS
$l_men_no_crdir ="Impossible de cr&eacute;er le dossier.";            //@DESC: JS
$l_men_block_mNc="ACCES REFUSE!\nDroit manquant pour copier ou d&eacute;placer un fichier.";       //@DESC: JS
$l_men_mv_failed="Le fichier \"%sfile%\"\nn'a pas pu &ecirc;tre d&eacute;plac&eacute; vers\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %sfile% => source file; @REPLACE: %dfile% => destination file
$l_men_mv_f_ex  ="Echec du d&eacute;placement: Le fichier de destination \n\"%dfile%\"\nexiste d&eacute;j&agrave;.";    //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_mv_d_nex ="Echec du d&eacute;placement: Le dossier de destination\n\"%dpath%\"\nn'existe pas.";  //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_mv_f_nex ="Echec du d&eacute;placement: Le fichier source\n\"%sfile%\"\nn'existe pas.";         //@DESC: JS
$l_men_cy_failed="Le fichier \"%sfile%\"\nn'a pas pu &ecirc;tre copi&eacute; vers\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_f_ex  ="Echec de la copie: Le fichier de destination\n\"%dfile%\"\nexiste d&eacute;j&agrave;.";   //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_d_nex ="Echec de la copie: Le dossier de destination\n\"%dpath%\"\nn'existe pas."; //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_cy_f_nex ="Echec de la copie: Le fichier source\n\"%sfile%\"\nn'existe pas.";        //@DESC: JS; @REPLACE: %sfile% => source file
$l_men_block_chm="ACCES REFUSE!\\nDroit manquant pour changer les permissions des fichiers.";//@DESC: JS
$l_men_chm_nw   ="Echec du changement des permissions de '%file%'.";//@DESC: JS; @REPLACE: %file% => file name
$l_men_chm_nex  ="Le fichier \"%file%\" n'existe pas.";     //@DESC: JS; @REPLACE: %file% => file

/* @FILE:chmod.php */
$l_chm_t    ="gestionnaire des permissions"; //@DESC: Window title
$l_chm_r    ="lecture";    //@DESC: Col
$l_chm_w    ="&eacute;criture";   //@DESC: Col
$l_chm_x    ="ex&eacute;cution"; //@DESC: Col
$l_chm_owner="propri&eacute;taire";    //@DESC: Row
$l_chm_group="groupe";   //@DESC: Row
$l_chm_world="autres";  //@DESC: Row
$l_chm_save ="Sauver";    //@DESC: Button

/* @FILE:viewer.php */
$l_viw_hx_th_hx ="hexadecimal"; //@DESC: Col
$l_viw_hx_th_tx ="texte";        //@DESC: Col
$l_viw_hx_file  ="fichier";        //@DESC: Description
$l_viw_hx_page  ="page";        //@DESC: Description
$l_viw_hx_hex   ="Hex";         //@DESC: Description
$l_viw_hx_dec   ="Dec";         //@DESC: Description
$l_viw_hx_chr   ="Car.";        //@DESC: Description
$l_viw_cp_dia   ="Diaporama";   //@DESC: Description
$l_viw_cp_interv="Intervale";    //@DESC: Description
$l_viw_cp_srt   ="d&eacute;marrer";       //@DESC: Description
$l_viw_cp_end   ="arr&ecirc;ter";        //@DESC: Description
$l_viw_cp_file  ="fichier";        //@DESC: Description
$l_viw_er_noread="Lecture impossible depuis le fichier."; //@DESC: Message; #######NEW

/* @FILE:about:php */
$l_abt_t        ="Au sujet de %PRGM_N%";        //@DESC: Window title Title; @REPLACE: %PRGM_N% => program name
$l_abt_akt_v    ="Version courante: %PRGM_V%";//@DESC: Message; @REPLACE: %PRGM_V% => program version
$l_abt_new_v_a  ="Version la plus r&eacute;cente: %v_num% -&gt; %link_start%download%link_stop%";  //@DESC: Message; @REPLACE: %v_num% => new version number; @REPLACE: %link_start% => Downloadlink start; @REPLACE: %link_stop% => Downloadlink end
$l_abt_freew_by ='Freeware par <a href="http://www.bluevirus.ch.vu" target="_blank">bluevirus-design</a>.<br/>Merci &agrave; tous les traducteurs:';  //@DESC: Message
$l_abt_langby   ="%lang% par %name%";       //@DESC: Message; @REPLACE: %lang% => language name; @REPLACE: %name% => author's name


/* @FILE:packer.php */
$l_pck_t          ="Compresser";                      //@DESC: Window title
$l_dpck_t         ="D&eacute;compresser";                    //@DESC: Window title
$l_pck_unpacking  ="... D&eacute;compression ...";           //@DESC: Image  #########NEW
$l_pck_abort_op   ="Processus ZIP annule avec l'erreur suivante:"; //@DESC: JS
$l_pck_start2zip  ="D&eacute;marrage du processus ZIP";        //@DESC: Button
$l_pck_def_zfile  ="archivezip.zip";              //@DESC: Default input
$l_pck_choose_dir ="choisissez le dossier de destination";   //@DESC: Button
$l_pck_erno_100   ="OK";                          //@DESC: Message
$l_pck_erno_101   ="Aucun fichier n'a &eacute;t&eacute; donn&eacute;.";              //@DESC: Message
$l_pck_erno_102   ="Le fichier ZIP pointe vers le dossier.";  //@DESC: Message
$l_pck_erno_103   ="Le fichier ZIP existe d&eacute;j&agrave;.";     //@DESC: Message
$l_pck_erno_104   ="Cr&eacute;ation du fichier ZIP impossible.";    //@DESC: Message
$l_pck_erno_105   ="Le fichier ZIP n'existe pas.";    //@DESC: Message
$l_pck_erno_106   ="Ouverture du fichier ZIP impossible.";      //@DESC: Message
$l_pck_erno_201   ="Chemin de fichier invalide";           //@DESC: Message
$l_pck_erno_202   ="File/Folder does not exist."; //@DESC: Message
$l_pck_erno_301   ="Invalid path to ZIP file.";   //@DESC: Message
$l_pck_erno_302   ="Le fichier ZIP contient une archive inconnue/invalide."; //@DESC: Message
$l_pck_erno_303   ="Chemin de destination invalide.";   //@DESC: Message
$l_pck_erno_304   ="Cr&eacute;ation du dossier de destination impossible.";  //@DESC: Message
$l_pck_erno_401   ="Cr&eacute;ation de la structure des fichiers impossible.";      //@DESC: Message
$l_pck_erno_999   ="Termin&eacute; avec des erreurs";   //@DESC: Message

/* @FILE:editor.php */
$l_edt_but_save   ="Sauver";                          // @DESC: Button; New:01
$l_edt_txt_t      ="&eacute;diteur de texte";                   // @DESC: Window title; New:01
$l_edt_err_nodata ="Impossible de charger le document."; //@DESC: Message; New:01
$l_edt_txt_fname  ="Document";                      // @DESC: Message: New:01
$l_edt_err_ns_tmp ="Sauvegarde impossible: Le fichier temporaire est inaccessible."; //@DESC: Message: New:01
$l_edt_err_ns_mov ="Sauvegarde impossible: Echec du d&eacute;placement du fichier temporaire.";  //@DESC: Message: New:01
$l_edt_err_ns_unlk="Sauvegarde impossible: Echec de la supression de l'ancien fichier.";      //@DESC: Message: New:01
$l_edt_err_gl_noac="chargement de document impossible: acces refus&eacute;.";       //@DESC: Message: New:01
?>