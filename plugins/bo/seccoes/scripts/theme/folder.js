/*MODF:  22:15:00,14.03.07*/
/* Folder Funktions */

function expanddir(hexc)
{
  var ret=hexcode2string(hexc);
  window.location.href=thispage+"?od="+document.getElementById('opendirs').value+"&nod="+urlencode(ret);
}

function opendir(hexc,objn)
{
  //  De mark old one
  if(markednum!=null)
  document.getElementById('fn_sp_'+markednum).className="foldername";
  //  Mark new one  
  document.getElementById('fn_sp_'+objn).className="foldername marked";
  //  Run specified Fkt
  opendir_spec(hexc);
  //  Save num
  markednum=objn;
  //  Save Path
  markedname=hexcode2string(hexc);
}

function change2dir(folder)
{
  //alert(thispage+"?od="+document.getElementById('opendirs').value+"&s2d="+urlencode(folder.replace(/\\\'/,"'") ) );
  window.location.href=thispage+"?od="+document.getElementById('opendirs').value+"&s2d="+urlencode(folder);
}

function selectdir(hexc,objn)
{
  selectdir_spec(hexcode2string(hexc),objn);
}

function dirs_save_offset()
{
	if( navigator.appName.indexOf("Explorer") == -1 )
	{
		parent.folders_offsetX=window.pageXOffset;
		parent.folders_offsetY=window.pageYOffset;
	}
	else
	{
		obj=document.getElementById('folderlist');
		parent.folders_offsetX=obj.scrollLeft;
		parent.folders_offsetY=obj.scrollTop;
	}
}
function dirs_restore_offset()
{
	window.scrollTo(parent.folders_offsetX,parent.folders_offsetY);
}
function dirs_save_offset_pp()
{
	if( navigator.appName.indexOf("Explorer") == -1 )
	{
		opener.folders_offsetX=window.pageXOffset;
		opener.folders_offsetY=window.pageYOffset;
	}
	else
	{
		obj=document.getElementById('folderlist');
		opener.folders_offsetX=obj.scrollLeft;
		opener.folders_offsetY=obj.scrollTop;
	}
}
function dirs_restore_offset_pp()
{
	window.scrollTo(opener.folders_offsetX,opener.folders_offsetY);
}

document.onmousemove = MoveHandler;
var Xpos,Ypos;
function MoveHandler(e)
{
  if (!e) {
    Xpos = window.event.clientX + document.body.scrollLeft;
    Ypos = window.event.clientY + document.body.scrollTop;
  } else {
    Xpos = e.pageX;
    Ypos = e.pageY;
  }
  
  // if in frame (so that fileview-frame exists) and while dragging
  if( (typeof parent.fileview) != "undefined" &&
      (typeof parent.fileview.drag_enabled) != "undefined" &&
      parent.fileview.drag_enabled )
  {
    // display moving-icon
    drag_move(e);
  }
}
drag_select_item=null;
function drag_move(e)
{
  parent.fileview.document.getElementById('dragjob').style.display="none";
  obj=document.getElementById('dragjob');
  obj2=document.getElementById('dragjobcatcher');
  obj.style.display="block";
  obj.style.top=(Ypos-17)+"px";
  obj.style.left=(Xpos-27)+"px";
  obj2.style.top=(Ypos-4)+"px";
  obj2.style.left=(Xpos-4)+"px";
}
function drag_end()
{
  parent.fileview.drag_enabled=false;
  document.getElementById('dragjob').style.display="none"; 
  //alert( typeof drag_select_item +"\n"+drag_select_item  );
  if(drag_select_item!=null && typeof (parent.fileview.curdir) != "undefined" )
     parent.fileview.menu_action_move2(drag_select_item);
}
function drag_select(hexc)
{
  // check if object exists
  if( document.getElementById('dragjob') != null )
  {
    document.getElementById('dragjob').style.backgroundImage='url(theme/dragm_1.gif)';
    drag_select_item=hexcode2string(hexc);
  }
}
function drag_deselect()
{
  // check if object exists
  if( document.getElementById('dragjob') != null )
  {
    document.getElementById('dragjob').style.backgroundImage='url(theme/dragm_0.gif)';
    drag_select_item=null;
  }
}