/*MODF:	22:15:00,14.03.07*/
/* Uploadmod Funktions */

//	Load loading picture
var img=new Image();
	img.src="theme/loading.gif";
function onloadf()
{	
	// Say parent that this thread is ready
	parent.thread[threadid]=1;
	// Get parent opener path...
	window.document.uploadform.uploaddir.value=parent.opener.window.document.addressform.hid_address.value;
	// bring to front
	window.focus();
}
function plantoupload()
{
	//	Has page been fully loaded and is not in any other upload procedure
	if( parent.thread[threadid]!=1 )
		return false;
	//	Is there a file to upload?
	if( window.document.uploadform.uploadfile.value=="" )
		return false;
	//	Everything is ok, set waiting in queue window
	queueing();
	parent.thread[threadid]=2;
}
function queueing()
{
	//window.setTimeout('document.getElementById(\'waiting\').style.display="inherit";',20);
	document.getElementById('waiting').style.display="block";
	parent.thread[threadid]=2;
}
function uploading()
{
	parent.thread[threadid]=0;
	img=document.getElementById('waitingimg')
	img.src="theme/loading.gif";
	img.alt=img.title=l_uploadinprogress;
	window.document.uploadform.submit();
}

parent.dirselwin[threadid]=null;
/** Opens the directory selection window */
function opendirsel()
{
  var pathabove=window.document.uploadform.uploaddir.value.split("/");
  var remelem=window.document.uploadform.uploaddir.value;
  pathabove=pathabove.join("/");
  
  if(!parent.dirselwin[threadid] || parent.dirselwin[threadid].closed)
    parent.dirselwin[threadid]=window.open("foldersel.php?nod="+urlencode(pathabove)+"&sd="+urlencode(remelem),"","dependent=yes, height=300, width=240, left=200, top=100, location=no, menubar=no, resizable=yes, status=no, toolbar=no, scrollbars=yes");
  else
    parent.dirselwin[threadid].focus();
}

/** a-must-be-defined-function for directory selection window ( opendirsel() )*/
function foldersel_onselect(path)
{
	window.document.uploadform.uploaddir.value=path;
}