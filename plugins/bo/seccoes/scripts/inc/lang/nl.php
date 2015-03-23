<?php
/*MODF:	15:00:00,22.03.09*/

/* @FILE:<this> */
$l_language="Nederlands";           //@DESC: Language description
$l_file    =__FILE__;               //@DESC: Absolut path to file; @HANDLE: nedit
$l_shortcuts="nl";                  //@DESC: Alpha-2 code of ISO-639-1: Shorthand symbol for language
$l_author  ="Theun van den Bosch";  //@DESC: Author's name
$l_author_m="thvdbosch@gmail.com";  //@DESC: Author's email
$l_author_h="";   		    //@DESC: Author's homepage
$l_time="d.m.y H:i";                //@DESC: timeformat
$l_charset="UTF-8";                 //@DESC: Charset

/* @FILE:index.php */
$l_idx_err_jsblk="There might be a JavaScript/Ad-Blocker in use.<br/>To use this application without unexpected events you are advised to disable it."; //@DESC: Message

/* @FILE:address.php */
$l_nav_t        ="Adresbalk";                 //@DESC: Window title
$l_nav_back     ="vorige";                    //@DESC: Button
$l_nav_forward  ="volgende";                  //@DESC: Button
$l_nav_open_dlm ="open upload manager";       //@DESC: Button
$l_nav_browseUrl="ga naar adres";             //@DESC: Button
$l_nav_multis_on="meervoudige selectie aan";  //@DESC: Button
$l_nav_multis_of="meervoudige selectie uit";  //@DESC: Button
$l_nav_crdir    ="map maken";                 //@DESC: Button
$l_nav_search   ="zoeken";                    //@DESC: Button; New:02

/* @FILE:files.php */
$l_fil_t        ="bestand tonen";             //@DESC: Window title
$l_fil_fname    ="map/bestandsnaam";          //@DESC: Col
$l_fil_fdir     ="map";                       //@DESC: Col; New:02
$l_fil_atime    ="laatste toegang";           //@DESC: Col
$l_fil_mtime    ="aangepast";                 //@DESC: Col
$l_fil_ctime    ="gemaakt";                   //@DESC: Col
$l_fil_fsize    ="grootte";                   //@DESC: Col
$l_fil_chmod    ="bestandsrechten";           //@DESC: Col
$l_fil_asc      ="oplopend sorteren";         //@DESC: Image
$l_fil_dsc      ="aflopend sorteren";         //@DESC: Image
$l_fil_download ="download";                  //@DESC: Menu item
$l_fil_view_hex ="openen met hex-view";       //@DESC: Menu item
$l_fil_view_html="openen als website";        //@DESC: Menu item
$l_fil_view_text="openen als tekst";          //@DESC: Menu item
$l_fil_view_dia ="openen als diapresentatie"; //@DESC: Menu item
$l_fil_edit_text="bewerken als tekst";        //@DESC: Menu item
$l_fil_opendir  ="openen";                    //@DESC: Menu item
$l_fil_preview  ="... laden voorbeeld ...";   //@DESC: Image
$l_fil_ren      ="hernoemen";                 //@DESC: Menu item
$l_fil_renPrompt="Geef nieuwe naam a.u.b.:";  //@DESC: Prompt
$l_fil_del      ="verwijderen";               //@DESC: Menu item
$l_fil_del4f_p  ="Verwijder dit bestand '%name%'?";  //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_del4d_p  ="Verwijder deze map '%name%'?";//@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_delall   ="Weet je zeker dat je alle bestanden wilt verwijderen?";     //@DESC: Prompt;
$l_fil_cpy      ="kopi&euml;ren naar...";        //@DESC: Menu item
$l_fil_mov      ="verplaatsen naar...";        //@DESC: Menu item
$l_fil_chm      ="verander rechten";  //@DESC: Menu item
$l_fil_zipcreate="maak ZIP-archief";  //@DESC: Menu item
$l_fil_zipextrct="unzip ZIP-archief"; //@DESC: Menu item
$l_fil_crdir_pt	="Geef naam map:";    //@DESC: Prompt
$l_fil_ndirname	="nieuwe map";        //@DESC: Button
$l_fil_srcname  ="Zoeken";	      //@DESC: Button; New:02
$l_fil_srcpath  ="Pad";		      //@DESC: Button; New:02
$l_fil_srcstp   ="Stop";	      //@DESC: Button; New:02

/* @FILE:folder.php */
$l_dvw_t        ="mapweergave";   //@DESC: Window title

/* @FILE:upload.php */
$l_upl_t        ="upload manager";//@DESC: Window title
$l_upl_expand   ="vergroten";     //@DESC: Button
$l_upl_collapse ="verkleinen";    //@DESC: Button

/* @FILE:uploadmod.php */
$l_upm_t        ="upload module";                          //@DESC: Window title
$l_upm_nex_dir  ="Doelmap bestaat reeds.";                 //@DESC: JS
$l_upm_2bigFsize="Bestand overschrijdt maximale grootte."; //@DESC: JS
$l_upm_partly   ="Bestand is gedeeltelijk ge&uuml;pload.";      //@DESC: JS
$l_upm_nofile   ="Er is geen bestand ge&uuml;pload.";           //@DESC: JS
$l_upm_nofilemov="Kon bestand niet naar doelmap verplaatsen.";//@DESC: JS
$l_upm_ren_file ="Het bestand is hernoemd ter voorkoming van overschrijven van ander bestand.";//@DESC: JS
$l_upm_uploading="Bestand wordt ge&uuml;pload.";      //@DESC: Image
$l_upm_queueing ="Bestand staat in de wachtrij.";//@DESC: Image
$l_upm_savefile ="Upload bestand";               //@DESC: Button
$l_upm_seldir   ="selecteer doelmap";            //@DESC: Button
$l_upm_infobox  ="Informatie\n=============";    //@DESC: JS
$l_upm_errbox   ="Fout\n======";                 //@DESC: JS

/* @FILE:foldersel.php */
$l_sld_t        ="selecteer map";  //@DESC: Window title

/* @FILE:menu.php */
$l_men_inval_img="ongeldig formaat afbeelding";              //@DESC: Message
$l_men_no_rename="\"%f\" kon niet worden hernoemd!";        //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_ren="TOEGANG GEWEIGERD!\nGeen rechten voor hernoemen."; //@DESC: JS
$l_men_no_delete="\"%f\" kon niet worden verwijderd,\ndit kan te maken hebben met onvoldoende rechten,\neen ander proces heeft toegang tot het bestand of\n dit bestand bestaat niet (meer)!"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_del="TOEGANG GEWEIGERD!\nGeen verwijderrechten."; //@DESC: JS
$l_men_block_crd="TOEGANG GEWEIGERD!\nGeen rechten voor aanmaken map.";       //@DESC: JS
$l_men_no_crdir ="Kon geen map aanmaken.";            //@DESC: JS
$l_men_block_mNc="TOEGANG GEWEIGERD!\nGeen rechten om bestand te kopi&euml;ren of te verplaatsen.";       //@DESC: JS
$l_men_mv_failed="Bestand \"%sfile%\"\nkon niet worden verplaatst naar\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %sfile% => source file; @REPLACE: %dfile% => destination file
$l_men_mv_f_ex  ="Verplaatsing niet succesvol: Doelbestand\n\"%dfile%\"\nbestaat al.";    //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_mv_d_nex ="Verplaatsing niet succesvol: Doelbestand\n\"%dpath%\"\nbestaat niet.";  //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_mv_f_nex ="Verplaatsing niet succesvol: Bronbestand\n\"%sfile%\"\nbestaat niet.";  //@DESC: JS
$l_men_cy_failed="Bestand \"%sfile%\"\nkon niet worden gekopieerd naar\n\"%dfile%\".";    //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_f_ex  ="Kopi&euml;ren niet succesvol: Doelbestand\n\"%dfile%\"\nbestaat al.";        //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_d_nex ="Kopi&euml;ren niet succesvol: Doelbestand\n\"%dpath%\"\nbestaat niet.";      //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_cy_f_nex ="Kopi&euml;ren niet succesvol: Bronbestand\n\"%sfile%\"\nbestaat niet.";      //@DESC: JS; @REPLACE: %sfile% => source file
$l_men_block_chm="TOEGANG GEWEIGERD!\\nGeen rechten voor aanpassen bestandsrechten.";     //@DESC: JS
$l_men_chm_nw   ="Mislukt bij verandering van rechten bestand '%file%'.";//@DESC: JS; @REPLACE: %file% => file name
$l_men_chm_nex  ="Bestand \"%file%\" bestaat niet.";     //@DESC: JS; @REPLACE: %file% => file

/* @FILE:chmod.php */
$l_chm_t    ="rechten manager"; //@DESC: Window title
$l_chm_r    ="lezen";           //@DESC: Col
$l_chm_w    ="schrijven";       //@DESC: Col
$l_chm_x    ="uitvoeren";       //@DESC: Col
$l_chm_owner="eigenaar";        //@DESC: Row
$l_chm_group="groep";           //@DESC: Row
$l_chm_world="anderen";         //@DESC: Row
$l_chm_save ="opslaan";         //@DESC: Button

/* @FILE:viewer.php */
$l_viw_hx_th_hx ="hexadecimal";    //@DESC: Col
$l_viw_hx_th_tx ="tekst";          //@DESC: Col
$l_viw_hx_file  ="bestand";        //@DESC: Description
$l_viw_hx_page  ="pagina";         //@DESC: Description
$l_viw_hx_hex   ="Hex";            //@DESC: Description
$l_viw_hx_dec   ="Dec";            //@DESC: Description
$l_viw_hx_chr   ="Char";           //@DESC: Description
$l_viw_cp_dia   ="Diavoorstelling";//@DESC: Description
$l_viw_cp_interv="Interval";       //@DESC: Description
$l_viw_cp_srt   ="start";          //@DESC: Description
$l_viw_cp_end   ="stop";           //@DESC: Description
$l_viw_cp_file  ="bestand";        //@DESC: Description
$l_viw_er_noread="Kan bestand niet lezen."; //@DESC: Message; #######NEW

/* @FILE:about:php */
$l_abt_t        ="Over %PRGM_N%";        //@DESC: Window title Title; @REPLACE: %PRGM_N% => program name
$l_abt_akt_v    ="Hudige versie: %PRGM_V%";//@DESC: Message; @REPLACE: %PRGM_V% => program version
$l_abt_new_v_a  ="Meest recente versie: %v_num% -&gt; %link_start%download%link_stop%";  //@DESC: Message; @REPLACE: %v_num% => new version number; @REPLACE: %link_start% => Downloadlink start; @REPLACE: %link_stop% => Downloadlink end
$l_abt_freew_by ='Freeware gemaakt door <a href="http://www.bluevirus.ch.vu" target="_blank">bluevirus-design</a>.<br/>Met dank aan alle vertalers:';  //@DESC: Message
$l_abt_langby   ="%lang% by %name%";       //@DESC: Message; @REPLACE: %lang% => language name; @REPLACE: %name% => author's name


/* @FILE:packer.php */
$l_pck_t          ="Zipper";                      //@DESC: Window title
$l_dpck_t         ="Unzipper";                    //@DESC: Window title
$l_pck_unpacking  ="... unzipping ...";           //@DESC: Image  #########NEW
$l_pck_abort_op   ="ZIP-proces gestopt door volgende fout:"; //@DESC: JS
$l_pck_start2zip  ="Starten ZIP proces";        //@DESC: Button
$l_pck_def_zfile  ="ziparchive.zip";              //@DESC: Default input
$l_pck_choose_dir ="kies doelmap";   //@DESC: Button
$l_pck_erno_100   ="OK";                          //@DESC: Message
$l_pck_erno_101   ="geen bestand aangegeven.";              //@DESC: Message
$l_pck_erno_102   ="ZIP bestand verwijst naar map.";  //@DESC: Message
$l_pck_erno_103   ="ZIP bestand bestaat al.";     //@DESC: Message
$l_pck_erno_104   ="Kan geen ZIP bestand maken.";    //@DESC: Message
$l_pck_erno_105   ="ZIP bestand bestaat niet.";    //@DESC: Message
$l_pck_erno_106   ="Kan ZIP bestand niet openen.";      //@DESC: Message
$l_pck_erno_201   ="Ongeldig bestandspad";           //@DESC: Message
$l_pck_erno_202   ="Bestand/map bestaat niet."; //@DESC: Message
$l_pck_erno_301   ="Ongeldig pad naar ZIP bestand.";   //@DESC: Message
$l_pck_erno_302   ="ZIP bestand bevat onbekend/ongeldig archief."; //@DESC: Message
$l_pck_erno_303   ="Ongeldige doelmap.";   //@DESC: Message
$l_pck_erno_304   ="Kan doelmap niet maken.";  //@DESC: Message
$l_pck_erno_401   ="Kan geen bestandsstructuur maken.";      //@DESC: Message
$l_pck_erno_999   ="Gereed met een aantal fouten";   //@DESC: Message


/* @FILE:editor.php */
$l_edt_but_save   ="Opslaan";                          // @DESC: Button; New:01
$l_edt_txt_t      ="tekst editor";                   // @DESC: Window title; New:01
$l_edt_err_nodata ="Document kon niet worden geladen."; //@DESC: Message; New:01
$l_edt_txt_fname  ="Document";                      // @DESC: Message: New:01
$l_edt_err_ns_tmp ="Kan niet opslaan: Geen toegang tot tijdelijk bestand"; //@DESC: Message: New:01
$l_edt_err_ns_mov ="Kan niet opslaan: Kan tijdelijk bestand niet verplaatsen.";  //@DESC: Message: New:01
$l_edt_err_ns_unlk="Kan niet opslaan: Kan oude bestand niet verwijderen.";      //@DESC: Message: New:01
$l_edt_err_gl_noac="Kan document niet laden: toegang geweigerd.";       //@DESC: Message: New:01
?>