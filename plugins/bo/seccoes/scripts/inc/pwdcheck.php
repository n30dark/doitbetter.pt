<?php
/*MODF: 08:54:00,10.07.07*/
/*	This script may not work if you are not using an apache webserver */

//	Text to show in login box
$loginbox_text="Please authenticate first before entering.";
//	Text to show if login was not successful
$access_denied="Access denied!";
//      Allow cleartext password:
$login_in_paintxt=true;

//	Possible login combinations
$logins = array( 
        // clear text passwords
        'user' => 'user1',
        
        // crytped passwords, get them with: crypt('<your password>','pw');
        'user' => 'pwK0Y7oJCIIfc'
	);

/*###########################
  ###   No changes below  ###
  ###########################
*/
//	preset no login
$login = false; 

//	If user send a login suggestion
if(isset($_SERVER['PHP_AUTH_USER']) and
	isset($logins[$_SERVER['PHP_AUTH_USER']])) 
{ 
  // User exists?
  if( isset($logins[$_SERVER['PHP_AUTH_USER']]) )
  {
    // Check for cleartext combinations
    if( ($logins[$_SERVER['PHP_AUTH_USER']] == $_SERVER['PHP_AUTH_PW']) && $login_in_paintxt )
      $login = true; 
  
    // Check for crypted password combinations
    if($logins[$_SERVER['PHP_AUTH_USER']] == crypt($_SERVER['PHP_AUTH_PW'], 'pw')) 
      $login = true; 
  }
} 

if(!$login) 
{ 
  header("WWW-Authenticate: Basic realm=\"$loginbox_text\""); 
  header('HTTP/1.0 401 Unauthorized'); 
  print("$access_denied"); 
  exit(401); 
}
?>