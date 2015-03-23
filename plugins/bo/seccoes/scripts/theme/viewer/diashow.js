/*MODF: 14:48:00,22.07.07*/
var height=null;
var wheight=null;
var badmsie=(navigator.appName=="Microsoft Internet Explorer" && (navigator.appVersion.substr(navigator.appVersion.indexOf("MSIE ")+5,1)=="6") );

function changeimsize(forceres)
{
  if(height==null)
    height=document.getElementById('view').height;
  wheight=document.body.clientHeight; //  Opera
  if(wheight<10)                      //  Mozilla, IE, Safari
    wheight=document.documentElement.clientHeight;
  if( (height>(wheight-40) || (forceres && (wheight-40)<height)) && !badmsie )  //  Nur verkleinern falls n�tig
    window.setTimeout("document.getElementById('view').height="+(wheight-40)+";",20);

  document.getElementById('view').src=ilink;
}

/** Repositionate movie navigation */
function movie_navi_draw(draw)
{
  // get Image Preview object
  var img_p=document.getElementById('view');
  var img_pos=getElementPosition(img_p);
  // get Navi-Bar and Navi-Pointer object and save as var
  var navi=document.getElementById('preview_movie_navi');
  var navi_tab=document.getElementById('preview_movie_navi_tab');

  // should slider be shown
  if( c_mov_type.contains( curfile.file_ext() ) )
  {
    // change visibility
    navi.style.display=( (draw || movie_navi_click_trigger)?"block":"none");
    // repositionate it
    navi.style.left=img_pos[0]+"px";
    navi.style.top=img_pos[1]+"px";
    navi.style.width=img_p.width+"px";
    navi_tab.style.top="1px";
    navi_tab.style.left=movie_navi_slider_val+"px";
  }
  else
    navi.style.display="none";
}

/** Handles onmousewheel event */
function movie_navi_onmousewheel(e)
{
	dbg_addline("Mousewheeling : "+(typeof e),'red');
	
	var img_p=document.getElementById('view');
	var slider=document.getElementById('preview_movie_navi_tab');
	
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
	slider.style.left=movie_navi_slider_val+"px";
	var tmpimgsrc="menu.php?do=prv&typ=big&tp="+percent+"&chf="+urlencode(curdir+"/"+curfile);
	if( tmpimgsrc!=img_p.src)
	{
		img_p.src=tmpimgsrc;
    	document.getElementById('previewwait').style.visibility="visible";
	}
	
	if (e.preventDefault)
		e.preventDefault();
	e.returnValue = false;/**/
	//e.cancelBubble=true;
}

function movie_stopwaiting()
{
	window.setTimeout("document.getElementById('previewwait').style.visibility='hidden';",20);
}

/** Alter position */
var movie_navi_slider_val=0;
var movie_navi_click_trigger=false;
function movie_navi_alter()
{
  movie_navi_click_trigger=true;
  // get pointer to object, objects position, objects width
  var obj=document.getElementById('preview_movie_navi');
  var img_p=document.getElementById('view');
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
    img_p.src="menu.php?do=prv&typ=big&tp="+Math.round(100/objwidth*(Xpos-objpos[0]) )+"&chf="+urlencode(curdir+"/"+curfile);
  }
  window.setTimeout('movie_navi_click_trigger=false;',80);
  
  document.getElementById('previewwait').style.visibility="visible";
}

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
}