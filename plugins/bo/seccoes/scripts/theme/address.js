// JavaScript Document
/*	Function that will be executed at startup	*/
function onloadf()
{	
	checkmultiselect();
		
	if(parent.history_pressed_hist_button!=0)
		parent.history_pressed_hist_button--;
	else
		parent.history_forward=Array();
		
	// check for History backs and forwards
	if(parent.history_back.length>0)
	{
		var b=document.getElementById('h_back');
		b.src="theme/history_backward.gif";
		b.className="button";
		b.onclick='move_in_hist(false)';
		b.title+=": "+parent.history_back[parent.history_back.length-1];
	}
	if(parent.history_forward.length>0)
	{
		var b=document.getElementById('h_forw');
		b.src="theme/history_forward.gif";
		b.className="button";
		b.onclick='move_in_hist(true)';	
		b.title+=": "+parent.history_forward[parent.history_forward.length-1];
	}
	last_address=window.document.addressform.hid_address.value;
	startup_delayed();
}

function checkmultiselect()
{
	var b=document.getElementById('multis');

	if(parent.multiselect)
	{
		b.src="theme/multis_on3.gif";
		b.title=b.alt=l_multis_of;
	}
	else
	{
		b.src="theme/multis_off.gif";
		b.title=b.alt=l_multis_on;
	}
}

/*	v?forward:back	*/
function move_in_hist(v)
{
	var url=null;
	if(v)
	{
		// Get last prev. URL
		url=parent.history_forward[parent.history_forward.length-1];
		// Delete array Element
		var tary=Array();
		for(var i=0;i<(parent.history_forward.length-1);i++)
			tary[i]=parent.history_forward[i];
		parent.history_forward=tary;
		parent.history_pressed_hist_button=2;	
	}
	else
	{
		// Get last URL
		url=parent.history_back[parent.history_back.length-2];
		// Delete array Element
		var tary=Array();
		var i;
		for(i=0;i<(parent.history_back.length-2);i++)
			tary[i]=parent.history_back[i];
		parent.history_forward[parent.history_forward.length]=parent.history_back[i+1];
		parent.history_back=tary;
		parent.history_pressed_hist_button=2;
	}
	window.document.addressform.address.value=url;
	window.setTimeout('window.document.addressform.submit()',100);	// Opera bug
}

var uploadwin=null;
function openuploaddialogue()
{
	if(uploadwin && !uploadwin.closed )
		uploadwin.focus();
	else
		uploadwin=window.open("upload.php","",
				  "dependent=yes, height=115, width=240, left=200, top=100, location=no, menubar=no, resizable=no, status=no, toolbar=no");
}

var aboutwin=null
function about()
{
	if(aboutwin && !aboutwin.closed)
		aboutwin.focus();
	else
		aboutwin=window.open("about.php","","dependent=yes, height=180, width=300, left=100, top=100, location=no, menubar=no, resizable=no, status=no, toolbar=no, scrollbars=yes");
}

function alterfileview(obj)
{	
	parent.fileview.window.location.href="files.php?bf="+urlencode(last_address)+"&chfv="+obj.value;
}
function startsearch()
{
	parent.fileview.window.location.href="files.php?bf="+urlencode(last_address)+"&chfv=search";
}