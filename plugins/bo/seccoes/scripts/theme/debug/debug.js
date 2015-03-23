if( typeof dbg_enabled == "undefined" )
  var dbg_enabled=false;
var dbg_path2dbg="theme/debug/";



// enable debug after website has fully loaded
if( navigator.appName.indexOf("Explorer") == -1 )
  window.addEventListener("load", dbg_init, false);   // mozilla doesn't like dom standard VV :(, all others than IE don't care
else
{
  window.onload=dbg_init;               // IE hates event listener
  window.setTimeout('dbg_init()',2000); // withing this, body should be loaded (hope so)
}

// include css
document.write('<link rel="stylesheet" href="'+dbg_path2dbg+'debug.css" type="text/css" media="all"/>');

var dbg_terminal=null;      //  terminal window object
var dbg_last_ts=new Date(); //  To calculate difference since last call
var dbg_is_minimized=true;  //  defines whether terminal is minimized or not
var dbg_terminal_stack="&nbsp; $ Welcome to dbg version 0.0.1 by bluevirus-design @ www.bluevirus.ch.vu<br/>"+  //  Storage for minimized stack
                      " &nbsp; &nbsp; ======================================================================<br/>";
var dbg_menu=null;
var dbg_menu_l=new Array();
// Define Menu items
  // Executing a string
dbg_menu_l[0]=new Object();
dbg_menu_l[0]['object'] =null;
dbg_menu_l[0]['src']    ='run.png';
dbg_menu_l[0]['exec']   ='dbg_run';
dbg_menu_l[0]['title']  ='Execute a command';
  // Reloading page
dbg_menu_l[1]=new Object();
dbg_menu_l[1]['object'] =null;
dbg_menu_l[1]['src']    ='reload2.png';
dbg_menu_l[1]['exec']   ='dbg_reload';
dbg_menu_l[1]['title']  ='Reload page';
  // show cookies
dbg_menu_l[2]=new Object();
dbg_menu_l[2]['object'] =null;
dbg_menu_l[2]['src']    ='cookie.png';
dbg_menu_l[2]['exec']   ='dbg_cookie';
dbg_menu_l[2]['title']  ='Show cookies';

/** Initializes Debugger */
function dbg_init()
{
  if( dbg_terminal!=null || ! dbg_enabled)
    return;
  // create div element 4 terminal
  dbg_terminal = document.createElement("div");
  dbg_terminal.appendChild(document.createTextNode(''));
  window.document.body.appendChild(dbg_terminal);
  dbg_terminal.innerHTML=dbg_terminal_stack;
  
  // create div element 4 menu
  dbg_menu = document.createElement("div");
  //dbg_menu.appendChild(document.createTextNode('seckel'));
  window.document.body.appendChild(dbg_menu);
  dbg_menu.className='dbg_menu';
  dbg_draw_menu();
  // insert handler for click on terminal
  dbg_addEventListener('click',dbg_terminal,dbg_toggle_minmax);
  
  // inser handler for error catching
  dbg_addEventListener('error',window,dbg_catcherror,true);

  dbg_minimize();
}

function dbg_draw_menu()
{
  for(var i=0;i<dbg_menu_l.length;i++)
  {
    // needs elemenet to be created first?
    if( dbg_menu_l[i]['object']==null )
    {
      dbg_menu_l[i]['object']=document.createElement('img');
      dbg_menu.appendChild(dbg_menu_l[i]['object']);
    }
    // Add source
    dbg_menu_l[i]['object'].src=dbg_path2dbg+dbg_menu_l[i]['src'];
    // Add handler
    dbg_addEventListener('click',dbg_menu_l[i]['object'],eval(dbg_menu_l[i]['exec']),false)
    // add infotext
    dbg_menu_l[i]['object'].title=dbg_menu_l[i]['object'].alt=dbg_menu_l[i]['title'];
  }
}

/** Adds an Event Listener to an Element
 * @param   event     STRING: On what event should this happen like: "click"
 * @param   object    OBJECT: Pointer to object
 * @param   execf     Function to be called, without () and "" like: my_function 
 * @param   before    optional: Should this function be called before handling by browser, default false */
function dbg_addEventListener(event,object,execf,before)
{
  if( typeof before == "undefined" )
    before=false;

  // insert handler
  if( navigator.appName.indexOf("Explorer") == -1 )
    object.addEventListener(event,execf,before);
  else
  {
    switch(event)
    {
      case 'click' :
        object.onclick=execf;
        break;
      case 'error' :
        object.onerror=execf;
        break;
      default:
        dbg_addline("Can not add event listener to object: Event "+event+" is unknown.",'red');
        break;
    }
  }
}

/** Prompts for a string and executes it */
var dbg_run_last_function=""; // last execution string
function dbg_run()
{
  var eingabe=prompt('JS-Fkt:',dbg_run_last_function);
  if(eingabe)
  {
    dbg_run_last_function=eingabe;
    dbg_addline('DBG: Executing JS-Fkt "'+dbg_run_last_function+'" returns '+eval(eingabe) );
  }
}

/** Minimizes terminal window */
function dbg_minimize()
{
  dbg_terminal_stack=dbg_terminal.innerHTML;
  dbg_terminal.innerHTML="";
  dbg_terminal.className="dbg_terminal_minimized";

  // set terminal's flag to minimized
  dbg_is_minimized=true;
  
  if( !dbg_enabled)
    dbg_terminal.style.display="none";
    
  dbg_terminal.title='Expand terminal window';
}

/** Maximizes Terminal window */
function dbg_maximize()
{
  dbg_terminal.innerHTML=dbg_terminal_stack;

  dbg_terminal.className="dbg_terminal";
  // set terminal's flag to maximizes
  dbg_is_minimized=false;
  // scroll to bottom
  dbg_terminal.scrollTop = dbg_terminal.scrollHeight;

  if( !dbg_enabled)
    dbg_terminal.style.display="none";

  dbg_terminal.title='Collapse terminal window';
}

/** Shows all cookie and opens terminal window if not already open */
function dbg_cookie()
{
  var color='lightgreen';
  // show terminal
  if( dbg_is_minimized )
    dbg_toggle_minmax();
  var str ="DBG: Cookies on '"+window.location.host+"':";
  var str2="";
  // generate title line
  for(var i=0;i<str.length;i++)
    str2+="=";
  
  dbg_addline(str,color);
  dbg_addline(str2,color,null,true);
  var cooks=document.cookie.split(';');
  for(var i=0;i<cooks.length;i++)
   dbg_addline(cooks[i],color,null,true);
}

/** toggles between minimation and maximation */
function dbg_toggle_minmax()
{
  if( dbg_is_minimized )
    dbg_maximize();
  else
    dbg_minimize();
}

/** Adding new line to terminal
 * @param   msg                 Message to add to terminal
 * @param   color               optional: Color of line
 * @param   klass               optional: Class of line
 * @param   linebelongs2above   optional: true: if this line belongs to the line above i*/
function dbg_addline(msg,color,klass,linebelongs2above)
{
  var time=Math.round(new Date()/1000)%120; // max 2 min
  var txt=( (dbg_is_minimized?dbg_terminal_stack:dbg_terminal.innerHTML)!=""?"<br/>":"")+              //new line is only needed if there's a line above
          "<span "+(color!=null?"style='color:"+color+"' ":"")+ //color requested?
          (klass!=null?"class='"+klass+"'":"")+                 //class given?
          ">&nbsp;"+time+" "+(linebelongs2above==true?"&nbsp;":"$")+           //is this new line with $
          " "+msg+"</span>";
  
  // Check if you can not add to normal terminal coz it's minimized
  if( dbg_is_minimized || dbg_terminal.innerHTML==null )
    dbg_terminal_stack+=txt;
  else
  {
    dbg_terminal.innerHTML+=txt;
    // scroll to bottom
    dbg_terminal.scrollTop = dbg_terminal.scrollHeight;
  }
}

/** adds new line to terminal */
function dbg_add_nl()
{
  dbg_addline("&nbsp;",null,null,true);
}

/** clears all terminal data */
function dbg_clear()
{
  dbg_terminal.innerHTML=dbg_terminal_stack="";
}

/** reloads page */
function dbg_reload()
{
  location.reload();
}

var dbg_lasterror=null;
/** catches all errors
 * @param   exception   Description of error  */
function dbg_catcherror(exception)
{
  /* In FF exception can be a string if it happens
     when opening the xmlHttpRequest.*/
  if (typeof exception == 'string')
    exception = new Error(exception);

  var fullMessage = ''
  var uri = ''
  var stack = ''
  var line = ''
      
  try
  {
    /* Don't use exception.toString since the JS spec
       does not require it to provide the error name or message
       (haven't tested to see if it matters though across browsers) */
    fullMessage = exception.name + ': ' + exception.message
    uri = exception.fileName
    stack = exception.stack
    // Firefox sometimes blows up here
    line = exception.lineNumber
  }
  catch (e)
  {
  }

  dbg_addline('JavaScript execution failed: at ' + uri + ": " + line);
  dbg_addline(fullMessage,null,null,true);
  dbg_lasterror=exception;
  return true;  // allow further execution
}
