var HexChars="0123456789abcdef";
function nh(obj/*,darstellbar*/)
{
	if(last_nh!=null)
		last_nh.className=last_nh_class;
	
	last_nh=document.getElementById(obj);
		
	if(obj!=null)
	{
		// Darstellbar?
		darstellbar=( last_nh.className.indexOf('s') );

		last_nh_class=last_nh.className;
		if(last_nh_class.indexOf('h')==0)	// hex
		{
			if(darstellbar)
				last_nh.className="hh";
			else
				last_nh.className="hsh";
		}
		else
			if(darstellbar)
				last_nh.className="nh";
			else
				last_nh.className="nsh";
	}
}

last_txtobj=null;		// zuletzt geändertes Objekt bei TXT
last_hexobj=null;		// zuletzt geändertes Objekt bei HEX
last_type=null;			// letzter Typ, TXT=0, HEX=1
last_content=null;		// alter wert von ^^
/* Diese Funktion fügt ein input-Feld ein wo hingeklickt wird, damit lassen sich die Einträge Editieren
@param	num		Nummmer, welche zur Namensgebung der Id gehört (i.e. 151, bei ID=t151)
		type	Typenprefix, welcher zur Namensgebung der Id gehört, t=0, h=1; (i.e. 15, bei ID=t15)*/
function i(num,type)
{
	typ="";
	switch(type)
	{
		case 1:	typ="h"; break;
		case 0: typ="t"; break;
	}
	
	this_obj=document.getElementById(typ+num);
	if(this_obj.innerHTML.toLowerCase().indexOf('<input ')!=0)
	{
		if(last_txtobj!=null && last_type==0)
		{
			last_txtobj.innerHTML=last_content;
			if(last_txtobj.innerHTML<255)
			{
				last_hexobj.innerHTML=(last_content.charCodeAt(0)%256).toString(16);
				last_txtobj.className="n";
				last_hexobj.className="h";
			}
		}
		else if(last_hexobj!=null && last_type==1)
		{
			while(last_content.length<2)
				last_content="0"+last_content;
			last_hexobj.innerHTML=last_content.toLowerCase();
			numi=parseInt(last_content.toUpperCase(),16);

			// Zeichen darstellbar
			if( (31<numi && numi<127) || (160<numi && numi<256) )
			{
				last_txtobj.innerHTML=String.fromCharCode(numi);
				last_txtobj.className="n";
				last_hexobj.className="h";
				if(numi==32)	// Leerzeichen
					last_txtobj.innerHTML="&nbsp;";
			}
			//	Zeichen nicht darstellbar
			else
			{
				last_txtobj.innerHTML=inv_sign;
				last_txtobj.className="ns";
				last_hexobj.className="hs";
			}
		}
		last_txtobj=document.getElementById("t"+num);
		last_hexobj=document.getElementById("h"+num);
		last_type=type;
		switch(type)
		{
			case 1:
				last_content=last_hexobj.innerHTML;
				last_hexobj.innerHTML='<input type="text" AUTOCOMPLETE="off" id="textfeld" size="2" maxlength="2" onkeyup="iadv('+(num+1)+',\''+type+'\',this)" value="'+last_content+'" />';
				break;
			case 0:
				last_content=last_txtobj.innerHTML;
				last_txtobj.innerHTML='<input type="text" AUTOCOMPLETE="off" id="textfeld" size="1" maxlength="1" onkeyup="iadv('+(num+1)+',\''+type+'\',this)" value="'+last_content+'" />';
				break;
		}
		document.getElementById('textfeld').focus();
		document.getElementById('textfeld').select();
	}/**/
}
/*	Entscheided ob das nächste Input Feld generiert werden soll oder nicht
@param	num		Nummmer, welche zur Namensgebung der Id gehört (i.e. 151, bei ID=t151)
		type	Typenprefix, welcher zur Namensgebung der Id gehört, t=0, h=1; (i.e. 15, bei ID=t15)
		objnow	This-Wert vom aufrufenden Inputfeld*/
function iadv(num,type,objnow)
{
	// Kontrollieren ob gültige Zeichen als Hex eingegeben
	if(type==1)
	{
		oldval=objnow.value.toLowerCase();
		newval="";
		
		if(HexChars.indexOf(oldval.charAt(0))>=0)
			newval=oldval.charAt(0);
		if(HexChars.indexOf(oldval.charAt(1))>=0)
			newval+=oldval.charAt(1);
		if(oldval!=newval)
			objnow.value=newval;
	}
	last_content=objnow.value;
	window.status="lastkey="+lastkey+"\t lastkeycount="+lastkeycount+"\t lastkeycount2="+lastkeycount2+"\t objnow.length="+objnow.value.length+"\t type="+type;

	if(	(
		 ( (objnow.value.length==1 ||  objnow.value==inv_sign) && type==0) ||//	Bei Type==0==Textmode, muss Länge 1 sein; oder ...
		 (objnow.value.length==2 && type==1)								//	Bei Type==1==Hexmode, muss Länge 2 sein
		) &&																//	UND
	    ((40<lastkey && lastkey<127) || (160<lastkey && lastkey<257) ) &&	// Darstellbarer Key
	    (lastkeycount>lastkeycount2)										//	Zählende Keys müssen kleiner (genau eins) sein als gezählte
	   )
	{																		// dann nächstes Feld
		window.setTimeout("i("+num+","+type+")",1);							//	Geht nicht direkt
	}
	else if( (lastkey==37 || lastkey==63234 /*safari*/) && num>1 )			// zurückbutton und nicht erstes feld	
		window.setTimeout("i("+(num-2)+","+type+")",1);						//	Geht nicht direkt
	else if( (lastkey==13 || lastkey==39 || lastkey==63235) && 				// Enter- od. -> button und nächstes Feld existiert
			 document.getElementById( (type==0?"t":"h")+num ) )
	{
		window.setTimeout("i("+num+","+type+")",1);							//	Geht nicht direkt
	}
	else if( (lastkey==38 || lastkey==63232) &&								// ^ button und Obj, linie oben existiert.
			 document.getElementById( (type==0?"t":"h")+(num-1-nlat) ) )
		window.setTimeout("i("+(num-1-nlat)+","+type+")",1);//	Geht nicht direkt
		
	else if( (lastkey==40  || lastkey==63233) &&							//	v button
			 document.getElementById( (type==0?"t":"h")+(num-1+nlat) ) )
		window.setTimeout("i("+(num-1+nlat)+","+type+")",1);//	Geht nicht direkt

	
	lastkeycount2=lastkeycount;	// soll jeweils nur um eines grösser sein, Fehler wenn um mehr als eins grösser => daher net ++
	
	return false;
}

window.document.onkeypress=regkey;
lastkey=null;
lastkeycount=0;		// # Zählende Keys welche und gedrückte keys
lastkeycount2=0;	// # Abgezählte zählende Keys
function regkey(evt)
{
	lastkey=event.keyCode;
	if((31<lastkey && lastkey<127) || (160<lastkey && lastkey<257) )
		lastkeycount++;
}

function gdec(obj)
{
	document.getElementById('chr').value=String.fromCharCode(obj.value%256);
	document.getElementById('hex').value=(obj.value-0).toString(16);
}
function ghex(obj)
{
	document.getElementById('dec').value=(obj.value.length>0?parseInt(obj.value,16):"");
	document.getElementById('chr').value=String.fromCharCode(parseInt(obj.value,16)%256);
}
function gchr(obj)
{
	document.getElementById('dec').value=obj.value.charCodeAt(0);
	document.getElementById('hex').value=obj.value.charCodeAt(0).toString(16);
}