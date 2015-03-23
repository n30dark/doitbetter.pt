// JavaScript Document

function FV_search_opendir()
{
	if( movewin && !movewin.close )
		movewin.close();
		
	movewin=window.open("foldersel.php?nod="+urlencode(window.document.searchform.srch_path.value)+"&sd="+urlencode(window.document.searchform.srch_path.value),"",
				  		"dependent=yes, height=300, width=240, left=200, top=100, location=no, menubar=no, resizable=no, status=no, toolbar=no, scrollbars=yes");
	cont_action="FV_search_opendir2";	
}
function FV_search_opendir2(path)
{
	movewin=null;
	window.document.searchform.srch_path.value=path;
}

var FV_search_term,FV_search_path,FV_search_l_strt;
var FV_search_Paths,FV_search_PathsPos,FV_search_running=false;

/** Submit query for searching in a directory */
function FV_search_start()
{
	if( !FV_search_running )
	{
		FV_search_running=true;
		var sform=window.document.searchform;
		FV_search_term=sform.srch_term.value;
		FV_search_path=sform.srch_path.value;
		
		FV_search_l_strt=sform.srchbut.value;
		sform.srchbut.value=l_fil_srcstp;
		
		FV_search_Paths=new Array( FV_search_path );
		FV_search_PathsPos=0;
		
		var table=document.getElementById('fileviews_details');
		var first=table.firstChild;
		while( first!=table.lastChild && table.lastChild)
			table.removeChild(table.lastChild);
		all_items=new Array();
	
		FV_search_start2();
	}
	else
	{
		FV_search_PathsPos=FV_search_Paths.length;
		FV_search_start2();
	}
	return false;
}
function FV_search_start2()
{
	if(FV_search_PathsPos<FV_search_Paths.length)
	{
		var ergebnis=FV_search_Paths[FV_search_PathsPos].replace(/\/+/,'/');
		
		if( ergebnis.length > 40 )
			ergebnis='..'+ergebnis.substr(ergebnis.length-37);
		path=FV_search_PathsPos+"/"+FV_search_Paths.length+"    "+ergebnis;

		window.document.searchform.srch_path.value=path;
		dbg_addline('Sending search request for '+FV_search_term+' in \''+FV_search_Paths[FV_search_PathsPos]+'\' : '+FV_search_PathsPos);
		sendRequest('menu.php','do=srch&term='+urlencode(FV_search_term)+'&chf='+urlencode(FV_search_Paths[FV_search_PathsPos++]), REQUEST_GET, 79 );

		dbg_addline('After request: '+FV_search_PathsPos);
	}
	else
	{
		window.document.searchform.srchbut.value=FV_search_l_strt;
		window.document.searchform.srch_path.value=FV_search_path;
		FV_search_running=false;
	}
}

/** When ajaxs query returns from FV_search_start(), this function will be launched
 * @param string	Returning value from request */
function FV_search_startback(string)
{
	if( string!="NOQUERY" )
	{
		dbg_addline('while: '+FV_search_PathsPos);
	
		//	<#Subdirs>&&<#Hits>&&<basedir>&&<1.subdir>:: .. ::<n.subdir>&&<1.Hit Name>:: .. ::<1.Hit infos>@@ .. @@<last hit...>@@&&
		var ret=string.split('&&');
		var dirs =ret[3].split('::');
		//dbg_addline('Dirs: '+dirs);
		var files=ret[4].split('@@');
		//dbg_addline('Files: '+files);
		for(var i=0;i<ret[0];i++)
			FV_search_Paths[FV_search_Paths.length]=hexcode2string(ret[2])+'/'+hexcode2string(dirs[i]);
		for(var i=0;i<ret[1];i++)
		{
			var file=files[i].split('::');
			var count=all_items.length;
			all_items[count]={'name': hexcode2string(file[0]),'atime': file[1], 'mtime': file[2],
							  'ctime': file[3], 'size': file[4], 'chmod': file[5], 'path':hexcode2string(ret[2]) };
			FV_search_addLine(file[0],file[1],file[2],file[3],file[4],file[5],hexcode2string(ret[2]),file[6],count);
		}
	}
	
	if(document.all)	// IE display bug
		window.setTimeout('FV_search_start2()',5);
	else
		FV_search_start2();
}


FV_search_filecount=0;
/** Adds a line to file list
 * @param	filenamehex		Filename as hex string
 * @param	atime			Last access time
 * @param	mtime			Modification time
 * @param	ctime			Creation time
 * @param	filesize		File size
 * @param	chmod			Persmissions of file
 * @param	path			Path to file
 * @param	iconurl			Name for icon (theme/ico/<iconurl>.gif)
 * @param	count			Index of array in all_items var **/
function FV_search_addLine(filenamehex,atime,mtime,ctime,filesize,chmod,path,iconurl,count)
{
	filename=hexcode2string(filenamehex);
	var table=document.getElementById('fileviews_details');
	if( document.all )
	{
		tbody=document.createElement('tbody');
		table.appendChild(tbody);
		table=tbody;
	}
	var tr=   document.createElement('tr');
	table.appendChild(tr);
	var td1=  document.createElement('td');
	tr.appendChild(td1);
	td1.style.textAlign='left';
	td1.style.backgroundImage='url("theme/ico/'+iconurl+'.gif")';
	td1.style.backgroundRepeat='no-repeat';
	td1.className='unmarked';
	td1.id='fifo_'+FV_search_filecount;
	td1.onmouseup='drag_end()';
	td1.onmousedown='setTimeout("end_selection();",10);drag_start()';
	var td1a= document.createElement('a');
	td1.appendChild(td1a);
	td1a.ondblclick='stopmenu();download("'+filename+'")';
	td1a.href='javascript:fileinfo2("fifo_'+FV_search_filecount+'","'+filenamehex+'","'+atime+'","'+mtime+'","'+ctime+'","'+filesize+'","'+chmod+'","'+count+'");';
	td1a.innerHTML=filename;

	var td2=  document.createElement('td');
	tr.appendChild(td2);
	td2.style.textAlign='left';
	td2.innerHTML=(path);

	var td3=document.createElement('td');
	tr.appendChild(td3);
	td3.style.textAlign='right';
	td3.innerHTML=(filesize=="-1"?'':filesize);

	all_items[FV_search_filecount]={ 'name': filenamehex, 'atime': atime, 'mtime': mtime, 'ctime': ctime, 'size': filesize, 'chmod': chmod, 'path': path };
	FV_search_filecount++;
}
// allow only one selection
multi_selection_permanently_disable=true;

if( document.all )
	window.document.body.onselectstart="return true";