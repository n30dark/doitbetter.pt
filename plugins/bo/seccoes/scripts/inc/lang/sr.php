<?php
/*MODF:	15:04:00,31.08.08*/

/* @FILE:<this> */
$l_language="Serbian Latin";              //@DESC: Language description
$l_file    =__FILE__;               //@DESC: Absolut path to file; @HANDLE: nedit
$l_shortcuts="sr";                  //@DESC: Shorthand symbol for language
$l_author  ="Sasa Spanovic";       //@DESC: Author's name
$l_author_m="spanovic@gmail.com";//@DESC: Author's email
$l_author_h="www.spanovic.info";      //@DESC: Author's homepage
$l_time="d.m.y H:i";                //@DESC: timeformat
$l_charset="UTF-8";              //@DESC: Charset

/* @FILE:index.php */
$l_idx_err_jsblk="Verovatno koristite program za blokiranje JavaScript/Ad-Blocker.<br/>Za pravilnu upotrebu ovog programa, savetujemo Vam da iskljucite taj program."; //@DESC: Message

/* @FILE:address.php */
$l_nav_t        ="Adresna linija";                //@DESC: Window title
$l_nav_back     ="nazad";                      //@DESC: Button
$l_nav_forward  ="napred";                   //@DESC: Button
$l_nav_open_dlm ="otvori download manager";     //@DESC: Button
$l_nav_browseUrl="idi na ovu adresu";        //@DESC: Button
$l_nav_multis_on="omoguci visestruki odabir"; //@DESC: Button
$l_nav_multis_of="onemoguci visestruki odabir";//@DESC: Button
$l_nav_crdir    ="kreiraj folder";             //@DESC: Button
$l_nav_search   ="Pretrazivanje"; 			   //@DESC: Buttton; New:02


/* @FILE:files.php */
$l_fil_t        ="file prikaz";               //@DESC: Window title
$l_fil_fname    ="naziv fajla";                //@DESC: Col
$l_fil_fdir     ="folder";						//@DESC: Row; New:02
$l_fil_atime    ="pristupljeno";                //@DESC: Col
$l_fil_mtime    ="ispravljeno";                //@DESC: Col
$l_fil_ctime    ="kreirano";                 //@DESC: Col
$l_fil_fsize    ="velicina";                    //@DESC: Col
$l_fil_chmod    ="permissions";             //@DESC: Col
$l_fil_asc      ="sortiraj u rastucem nizu";          //@DESC: Image
$l_fil_dsc      ="sortiraj u opadajucem nizu";         //@DESC: Image
$l_fil_download ="download (preuzmi)";                //@DESC: Menu item
$l_fil_view_hex ="otvori pomocu hex-view";      //@DESC: Menu item
$l_fil_view_html="otvori kao website";         //@DESC: Menu item
$l_fil_view_text="otvori kao tekstt";            //@DESC: Menu item
$l_fil_view_dia ="otvori kao slideshow";     //@DESC: Menu item
$l_fil_edit_text="edituj kao text";            //@DESC: Menu item; New:01
$l_fil_opendir  ="otvori";                    //@DESC: Menu item
$l_fil_preview  ="... ucitavam preview ..."; //@DESC: Image
$l_fil_ren      ="preimenuj";                  //@DESC: Menu item
$l_fil_renPrompt="Molim unesite novi naziv:";  //@DESC: Prompt
$l_fil_del      ="izbrisi";                  //@DESC: Menu item
$l_fil_del4f_p  ="Da li zaista zelite da izbrisete ovaj fajl '%name%'?";  //@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_del4d_p  ="Da li zaista zelite da izbrisete ovaj folder '%name%'?";//@DESC: Prompt; @REPLACE: %name% => file name;
$l_fil_delall   ="Da li zaista zelite da izbrisete sve ove fajlove?";     //@DESC: Prompt;
$l_fil_cpy      ="kopiraj u...";        //@DESC: Menu item
$l_fil_mov      ="premesti u...";        //@DESC: Menu item
$l_fil_chm      ="promeni dozvole";//@DESC: Menu item
$l_fil_zipcreate="kreiraj ZIP-arhivu";//@DESC: Menu item
$l_fil_zipextrct="otpakuj ZIP-arhivu";//@DESC: Menu item
$l_fil_crdir_pt	="Unesite naziv foldera:";//@DESC: Prompt
$l_fil_ndirname	="novi folder";        //@DESC: Button
$l_fil_srcname  ="trazi"; //@DESC: Button
$l_fil_srcpath  ="putanja"; //@DESC: Form
$l_fil_srcstp   ="stop"; //@DESC: Button

/* @FILE:folder.php */
$l_dvw_t        ="folder prikaz";  //@DESC: Window title

/* @FILE:upload.php */
$l_upl_t        ="menadzer upload-a (slanja)";//@DESC: Window title
$l_upl_expand   ="rasiri prikaz";        //@DESC: Button
$l_upl_collapse ="skupi prikaz";        //@DESC: Button

/* @FILE:uploadmod.php */
$l_upm_t        ="upload modul (modul slanja)";              //@DESC: Window title
$l_upm_nex_dir  ="Ciljani folder vec postoji.";        //@DESC: JS
$l_upm_2bigFsize="Fajl je premasio maximalno dozvoljenu velicinu."; //@DESC: JS
$l_upm_partly   ="Fajl je samo delimicno poslat.";         //@DESC: JS
$l_upm_nofile   ="Ni jedan fajl nije poslat.";                     //@DESC: JS
$l_upm_nofilemov="Nisam mogao da premestim fajl u ciljani folder.";//@DESC: JS
$l_upm_ren_file ="Fajl je preimenovan kako bi se izbeglo da se izbrise postojeci fajl sa datim imenom.";//@DESC: JS
$l_upm_uploading="Fajl se trenutno salje.";          //@DESC: Image
$l_upm_queueing ="Fajl stoji u redu za slanje.";         //@DESC: Image
$l_upm_savefile ="Posalji fajl";               //@DESC: Button
$l_upm_seldir   ="odaberi ciljni folder"; //@DESC: Button
$l_upm_infobox  ="Informacije\n=============";//@DESC: JS
$l_upm_errbox   ="Greska\n======";             //@DESC: JS

/* @FILE:foldersel.php */
$l_sld_t        ="odaberite folder";  //@DESC: Window title

/* @FILE:menu.php */
$l_men_inval_img="pogresan format slike";              //@DESC: Message
$l_men_no_rename="\"%f\" nije mogao biti preimenovan!";        //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_ren="ACCESS DENIED!\nNemate prava za preimenovanje."; //@DESC: JS
$l_men_no_delete="\"%f\" nije mogao biti izbrisan,\novo je mozda posledica nedostatka prava za brisanje,\ndrugi proces trenutno pristupa fajlu ili\n ovaj fajl nije postojeci (ne vise)!"; //@DESC: JS; @REPLACE: %f => file name;
$l_men_block_del="ACCESS DENIED!\nNemate prava za brisanje."; //@DESC: JS
$l_men_block_crd="ACCESS DENIED!\nNemate prava da kreirate folder.";       //@DESC: JS
$l_men_no_crdir ="Nisam mogao da kreiram folder.";            //@DESC: JS
$l_men_block_mNc="ACCESS DENIED!\nNemate prava da kopitare ili premestate fajl.";       //@DESC: JS
$l_men_mv_failed="Fajl \"%sfile%\"\nnije mogao biti premesten u\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %sfile% => source file; @REPLACE: %dfile% => destination file
$l_men_mv_f_ex  ="Premestanje nije uspelo: Ciljani fajl\n\"%dfile%\"\nvec postoji.";    //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_mv_d_nex ="Premestanje nije uspelo: Ciljani filder\n\"%dpath%\"\nnije postojeci.";  //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_mv_f_nex ="Premestanje nije uspelo: Izvorni fajl\n\"%sfile%\"\nnije postojeci.";         //@DESC: JS
$l_men_cy_failed="Fajl \"%sfile%\"\nnije mogao biti kopiran u\n\"%dfile%\"."; //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_f_ex  ="Kopiranje nije uspelo: Ciljni fajl\n\"%dfile%\"\nvec postoji.";   //@DESC: JS; @REPLACE: %dfile% => destination file
$l_men_cy_d_nex ="Kopiranje nije uspelo: Ciljani folder\n\"%dpath%\"\nnije postojeci."; //@DESC: JS; @REPLACE: %dpath% => destination path
$l_men_cy_f_nex ="Kopiranje nije uspelo: Izvorni fajl\n\"%sfile%\"\nnije postojeci.";        //@DESC: JS; @REPLACE: %sfile% => source file
$l_men_block_chm="PRISTUP ONEMOGUCEN!\\nNemate prava da menjate dozvole pristupa fajlu.";//@DESC: JS
$l_men_chm_nw   ="Greska prilikom promene dozvola pristupa za '%file%'.";//@DESC: JS; @REPLACE: %file% => file name
$l_men_chm_nex  ="Fajl \"%file%\" nije postojeci.";     //@DESC: JS; @REPLACE: %file% => file

/* @FILE:chmod.php */
$l_chm_t    ="menadzer dozvola pristupa"; //@DESC: Window title
$l_chm_r    ="citaj";    //@DESC: Col
$l_chm_w    ="pisi";   //@DESC: Col
$l_chm_x    ="izvrsi"; //@DESC: Col
$l_chm_owner="vlasnik";    //@DESC: Row
$l_chm_group="grupa";   //@DESC: Row
$l_chm_world="ostali";  //@DESC: Row
$l_chm_save ="sacuvaj";    //@DESC: Button

/* @FILE:viewer.php */
$l_viw_hx_th_hx ="hexadecimal"; //@DESC: Col
$l_viw_hx_th_tx ="tekst";        //@DESC: Col
$l_viw_hx_file  ="fajl";        //@DESC: Description
$l_viw_hx_page  ="stranica";        //@DESC: Description
$l_viw_hx_hex   ="Hex";         //@DESC: Description
$l_viw_hx_dec   ="Dec";         //@DESC: Description
$l_viw_hx_chr   ="Char";        //@DESC: Description
$l_viw_cp_dia   ="Slajdshow";   //@DESC: Description
$l_viw_cp_interv="Interval";    //@DESC: Description
$l_viw_cp_srt   ="start";       //@DESC: Description
$l_viw_cp_end   ="stop";        //@DESC: Description
$l_viw_cp_file  ="fajl";        //@DESC: Description
$l_viw_er_noread="Citanje iz fajla nije bilo moguce."; //@DESC: Message; #######NEW

/* @FILE:about:php */
$l_abt_t        ="O programu %PRGM_N%";        //@DESC: Window title Title; @REPLACE: %PRGM_N% => program name
$l_abt_akt_v    ="Trenutna verzija: %PRGM_V%";//@DESC: Message; @REPLACE: %PRGM_V% => program version
$l_abt_new_v_a  ="Najnovija verzija: %v_num% -&gt; %link_start%download%link_stop%";  //@DESC: Message; @REPLACE: %v_num% => new version number; @REPLACE: %link_start% => Downloadlink start; @REPLACE: %link_stop% => Downloadlink end
$l_abt_freew_by ='Freeware by <a href="http://www.bluevirus.ch.vu" target="_blank">bluevirus-design</a>.<br/>Hvala svima koji su prevodili:';  //@DESC: Message
$l_abt_langby   ="%lang% uradio %name%";       //@DESC: Message; @REPLACE: %lang% => language name; @REPLACE: %name% => author's name


/* @FILE:packer.php */
$l_pck_t          ="Arhiver (ZIP)";                      //@DESC: Window title
$l_dpck_t         ="De-arhiver (de-ZIP)";                    //@DESC: Window title
$l_pck_unpacking  ="... otpakujem ...";           //@DESC: Image  #########NEW
$l_pck_abort_op   ="Otkazi ZIP proces sa sledecom greskom:"; //@DESC: JS
$l_pck_start2zip  ="Startujem ZIP proces";        //@DESC: Button
$l_pck_def_zfile  ="ziparchive.zip";              //@DESC: Default input
$l_pck_choose_dir ="odaberite ciljani folder";   //@DESC: Button
$l_pck_erno_100   ="OK";                          //@DESC: Message
$l_pck_erno_101   ="Nije dat fajl.";              //@DESC: Message
$l_pck_erno_102   ="ZIP fajl ukazuje na folderr.";  //@DESC: Message
$l_pck_erno_103   ="ZIP fajl vec postoji.";     //@DESC: Message
$l_pck_erno_104   ="Nije moguce kreirati ZIP fajl.";    //@DESC: Message
$l_pck_erno_105   ="ZIP fajl nije postojeci.";    //@DESC: Message
$l_pck_erno_106   ="Nije moguce otvoriti ZIP fajl.";      //@DESC: Message
$l_pck_erno_201   ="Pogresna putanja do fajla";           //@DESC: Message
$l_pck_erno_202   ="Fajl/Folder nije postojeci."; //@DESC: Message
$l_pck_erno_301   ="Pogresna putanja do ZIP fajla.";   //@DESC: Message
$l_pck_erno_302   ="ZIP fajl sadrzi nepoznatu/pogresnu arhivu."; //@DESC: Message
$l_pck_erno_303   ="Pogresna putanja.";   //@DESC: Message
$l_pck_erno_304   ="Nije moguce kreirati ciljani folder.";  //@DESC: Message
$l_pck_erno_401   ="Nije moguce kreirati strukturu fajlova.";      //@DESC: Message
$l_pck_erno_999   ="Zavrseno sa nekim greskama";   //@DESC: Message


/* @FILE:editor.php */
$l_edt_but_save   ="Sacuvaj";                          // @DESC: Button; New:01
$l_edt_txt_t      ="tekst editor";                   // @DESC: Window title; New:01
$l_edt_err_nodata ="Nije bilo moguce ucitati dokumet."; //@DESC: Message; New:01
$l_edt_txt_fname  ="Dokument";                      // @DESC: Message: New:01
$l_edt_err_ns_tmp ="Nije bilo moguce sacuvati: Nije bilo moguce pristupiti privremenom fajlu."; //@DESC: Message: New:01
$l_edt_err_ns_mov ="Nije bilo moguce sacuvati: Nije moguce premestiti privremeni fajl.";  //@DESC: Message: New:01
$l_edt_err_ns_unlk="Nije bilo moguce sacuvati: Nije moguce izbrisati stari fajl.";      //@DESC: Message: New:01
$l_edt_err_gl_noac="Nije bilo moguce ucitati dokument: pristup nije dozvoljen.";       //@DESC: Message: New:01
?>