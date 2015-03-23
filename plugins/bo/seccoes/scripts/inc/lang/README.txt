How to make the translations
=============================
  PH Pexplorer offers multi-language support. To translate it to your favourite
  language behave as follow:
	1. Go to "inc/lang/" select a file that contains a language you understand
	2. Copy this file and rename it to '<ISO-639-1 alpha-2 code>.php'
	   (for some iso-639-1 examples, see below)
	3. Open it with your favourite editor and replace everything between
	   quotation marks. Also make sure you replace any non latin standard 
           letter to its corresponding html entities (may use 'htmlentities.php').
           Take care, some phrases are displayed in JavaScript. You you add a line-
           break like \n the whole script won't work.

  To test it:
	4. Delete the cookie and change your favourite language in your browser to 
	   the edited one.
			-- OR --
	5. Move all the other language files away from "inc/lang", in 
           inc/settings.php change $c_language="en"; to $c_language="**"; where **
           means the language file name without ".php" extension.
           Test it and move the language files back and undo changes in settings 
           file.

  Final step and most important step:
	6. Send me a copy (get E-Mail address from readme (about) in main directory)

  Be sure that you save your text files without any leading unicode-signature (BOM).


Some ISO-639-1 examples
========================

     Language                   # Alpha-2 code
  ==============================+===============
  English                       | en
  British English               | en-gb
  US English                    | en-us
  ------------------------------+---------------
  French                        | fr
  Canadien French               | fr-ca
  ------------------------------+---------------
  German                        | de
  Swiss German                  | de-ch
  ------------------------------+---------------
  Spanish                       | es
  Spanish of Spain / Castilian  | es-es
  ==============================+================

  If you have problem to find out your symbol, you can mail me. (get E-Mail address 
  from readme(about) in main directory)