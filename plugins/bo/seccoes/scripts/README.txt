0. Index        Version 0.4.7
================================
  1. Client - Minimum Requirements
  2. Server - Minimum Requirements
  3. Setting up PH Pexplorer
  4. php.ini
  5. Features
  6. Known bugs
  7. Translations
  8. License
  9. Warning
 10. Thanks
 11. About
 12. Links
 13. Version History


 1. Client - Minimum requirements
=================================
  - Javascript enabled and cookie accepting, modern Browser like:
    Opera 7+, Firefox 2+, Safari 1.3+ on Mac, Internet Explorer 7+


 2. Server - Minimum requirements
=================================
  Minimum:     - Webserver with PHP4 or higher
  Recommended: - PHP5 with
                 o GD2 (to create thumbnails of images),
                 o ffmpeg extensions (to create clips of movies)
                 o 'convert' from imagemagick-package (to create previews
                   of PDFs)
                 o zlib (PHP5) or ZZIPlib (PHP4) (un-/pack ZIP archives)

  Check links section for further informations.


 3. Setting up PH Pexplorer
=================================
  Open 'inc/settings.php' and make changes as you want. There is also a
  very simple login script that you can include by deleting the leading // 
  in  'inc/settings.php'-file on line 85 and alter it like that:
    include_once('inc/pwdcheck.php');
  To add a user open 'inc/pwdcheck.php' and add or modify users as given in
  the example. Between the entries there should be a komma and the entries
  themselves should be like:
                              'username1' => 'password1',
                              'username2' => 'password2',
                              'username3' => 'password3'

  I'd also suggest that you don't store your password in plain text. You
  can easily get the crypted password by creating a .php file containing this:
  
                            <?php echo crypt('<your password>','pw'); ?>
  
  The resulting string should be inserted to the array with the password,
  like:
                              'username1' => '<crypted password1>',
                              'username2' => '<crypted password2>'

  And you may also change the value of $login_in_plaintxt to false .
  
  For more, you'll be adviced to make this page viewable over SSL only to
  prevent submittion of data in plain text and you can also disable direct
  access to '/inc'.


 4. php.ini
=================================
  -> Depending on your configuration you've made in step 1, you
     may have to configure your 'php.ini' file (as it is written
     in 'inc/settings.php') and may restart your webserver


 5. Features
=================================
  -> Browsing file structure my mouse
  -> Go forward and back in history
  -> Display file informations
  -> Rename/delete/chmod/zip or move to/copy to any file(s) and/or folder(s)
     at once*
  -> Zip/download any file or folder
  -> Upload several files at once with upload manager
  -> Create folders
  -> Drag and drop file(s) and/or folders to the folder tree on the right**
  -> Preview images/movies***/PDFs with thumbnails or bigger size,
     optionally in slideshow
  -> View all files in hexviewer
  -> View text files in textviewer
  -> View html files directly from folder
  -> Editing text files

  *   Switch to multi-selection-mode by pressing SHIFT. Press SHIFT again to
      switch pack to single-selection. Alternatively you can also hold CTRL
      while selecting a file or mark an area by mouse
  **  Drag and drop does not work with Opera nor Safari correctly.
      But there is a trick:
      1. Select files
      2. Drag files over frameborder on the left
      3. Press CTRL-Button (or right mousebutton on Opera if possible) an release
      4. Release mouse button and hold it again
      5. Continue dragging to folder and release above it
  *** You can preview in movie scenes by sliding the scrollbar in menu or
      slideshow.


 6. Known bugs
=================================
  - Drag and drop problems with Opera and Safari. Check 'Features' to get to
    know how to trick this out.
  - Can not generate pdf-clips with convert from files with names containing '
  - If you click too fast, Firefox seems not to recognize that you've
    released the mouse button (MOUSEUP-event is not called)


 7. Translations
=================================
  PH Pexplorer offers multi-language support, check /inc/lang/README.txt for
  further informations. 

 8. License
=================================
  PH Pexplore is published under GNU/GPL license.
  This program is free and you can use it at no cost.

  HOWEVER, if you release a script, an application, a library or any kind of
  code including PH Pexplorer YOU MUST :
  - Release your work under GNU/GPL license (free software),
  - You must indicate in the documentation (or a readme file), that your work
    with PH Pexplorer , and make a reference to the author and the web site 
    www.bluevirus.ch.vu

  Please contact me if you plan to use this software for business.


 9. Warning
=================================
  This application and the associated files are non commercial, non professional
  work. It should not have unexpected results. However if any damage is caused
  by this software the author can not be held responsible.

  This program is distributed in the hope that it will be useful, but 
  WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
  or FITNESS FOR A PARTICULAR PURPOSE.

  The use of this software is at the risk of the user.


10. Thanks
=================================
  Thanks to all translators and bug reporters.


11. About
=================================
  PH Pexplorer is made by bluevirus design
  URL : www.bluevirus.ch.vu
  MAIL: stimpy_ch[AT]gmx.net
  If you like my program and want to appreciate my work you are free donate.


12. Links
=================================
  To use convert from imagemagick visit:  www.imagemagick.org
  To take advantage of php-ffmpeg:        ffmpeg-php.sourceforge.net
  ZZIPlib for php4:                       zziplib.sourceforge.net
  zlib for php5:                          www.gzip.org/zlib


13. Version History (from 0.4.0)
=================================
  Major modifications:
  (Legend: +F -> Feature added; +B -> Bug fixed; G General)
  0.4.7.1:
      +B Update checker
  0.4.7:
      +F Option to hide hidden (UNIX or Windows) files
      +B Filesize above 2GB displayable (thx to Rob's bug report)
      +B Pages switchable in hexviewer with files bigger than 2GiBs
      +F New Italian translation. Many thanx to milter.
      +F New Dutsh translation. Many thanx to Theun.
      +B Settings convert to quiet mode for better error recognition
      +F Some new icons ( oo )
  0.4.6:
      +B IE 6 couldn't display files.php (XML error)
      +F Use scrollwheel to navigate in movie (while being in menu or slideshow)
      +B Not displaying correct frame of movie on some server configurations
      +F "Wait for thumbnail in menu"-icon
      +B Cache for movie frames workes now
      +B Timeout for pdf creation corrected
      +F Creating (with aid of imagemagick) thumbnails of more filetypes
      +B movie timeline for firefox
      +B Scrollbars for "moving/copying to" folderviews
      +F cache size added to About window
      +F Search for filenames
  0.4.5:
      +B French language file does no more contain leading BOM
      +B <? -> <?php in /inc/2img/bmp.php
  0.4.4:
      +B Fileview type is displayed in client's desired language (if avail.)
      +F Translations: Spanish, Serbian and French (many thanks by the way)
       G Design changed in about.php
  0.4.3:
      +B Very short clicks no long switches to drag mode, but are still not 
         recognized as clicks, so menu does not appear (Firefox only).
      +B Directory selection windows is now resizable and scrollable
      +B Slideshow works now (bug reported by kry zwo)
      G  Slideshow change look to 0.4.x style
      +B Menuplacment for scrolled pages improved
      +B Corrected some English phrases
      G  New image-broken indicator
      +B Upload problem with IE
      +B Selecting folder in uploadmanager (Firefox)
  0.4.2:
      +B New menu placement in fileview to avoid scrollbars
      +B Saving files in text editor produced a double \ instead of singe ones
      G  Hide linenumbers in fileview
      +F New debug tool for js, the one from editor removed
      +B File saved from texteditor won't change file properties anymore (owner,
         group, permissions)
      +B Corrected path to blank.gif for invalid images
      +B if pdf2img conversion fails due to invalid format script aborts earlier
      +B Texteditor: Loading smaller text pieces for IE to prevent hang for
         several seconds due to encoding
      +B Diashow: Indication that image is loading
      +B Hiding menu immediatly after clicking another element in fileview
      +B Preview in menu for images with uppercase extension
      +B Bug in safari kept textarea for text editor small
      +B Move/Copy/ZIP/UnZIP works now with names containing several '
      +B Display thumbnails in clip view for extensions uppercase/mixed
      +F Allowing to cache generated images
  0.4.1: 
      +B Chmod should no more mess around
      +B Move/Copy/ZIP/UnZIP works now with names containing '
      G  Prevent user from starting zipping again while sill in progress
      +F Ability to edit text files
  0.4.0:
      G  Many lines have been rewritten, so the program is more or less completely new
      +F PDF conversion with imagick
      +F advanced previewing of movie files by scrolling in time