/*MODF:	23:52:00,10.07.07*/
/* General Funktions */


/* Gets the position of any given object realtive to current frame
 * @param   obj   pointer to object
 * @return  array Array with x and y coordiantes of object  */
function getElementPosition(obj)
{
  var curleft = curtop = 0;
  if (obj.offsetParent)
  {
    curleft = obj.offsetLeft
    curtop = obj.offsetTop
    while (obj = obj.offsetParent)
    {
      curleft += obj.offsetLeft
      curtop += obj.offsetTop
    }
  }
  return [curleft,curtop];
}

/** Encodes a string to url string
 * @param   string  String to encode to url string
 * @return  String  Returns url encoded string */
function urlencode(string)
{
  var validsigns="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_.";
  var ret="";

  for(var i=0;i<string.length;i++)
    if( validsigns.indexOf(string.charAt(i))!=-1 )
        ret+=string.charAt(i);
    else
    {
      t=dechex(string.charCodeAt(i)).toUpperCase();
      while(t.length<2)
        t="0"+t;
      ret+="%"+t;
    }
  return ret;
}

/** Adds an Event Listener to an Element
 * @param   event     STRING: On what event should this happen like: "click"
 * @param   object    OBJECT: Pointer to object
 * @param   execf     Function to be called, without () and "" like: my_function 
 * @param   before    optional: Should this function be called before handling by browser, default false */
function AddEventListener(event,object,execf,before)
{
  if( typeof before == "undefined" )
    before=false;

  // insert handler
  if( navigator.appName.indexOf("Explorer") == -1 && navigator.userAgent.indexOf("Safari") == -1 )
  {
	if( (typeof window.opera) != "undefined" || event!="mousewheel")
   		object.addEventListener(event,execf,before);
	else
		object.addEventListener("DOMMouseScroll",execf,before);
		//AddEventListener('DOMMouseScroll',document.getElementById('previewd'),movie_navi_onmousewheel,true);
  }
  else
  {
    switch(event)
    {
	  case 'load' :
	  	object.onload=execf;
		break;
      case 'click' :
        object.onclick=execf;
        break;
      case 'error' :
        object.onerror=execf;
        break;
	  case 'mousewheel' :
	  	object.onmousewheel=execf;
		break;
      default:
        dbg_addline("Can not add event listener to object: Event "+event+" is unknown.",'red');
        break;
    }
  }
}

/** Decodes a hex encoded string to clear string
 * @param   hexc  Hex encoded string
 * @return  ret   Decoded clear text  */
function hexcode2string(hexc)
{
  if( hexc=="" || typeof hexc=="undefined" )
    return hexc;

  var arc=hexc.split(":");
  var ret="";

  for(var i=0;i<arc.length;i++)
   ret+=String.fromCharCode(hexdec(arc[i]));

  return ret;
}

/** Converts a hexadecimal number to a decimal one
 * @param   hex   Hexadecimal number
 * @return  int   Decimal number */
function hexdec(hex)
{
  var signs="0123456789ABCDEF";
  hex=hex.toUpperCase();
  
  var ret=0;
  for(var i=0;i<hex.length;i++)
  {
    ret*=16;
    ret+=signs.indexOf(hex.charAt(i));
  }
  return ret;
}

/** Converts a decimal number to a hexadecimal one
 * @param   dec     Decimal number
 * @return  String  Hexadecimal number */
function dechex(dec)
{
  return dec.toString(16);
}

/** Get element's height
 * @param   Elem    Element Id
 * @return  int     Elements height */
function getElementHeight(Elem)
{
  return document.getElementById(Elem).offsetHeight;
}

/** Get element's width
 * @param   Elem    Element Id
 * @return  int     Elements width */
function getElementWidth(Elem)
{
  return document.getElementById(Elem).offsetWidth;
}


/** */
function getInnerWindowDim()
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
  var ret=new Array();
  ret[0]=myWidth;
  ret[1]=myHeight;
  return ret;
}

Array.prototype.contains = function (elem)
{
  for (var i = 0; i < this.length; i++)
    if (this[i] == elem)
      return true;
  return false;
};

Array.prototype.strremove = function(str)
{
	for( var i=(this.length-1);i>=0;i--)
		if(this[i]==str)
			delete this[i];
};

String.prototype.file_ext = function()
{
	var p=this.lastIndexOf('.');
	return this.substr(Math.max(0,p));
};


