var currentline=0; 
var maxdata=65536/4;              //  max size for receiving packets. Bigger packages mean shorted loading time
if( navigator.appName.indexOf("Explorer") != -1 )
  maxdata=32768/8;                //  IE will hang if pieces are to big ( guess bigger than 2^15/max_char_size(=3+1) )
var save_max_piece_size=20480;    //  max size for transmittion
var linesheight=-1;
var texts=new Array();
var tmplinesheight=-1;

/** This function runs when page is fully loaded */
function startup()
{
  // first get infos about how many lines
  if( maxlines==-1)
  {
    get_lines();
    progressbar(0,true);
  }
  // then run by get_lines() continue initialising
  else
  {
    if(tmplinesheight==-1)
    {
      draw_editframe();
      tmplinesheight=linesheight;
      linesheight=100;
    }
    // load all text
    if( texts.length<Math.ceil(maxlines/maxdata) )
    {
      get_text(texts.length*maxdata,/*linesheight*/maxdata);
    }
    else
    {
      dbg_addline('Received all data.');
      setTimeout('progressbar(0,false)',200);
      linesheight=tmplinesheight;
    }
  }
}

/** redraws edit frame */
function draw_editframe()
{
  // calculates amounts of lines
  linesheight=Math.floor(getElementHeight('linenumbers')/19);
  dbg_addline("Linesheight: "+linesheight);

  // redraw linenumbers
  var cl=currentline+1; // get current line and convert from machine counting to human counting (+1)
  var linenumbs="";
  for(var i=0;i<linesheight;i++)
    linenumbs+=/*(cl++)+*/"<br/>";
  document.getElementById('linenumbers').innerHTML=linenumbs;

  // resize textarea
  var windim=getInnerWindowDim();
  document.getElementById('edittextarea').style.height=(windim[1]-26/*getElementHeight('linenumbers')*/-2)+"px";
  dbg_addline("Resize textarea to "+(getElementHeight('linenumbers')-2)+" resulting to "+document.getElementById('edittextarea').style.height);
}

/** Saves document */
var save_txttosave=null;        //  all text to save is here
var save_current_step=0;        //  Current piece for saving (not yet saved)
var save_progressing=false;     //  Save in progress
var save_tfilename=null;        //  Temporary Filename
function save()
{
  // check that there is now save in progress
  if(!save_progressing)
  {
    save_progressing=true;
    save_current_step=0;
    save_tfilename=null;
    save_txttosave=document.getElementById('edittextarea').value;
    dbg_addline('Save in progress. Filesize: '+save_txttosave.length);
    save_send_piece();
  }
  else
    dbg_addline('Can not save, there is already a save in progress.','red');
}

/** Saves a piece of document
 * @param   txt   Optional: Answer from server via ajax: STATENUMBER:MOVESTATE:MESSAGE */
function save_send_piece(txt)
{
  // any submittion to evaluate
  if(txt!=null)
  {
    var pieces=txt.split('|',3);
    if(pieces[0]!='1')
    {
      switch(pieces[0])
      {
        case '-2' :
          alert(l_err_no_tmp);
          dbg_addline('Can not save. Permissions denied to create/write temp file.','red');
          break;
        case '-4' :
          alert(l_err_no_ulk);
          dbg_addline('Can not save. Permissions denied to delete file.','red');
          break;
        default :
          dbg_addline('Bad return for saving query.','red');
          break;
      }
      save_progressing=false;
      setTimeout('progressbar(0,false)',200);
      return;
    }

    switch(pieces[1])
    {
      case '-3' :
          alert(l_err_no_mov);
          dbg_addline('Can not save. Permissions denied to move temp file.','red');
          save_progressing=false;
          setTimeout('progressbar(0,false)',200);
          return;
          break;
      case '1':
        dbg_addline('File successfully saved. '+txt);
        // unset status that there is a save in progress
        save_progressing=false;
        // hide progressbar
        setTimeout('progressbar(0,false)',200);
        return;
        break;
    }
    
    // saving filename
    save_tfilename=hexcode2string(pieces[2]);
  }

  // yet anything to save left?
  if( (save_current_step*save_max_piece_size)<=save_txttosave.length )
  {
    progressbar(save_current_step*save_max_piece_size/save_txttosave.length*100,true);
    var txt=save_txttosave.substr(save_current_step*save_max_piece_size,save_max_piece_size);
    dbg_addline('Encoding '+txt.length+' signs ...');
    var strt=new Date();
    var ctxt=urlencode(txt);
    dbg_addline('Encoding finished in '+(new Date()-strt)+'ms.');
    var createfile=(save_current_step==0);
    var endfile=((save_current_step*save_max_piece_size+save_max_piece_size)>=save_txttosave.length);
    dbg_addline('Submitting sings. '+(createfile?'Submitting with createfile option. ':'')+(endfile?'Submitting with endfile option. ':''));

    var q='type=2&file='+urlencode(file_shrt)+'&cmd=qsave&cmdtxt='+ctxt+(save_tfilename!=null?'&tfilename='+urlencode(save_tfilename):'')+(createfile?'&create=1':'')+(endfile?'&end=1':'');

    save_current_step++;

    sendRequest('editor.php',q,2,87);
  }
  else
    dbg_addline('Why am I here?','blue');
}


/** Gets amount of lines in textdocument */
function get_lines()
{
  dbg_addline("Querying amount of lines in document...");
  sendRequest( 'editor.php', 'type=2&file='+urlencode(file_shrt)+'&cmd=qline', 2, 89 );
}
/** Runs after request for amount of lines
 * @param txt   Amount of lines in document to save*/
function got_lines(txt)
{
  var cont=txt.split('|',2);
  var valB4=maxlines;
  maxlines=cont[1];
  if(cont[0]==1)
  {
    dbg_addline("Amount of lines in document: "+(cont[0]==1?cont[1]:txt));
  }
  if( valB4==-1 && cont[0]==1 )
    startup();
  else
    switch(cont[0])
    {
      case '-2' :
        dbg_addline("Error while catching amount of lines. Can not access file.");
        alert(l_err_gl_noc);
        break;
    }
}

/** Shows progressbar
 * @param   display   Displays (true) or hides (false) progressbar)*/
function progressbar(progress,display)
{
  if( !display )
    document.getElementById('progressbar').style.display="none";
  else
  {
    document.getElementById('progressbar').style.display="block";
    document.getElementById('progressvalue').style.width=progress+"%";
    document.getElementById('progresstext').innerHTML=Math.round(progress)+"%";
  }
}

/** Gets some lines
 * @param startingline  Defines the lines where to start reading
 * @param amount        Defines how many lines to read */
function get_text(startingline,amount)
{
  dbg_addline("Request data from "+startingline+"B plus "+amount+"B");
  sendRequest('editor.php','type=2&file='+urlencode(file_shrt)+'&cmd=qtext&from='+startingline+'&to='+amount, 2, 88 );
}
/** Runs after request for some lines
 * @param   txt   Hex encoded content of document */
function got_text(txt)
{
  var cont=txt.split('|',2);
  if( cont[0]==1 )
  {
    var ts=new Date();
    document.getElementById('edittextarea').value+=hexcode2string(cont[1]);
    texts[texts.length]=cont[1];
    dbg_addline("Got some lines, length: "+txt.length+". Encoding time: "+(new Date()-ts)+"ms.");
    progressbar(texts.length/(Math.ceil(maxlines/maxdata))*100,true);
    startup();
  }
  else
  {
    alert(l_err_nodata);
  }
}

var wrapped=false;  // is text wrapped?
/** Toggle between wrapping text and not wrapping it */
function togglewrap()
{
  dbg_addline('Toggle linewrap from '+document.getElementById('edittextarea').style.whiteSpace+' to '+(wrapped?'nowrap':'normal'));
  if( wrapped )
  {
    wrapped=false;
    document.getElementById('edittextarea').style.whiteSpace='nowrap';
  }
  else
  {
    wrapped=true;
    document.getElementById('edittextarea').style.whiteSpace='normal';
  }
}