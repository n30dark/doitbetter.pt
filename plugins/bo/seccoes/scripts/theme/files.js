/*MODF: 23:52:00,10.07.07*/
/*	General Vars	*/
	/*	Selection */
var selection_on=false;
var selection_el=null;
var selection_s_x,selection_s_y=0;
var selection_flag_b4=null;
var selection_move_counter=0;
var multi_selection_permanently_disable=false;



var drag_enabled=false;
var drag_count  =0;
function drag_start()
{
  drag_enabled=true;
  drag_count=0;
}
function drag_move(e)
{
  parent.folderview.document.getElementById('dragjob').style.display="none";
  if(drag_enabled && (drag_count++)>4)
  {
    obj=document.getElementById('dragjob');
    obj.style.display="block";
    obj.style.top=(Ypos-17)+"px";
    obj.style.left=(Xpos-21)+"px";
  }
}
function drag_end()
{
  drag_enabled=false;
  document.getElementById('dragjob').style.display="none";
  drag_count=0;
}


/*  General Functions */
  /*  Selection */
/**  Displays highlighting area
 * @param e   Event Handle         */
function start_selection(e)
{
  if( multi_selection_permanently_disable )
  	return true; /**/
	
  if( Ypos < selectionOffsetY )
  	return;
  selection_on=true;
  selection_move_counter=0;
  selection_el=document.getElementById('selection');	
  selection_el.style.display="block";
  selection_s_x=Xpos;
  selection_s_y=Math.max(selectionOffsetY,Ypos);
  selection_el.style.top=Ypos+"px";
  selection_el.style.left=Xpos+"px";
  selection_el.style.width=selection_el.style.height="0";
}

/*	posQ=Array(oben,rechts,unten, links) -> f�r Eckpunkte*/
function move_inquader(posQ,coord)
{
  if( posQ[0]<=coord[1] && posQ[2]>=coord[1] && 
      posQ[3]<=coord[0] && posQ[1]>=coord[0] )
    return true;
  return false;
}

function move_selection(e)
{
  if(selection_on)
  {
    selection_move_counter++;
    var top=Math.max(selectionOffsetY,Math.max(0,Math.min(Ypos,selection_s_y)));
    var height=Math.max(Ypos,selection_s_y)-top;
    selection_el.style.top=top+"px";
    selection_el.style.height=height+"px";
    var left=Math.max(0,Math.min(Xpos,selection_s_x));
    var width=Math.max(Xpos,selection_s_x)-left;
    selection_el.style.left=left+"px";
    selection_el.style.width=width+"px";
    
    selection_flag_b4=parent.multiselect;
    parent.multiselect=true;
    for(i=0;i<all_items.length;i++)
    {
      var obj=document.getElementById('fifo_'+i);
      var pos=getElementPosition(obj);
      var exd=Array(pos[0]+parent.fileview.document.getElementById('fifo_0').offsetWidth,pos[1]+parent.fileview.document.getElementById('fifo_0').offsetHeight);
      var posQ=Array(pos[1],exd[0],exd[1],pos[0]);
      var posQ2=Array(top,left+width,top+height,left);

      if( move_inquader(posQ,[left,top]) || move_inquader(posQ,[left+width,top]) ||
          move_inquader(posQ,[left+width,top+height]) || move_inquader(posQ,[left,top+height]) || /* Eckpunkt von Selektion im Objekt? */
          move_inquader(posQ2,pos) || move_inquader(posQ2,exd) ||
          move_inquader(posQ2,[pos[0],exd[1]]) || move_inquader(posQ2,[exd[0],pos[1]]) ||         /* Eckpunkt von Objekt in Selektion? */
          top>=pos[1] && top<=exd[1] && left<pos[0] && (left+width)>exd[0] ||                     /* Obere Linie durch Objekt */
          (top+height)>=pos[1] && (top+height)<=exd[1] && left<pos[0] && (left+width)>exd[0] ||   /* Untere Linie durch Objekt */
          left>=pos[0] && left<=exd[0] && top<pos[1] && (top+height)>exd[1] ||                    /* Linke Linie durch Objekt */
          (left+width)>=pos[0] && (left+width)<=exd[0] && top<pos[1] && (top+height)>exd[1]       /* Rechte Linie durch Objekt */
          )
      {
        if(obj.className!="marked")
        {
          fileinfo("fifo_"+i,all_items[i]['name'],all_items[i]['atime'],all_items[i]['mtime'],all_items[i]['ctime'],all_items[i]['size'],all_items[i]['chmod']);
          stopmenu();
        }
      }
      else
        if(obj.className=="marked")
        {
          fileinfo("fifo_"+i,all_items[i]['name'],all_items[i]['atime'],all_items[i]['mtime'],all_items[i]['ctime'],all_items[i]['size'],all_items[i]['chmod']);
          stopmenu();
        }
    }
    parent.multiselect=selection_flag_b4;
  }
}

/* Fkt called when ending selection by cursor (on release mouse button)
 * @param  e   Event Caller */
function end_selection(e)
{
  if(selection_on && (selection_move_counter>4) )
  {
    for(var i=(selkeys.length-1);i>=0;i--)
      if( typeof(selkeys[i])!="undefined" )
      {
        menuinint=true;
        i=selkeys[i].substr(5);
        showinfo(all_items[i]['name'],all_items[i]['atime'],all_items[i]['mtime'],all_items[i]['ctime'],all_items[i]['size'],all_items[i]['chmod']);
        i=-1;
        menuinint=null;
      }
  }
  selection_on=false;
  
  try{
	  selection_el.style.display="none";
  }	catch(e) {};
}

/** Lets the browser download a given file
 * @param   file  Filename as plaintext */
function download(file)
{
  window.location.href="menu.php?do=dl&chf="+urlencode(curdir+"/"+file);
}

/** Displays the coresponding number of pressed key in a form
 * @param Ereignis  EventCaller */
function whatKeyWasPressed (Ereignis) {
  if (!Ereignis)
    Ereignis = window.event;
  if (Ereignis.which) {
    Tastencode = Ereignis.which;
  } else if (Ereignis.keyCode) {
    Tastencode = Ereignis.keyCode;
  }
  dbg_addline("[files.js] Releasing KEY " + Tastencode);
}

document.onkeydown = on_key_down;
document.onkeyup = on_key_up;
/** Called fkt after a key has been pressed
 * @param e   EventCaller */
function on_key_down(e)
{
  if (!e)
    e = window.event;
  if (e.which)
    Tastencode = e.which;
  else if (e.keyCode)
    Tastencode = e.keyCode;
  switch(Tastencode)
  {
    // CTRL
    case 17 :
      parent.multiselect=true;
      parent.pathview.checkmultiselect();
      dbg_addline("[files.js] CTRL-down: multiselection ON");
      break;
  }
}

/** Called fkt after a key has been released
 * @param e   EventCaller */
function on_key_up(e)
{
  if (!e)
    e = window.event;
  if (e.which)
    Tastencode = e.which;
  else if (e.keyCode)
    Tastencode = e.keyCode;
  switch(Tastencode)
  {
    // Shift
    case 16 :
      parent.multiselect=!parent.multiselect;
      parent.pathview.checkmultiselect();
      dbg_addline("[file.js] SHIFT-up: multiselection "+(parent.multiselect?"ON":"OFF"));
      break;
    // CTRL
    case 17 :
      parent.multiselect=false;
      parent.pathview.checkmultiselect();
      dbg_addline("[files.js] CTRL-up: multiselection OFF");
      break;
  }
}

/* Prevent menu from appearing while doubleclick */
var menuinint=null;		//	Menu Timer
var selelem ={};	//	Object Array of Selected Items
var selkeys =Array();	//	Array of key names of selected arrays

var lastobj=null;
/** First request for displaying the menu
 * @param cobj    Name of clicked object
 * @param name    Name of clicked file, hex coded
 * @param atime   last access (Formated-String)
 * @param mtime   last modification (Formated-String)
 * @param ctime   creation time (Formated-String)
 * @param size    Filesize (Formated-String), or -1 if dir
 * @param chmod   File mode (Formated-String)
 * @param index   Index in all_items array*/
function fileinfo2(cobj,name,atime,mtime,ctime,size,chmod,index)
{
	curdir=all_items[index]['path'];
	fileinfo(cobj,name,atime,mtime,ctime,size,chmod);
}
function fileinfo(cobj,name,atime,mtime,ctime,size,chmod)
{
  // hide menu
  document.getElementById('menu').style.display="none"
  
  // Select and marking clicked object: is Element not selected?
  if( !selkeys.contains(cobj)  )
  {	//	Select and register Element
    if( !parent.multiselect || multi_selection_permanently_disable )
    {
      for(var i=0;i<selkeys.length;i++)
        if( typeof(selkeys[i])!="undefined" )
          document.getElementById(selkeys[i]).className="unmarked";
      selelem={}; selkeys=Array();
    }
    selelem[cobj]={ 'self': cobj, 'name': name, 'atime': atime, 'mtime': mtime, 'ctime':ctime, 'size':size, 'chmod':chmod };
    selkeys[selkeys.length]=cobj;
    document.getElementById(cobj).className="marked";
    
    menuinint=window.setTimeout("showinfo('"+name+"','"+atime+"','"+mtime+"','"+ctime+"','"+size+"','"+chmod+"');",c_dblclktime_ms);
  }
  else
  { //else unregister and unmark Element
    selkeys.strremove(cobj);
    delete selelem[cobj];
    document.getElementById(cobj).className="unmarked";
  }
}

/** Final call to display the menu
 * @param name    Name of clicked file, hex coded
 * @param atime   last access (Formated-String)
 * @param mtime   last modification (Formated-String)
 * @param ctime   creation time (Formated-String)
 * @param size    Filesize (Formated-String), or -1 if dir
 * @param chmod   File mode (Formated-String) */
function showinfo(name,atime,mtime,ctime,size /*=-1 if isdir*/,chmod)
{
	// alert( name+"\n"+atime+"\n"+mtime+"\n"+ctime+"\n"+size+"\n"+chmod);
    // End any open selection
   // end_selection(null);
    
  name=hexcode2string(name);
  //	Has Fkt be called by timer that is still valid?
  if(menuinint!=null)
  {
    document.getElementById('menu_dblclk').innerHTML=(selkeys.length>1?"":(size==-1 )?l_opendir:l_download);
    document.getElementById('menu_dblclk').href="javascript:hide_fileinfo(true);"+((size==-1)?
    "parent.folderview.change2dir(curdir+\"/"+name.replace(/\'/,'\\\'')+"\")":
    "download(\""+urlencode(name)+"\")");
    //parent.folderview.change2dir(curdir+\"/\"+hexcode2string(\"".string2jscode($file['name'])."\"))":
    document.getElementById('menuplus').style.display=selkeys.length>1?"none":"block";
    //document.getElementById('menu_item1').innerHTML="";
    document.getElementById('menu_name').innerHTML=name;
    document.getElementById('menu_atime').innerHTML=atime;
    document.getElementById('menu_mtime').innerHTML=mtime;
    document.getElementById('menu_ctime').innerHTML=ctime;
    document.getElementById('menu_size').innerHTML=(size==-1 )?"-":size;
    document.getElementById('menu_chmod').innerHTML=chmod;
    
    // Imagepreview
    img_p=document.getElementById('preview');
    img_d=document.getElementById('previewd');
    if( c_img_type.contains( name.file_ext().toLowerCase() ) && selkeys.length<=1 && c_img_thb )
    {
      img_d.style.display="block";
      img_p.src="theme/leer.gif";
      img_p.src="menu.php?do=prv&chf="+urlencode(curdir+"/"+name);
      
      // adding video scollbars
      // Save videos name
      movie_navi_lastname=name;
      // reset video position
      movie_navi_slider_val=0;
    }
    else
    {
      img_d.style.display="none";
      img_p.src="theme/leer.gif";
    }

    menus=document.getElementById('menubt');
    insmenu="";
    insmenu+=gen_menuseparator();
    if(c_viewer && size!=-1)
    {
      insmenu+=gen_menubutton(l_view_hex,"viewer.php?type=0&amp;file="+urlencode(curdir+"/"+name));
      // html
      if( c_vw_ht_type.contains(name.file_ext().toLowerCase() ) )
        insmenu+=gen_menubutton(l_view_html,"viewer.php?type=1&amp;file="+urlencode(curdir+"/"+name));
      // text
      if( c_vw_tx_type.contains(name.file_ext().toLowerCase() ) && !c_edit )
        insmenu+=gen_menubutton(l_view_text,"viewer.php?type=3&amp;file="+urlencode(curdir+"/"+name));
      // images
      if( c_img_type.contains(name.file_ext().toLowerCase() ) )
        insmenu+=gen_menubutton(l_view_dia,"viewer.php?type=2&amp;file="+urlencode(curdir+"/"+name));

      insmenu+=gen_menuseparator();
    }
    
    //edit
    if(c_edit && size!=-1)
    {
      if( c_ed_tx_type.contains(name.file_ext().toLowerCase() ) )
        insmenu+=gen_menubutton(l_edit_text,"editor.php?type=1&amp;file="+urlencode(curdir+"/"+name));

      insmenu+=gen_menuseparator();
    }
    // Renaming row
    if(c_rename)
      insmenu+=gen_menubutton(l_ren,"javascript:menu_action_rename('"+name.replace(/\'/g,'\\\'')+"');");
    // Deleting row
    if(c_delete)
      insmenu+=gen_menubutton(l_del,"javascript:menu_action_delete('"+name.replace(/\'/g,'\\\'')+"',"+(size==-1?"true":"false")+");");
    // Move and copying row
    if(c_movcpy)
      insmenu+=gen_menubutton(l_cpy,"javascript:menu_action_copy();")+
                              gen_menubutton(l_mov,"javascript:menu_action_move();");
    // Changing file mode row
    if(c_chmod )
      insmenu+=gen_menubutton(l_chm,"javascript:menu_action_chmod('"+name.replace(/\'/g,'\\\'')+"');");
    // zipping row
    if(c_zip)
      insmenu+=gen_menubutton(selection_contains_ext(".zip")==1?l_zipextrct:l_zipcreate,"javascript:menu_action_zip('"+name.replace(/\'/g,'\\\'')+"');");

    // Paste buttons to menu
    menus.innerHTML=insmenu;
    
    // Display menu
    var winDim=getWindowDimension();
    var menu=document.getElementById('menu');
    menu.style.visibility="hidden";
    menu.style.display="block";
    var menubreite=getElementWidth('menu');
    var menuhohe=getElementHeight('menu');
    var offset=getWindowScrolls();
    dbg_addline( "[files.js] Window dimension: "+winDim+"\nWindow offset: "+offset+"\nMenu size: "+menubreite+","+menuhohe);

    // positionate window to the left of cursor
    if( (Xpos+menubreite)>winDim[0] && Xpos-menubreite>=0)
      menu.style.left=(Xpos-menubreite-1)+"px";
    else // or to the right
      menu.style.left=(Xpos+1)+"px";
    // positionate window above cursor
    if( (Ypos+menuhohe-offset[1])>winDim[1] && Ypos-offset[1]-menuhohe>=0)
      menu.style.top=(Ypos-menuhohe-1)+"px";
    else // or bellow
      menu.style.top=(Ypos+1)+"px";/**/
    menu.style.visibility="visible";
  }
  else
    hide_fileinfo();
}

/** Calculates dimension of current window
 * @return array( Window width, windows height); */
function getWindowDimension()
{
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
  return new Array(myWidth,myHeight);
}

/** Gets infos about how much the page has been scrolled */
function getWindowScrolls()
{
  // IE:
  if( typeof window.pageYOffset == "undefined" )
    return [window.scrollLeft,window.scrollTop];
  else
    return [window.pageXOffset,window.pageYOffset];
}

/** Repositionate movie navigation */
function movie_navi_draw(draw)
{
  // get Image Preview object
  var img_p=document.getElementById('preview');
  // get Navi-Bar and Navi-Pointer object and save as var
  var navi=document.getElementById('preview_movie_navi');
  var navi_tab=document.getElementById('preview_movie_navi_tab');

  // should slider be shown
  if( c_mov_type.contains( movie_navi_lastname.file_ext() ) )
  {
    // change visibility
    navi.style.display=( (draw || movie_navi_click_trigger )?"block":"none");
    // repositionate it
    var img_pos=getElementPosition(img_p);
    /*navi.style.top=img_pos[1]-img_p.height-1+"px"; //img_pos[1]+"px";
    window.status="Mouse: "+Ypos+"; Obj: "+img_pos[1]+"; Navi:"+blau[1]; //*/
    navi.style.left=(200-img_p.width)/2+"px";
    navi.style.width=img_p.width+"px";
    navi_tab.style.top="1px";
    navi_tab.style.left=movie_navi_slider_val+"px";
  }
  else
    navi.style.display="none";
  document.getElementById('previewwait').style.left=2+"px";
}

/** Handles onmousewheel event */
function movie_navi_onmousewheel(e)
{
	var delta;
	if( navigator.appName.indexOf("Explorer") != -1 )
		e=event;
	if( typeof e.wheelDelta != "undefined" )
	{
		delta=e.wheelDelta;
	}
	else
		delta=-e.detail*40;
	movie_navi_slider_val=Math.round(Math.max(0,Math.min(img_p.width-6,movie_navi_slider_val-(img_p.width/100*delta/24) )));
	percent=Math.round(Math.round(movie_navi_slider_val/(img_p.width-6)*100/5)*5);
	img_p.src="menu.php?do=prv&tp="+percent+"&chf="+urlencode(curdir+"/"+movie_navi_lastname);
	movie_navi_draw(true);
    document.getElementById('previewwait').style.visibility="visible";
	
	if (e.preventDefault)
                e.preventDefault();
	e.returnValue = false;
	//e.cancelBubble=true;
}

function movie_stopwaiting()
{
	window.setTimeout("document.getElementById('previewwait').style.visibility='hidden';",20);
}

/** Alter position of movie navigation bar */
var movie_navi_slider_val=0;
var movie_navi_click_trigger=false;
var movie_navi_lastname="";
function movie_navi_alter()
{
  movie_navi_click_trigger=true;
  // get pointer to object, objects position, objects width
  var obj=document.getElementById('preview_movie_navi');
  var objpos=getElementPosition(obj);
  var objwidth=obj.style.width;
    objwidth=objwidth.substr(0,objwidth.length-2);
  var objheight=20;
  
  /*alert( "mp: "+Xpos+", "+Ypos+"\nObjpos: "+objpos[0]+", "+objpos[1]+"\n"+
         "Objdim: "+objwidth+", "+objheight);/**/

  // is cursor over object
  if( Xpos>objpos[0] && Xpos<(objpos[0]+objwidth) &&
      Ypos>objpos[1] && Ypos<(objpos[1]+objheight) )
  {
    movie_navi_slider_val=(Xpos-2-objpos[0]);
    movie_navi_draw();
    img_p.src="menu.php?do=prv&tp="+Math.round(100/objwidth*(Xpos-objpos[0]) )+"&chf="+urlencode(curdir+"/"+movie_navi_lastname);
	document.getElementById('previewwait').style.visibility="visible";
  }
  
  window.setTimeout('movie_navi_click_trigger=false;',100);
}

function movie_navi_autoslide()
{
  
}

/** Checks if all selected file have same extension as given
 * @param extension Requested file extension that all selected file must have like '.zip'
 * @return   int value with amount of files, false if not all files do match */
function selection_contains_ext(extension)
{
  // counter for matching files
  var count=0;
  // eliminate casesensitivity
  extension=extension.toLowerCase();
  // for each selected file
  for (var i = 0; i < selkeys.length; i++)
  // check if stored values are still stored and have not been deleted
    if( typeof (selkeys) != 'undefined' &&
        typeof (selkeys[i])!='undefined' &&
        typeof (selelem)!='undefined' &&
        typeof (selelem[selkeys[i]])!='undefined' &&
        typeof (selelem[selkeys[i]]['name'])!='undefined'    )
    {
      // Get Filename, count matches up
      var filename=hexcode2string(selelem[selkeys[i]]['name']);
      count++;
      // if there was no match
      var res=filename.toLowerCase().lastIndexOf(extension);
      if( res!=(filename.length-extension.length) || res<0)
      //  report it
        return false;
    }
  // return amount of files
  return count;
};


/** Renames selected files
 * @param Filename of last file selected  */
function menu_action_rename(file)
{
  // hide menu
  hide_fileinfo(true);
  // prompt for new name
  var eingabe=prompt(l_renprompt,file);
  // if user did not cancel
  if( eingabe )
  {
    // create url
    var url="menu.php?do=ren&oname="+urlencode(file)+"&nname="+urlencode(eingabe)+"&path="+urlencode(curdir+"/")+"&";
    // add each file to url
    for(var i=0;i<selkeys.length;i++)
      if( typeof(selkeys[i])!="undefined" )
        url+="file[]="+urlencode(hexcode2string(selelem[selkeys[i]]['name']) )+"&";
    // submit request
    window.location.href=url;
  }
}

var movewin=null;
var cont_action=null;
/** Displays dialog for change file mode */
function menu_action_chmod()
{
  // Hide menu
  hide_fileinfo(true);
  
  // Calculating average values
    //owner ( r w x )  group( r w x )  world( r w x )
  var chmt=Array(Array( true, true, true),Array( true, true, true),Array( true, true, true));
  var chmi=Array('r','w','x');
  var chmn=Array(1,2,4);
  // Go through all files
  for(i=0;i<selkeys.length;i++)
  {
    if( typeof(selkeys[i]) != "undefined" && selkeys[i]!=null )
    {
      //	Split chmod of each file
      var chs=selelem[selkeys[i]]['chmod'].split(" ");
      //	go through each splitted up type (owner,group,word)
      for(z=0;z<3;z++)
        // go through all modi (r,w,x)
        for(y=0;y<3;y++)
          // if previous was selected and this too... it will remain selected
          chmt[z][y]=( chmt[z][y] && chs[z].charAt(y)==chmi[y] ) ;
    }
  }
  var chmodv=1000;
  for(i=0;i<3;i++)
    for(y=0;y<3;y++)
      chmodv+=Math.pow(10,2-i)*(chmt[i][y]?chmn[y]:0);
  chmodv=chmodv.toString().substr(1,3);

  if( movewin && !movewin.closed )
    movewin.close();

  movewin=window.open("chmod.php?mod="+chmodv,"",
                      "dependent=yes, height=100, width=280, left=200, top=100, location=no, menubar=no, resizable=no, status=no, toolbar=no");
  cont_action="menu_action_chmod2";
}

/** Changes mode of selected files
 * @param str Filemode-String like 777 or 710 */
function menu_action_chmod2(str)
{
  // create url
  var url="menu.php?do=chm&path="+urlencode(curdir+"/")+"&chm="+str+"&";
  // append every selected file in selection-array
  for(var i=0;i<selkeys.length;i++)
    // if it exists
    if( typeof(selkeys[i])!="undefined" )
      url+="file[]="+urlencode(hexcode2string(selelem[selkeys[i]]['name']) )+"&";
  // submit request
  window.location.href=url;
}

function menu_action_move()
{
	hide_fileinfo(true);
	
	if( movewin && !movewin.close )
		movewin.close();
		
	movewin=window.open("foldersel.php?nod="+urlencode(curdir)+"&sd="+urlencode(curdir),"",
				  		"dependent=yes, height=300, width=240, left=200, top=100, location=no, menubar=no, resizable=no, status=no, toolbar=no, scrollbars=yes");
	cont_action="menu_action_move2";
}

/** Submits query to move selected files to a given folder
 * @param path  String: Path to folder where selected files should be moved to */
function menu_action_move2(path)
{
  // is given path a string and not current path and is there any selection at all?
  if( (typeof path)=="string" && curdir!=path && selkeys.length>=1)
  {
    var url="menu.php?do=mov&path="+urlencode(curdir+"/")+"&dpath="+urlencode(path+"/")+"&";
    for(var i=0;i<selkeys.length;i++)
      if( typeof(selkeys[i])!="undefined" )
        url+="file[]="+urlencode(hexcode2string(selelem[selkeys[i]]['name']) )+"&";
    window.location.href=url;
  }
}

function menu_action_copy()
{
	hide_fileinfo(true);
	
	if( movewin && !movewin.close )
		movewin.close();
		
	movewin=window.open("foldersel.php?nod="+urlencode(curdir)+"&sd="+urlencode(curdir),"",
				  		"dependent=yes, height=300, width=240, left=200, top=100, location=no, menubar=no, resizable=no, status=no, toolbar=no, scrollbars=yes");
	cont_action="menu_action_copy2";
}

function menu_action_copy2(path)
{
	var url="menu.php?do=cpy&path="+urlencode(curdir+"/")+"&dpath="+urlencode(path+"/")+"&";
	for(var i=0;i<selkeys.length;i++)
		if( typeof(selkeys[i])!="undefined" )
			url+="file[]="+urlencode(hexcode2string(selelem[selkeys[i]]['name']) )+"&";
	window.location.href=url;
}

function menu_action_zip(lastelemname)
{
  var urladdon="";
  for(var i=0;i<selkeys.length;i++)
  if( typeof(selkeys[i])!="undefined" )
    urladdon+="file[]="+urlencode(hexcode2string(selelem[selkeys[i]]['name']))+"&";
  window.open("packer.php?chd="+urlencode(curdir)+"&"+urladdon,"",
              "dependent=yes, height=150, width=280, left=200, top=100, location=no, menubar=no, resizable=no, status=no, toolbar=no");
}

var moveOcopy2path=curdir;
function foldersel_onselect(path)
{
  moveOcopy2path=path;
  eval(cont_action+'("'+path+'");');
}

function chmodsel_onselect(str)
{
  eval(cont_action+'("'+str.replace(/\"/g,"\\\"")+'");');
}

function menu_action_delete(file,isdir)
{	
  hide_fileinfo(true);
  
  txt=(selkeys.length>1?l_del_all:(isdir?l_del4d_p:l_del4f_p));
  var eingabe=confirm(txt.replace(/\%name\%/,file) );
  if( eingabe )
  {
    //parent.fileview.selelem[parent.fileview.selkeys[0]]['name']
    var url="menu.php?do=del&";
    for(var i=0;i<selkeys.length;i++)
      if( typeof(selkeys[i])!="undefined" )
        url+="file[]="+urlencode(curdir+"/"+hexcode2string(selelem[selkeys[i]]['name']) )+"&";
    window.location.href=url;
  }
}
function menu_action_crdir()
{
  var eingabe=prompt(l_crdir_p,l_crdir_name);
  if(eingabe)
    window.location.href="menu.php?do=crdir&path="+urlencode(curdir)+"&name="+urlencode(eingabe);			
}
function gen_menuseparator()
{
  return '<div class="separator"></div>';
}
function gen_menubutton(title,href)
{
  return '<a class="menu_item1" onmouseout="menuaction(false);" onmouseover="menuaction(true);" href="'+href.replace(/\"/,"\\\"")+'">'+title+'</a>';
}
function hide_fileinfo()
{	hide_fileinfo(false)	}
function hide_fileinfo(forced)
{
  if(menuoutint!=null || forced)
    document.getElementById('menu').style.display="none";
}
function stopmenu()
{
  window.clearTimeout(menuinint);
  menuinint=null;
}
// Prevent selection in FF
document.onmousedown = function (evt) { if (evt && typeof evt.preventDefault != 'undefined') evt.preventDefault(); return false;  }
// Create Mouse capture handler
document.onmousemove = MoveHandler;
var Xpos,Ypos;
function MoveHandler(e)
{
  if (!e)
  {
    Xpos = window.event.x + document.body.scrollLeft;
    Ypos = window.event.y + document.body.scrollTop;
  }
  else
  {
    Xpos = e.pageX;
    Ypos = e.pageY;
  }
  //window.status="TOP: "+Xpos+", LEFT:"+Ypos+", SELECTION:"+selection_on+", DRAG: "+drag_enabled+", MULTISEL:"+parent.multiselect;

  if(selection_on)
    move_selection(e);
  if(drag_enabled)
    drag_move(e);
}


/* Prevent menu form disappearing */
var menuoutint=null;
function menuaction(v)
{
  if(v)
  {
    window.clearTimeout(menuoutint);
    menuoutint=null;
  }
  else
    menuoutint=window.setTimeout("hide_fileinfo()",200);
}

function onloadf()
{
  parent.history_back[parent.history_back.length]=curdir;
}