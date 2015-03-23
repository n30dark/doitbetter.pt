<?php
/*MODF:	22:15:00,14.03.07*/
function securl($URL)
{
	$URL=str_replace("\\'","'",$URL);
	//	Add / to end so it can match with ../ at the end too
	$URL.="/";
	//	Remove unwanted chars
	$URL=preg_replace("@([\"\<\>\*\?\|]){1,}@si","",$URL);
	//	There should only be a : on 2nd position
	$URL=preg_replace("@:@","",substr($URL,0,1) ).substr($URL,1,1).preg_replace("@:@","",substr($URL,2) );
	
	$tmp="";	// Last result from cleaning
	$max=256;
	//	Cleaning...
	do
	{
		$max--;
		//	Ersetze alle \ , ..\ , ../ , ./ , // durch /
		$tmp=$URL;
		//	Replace \ and // with /
		$URL=preg_replace("@([\/\\\\]{2,})@si","/",$URL);
		//	Replace  ../ and ./ with 
		$URL=preg_replace('/([\.]{1,})\//i','',$URL);
	}
	while($URL!=$tmp and $max>0);
	
	//	if max==0, than there has been something wrong or more problable someone cheating
	if($max==0)
		$URL=t_c_folder;
	
	// We want t_c_folder at the beginning of every string (e.g.: t_c_folder oder t_c_folder/something)
	$tmp=strpos($URL,t_c_folder."/");
	if( ($tmp===false or $tmp!=0) )
		$URL=t_c_folder."/".$URL;
	
	
	
	//	/ am Ende entfernen
	$URL=substr($URL,0,strlen($URL)-1);
	
	return $URL;
}

/*	Verwandlung von String in Hex folge getrennt durch : */
function string2jscode($string)
{
	$ret=array();
	for($i=0;$i<strlen($string);$i++)
		$ret[]=dechex(ord(substr($string,$i,1)));
	return implode(":",$ret);
}

function encode_ods($array)
{
	$string=implode("|",$array);
	$gz=base64_encode(gzcompress($string,9));
	return $gz;
}
function decode_ods($urldata)
{
	$gz=gzuncompress(base64_decode($urldata));
	return explode("|",$gz);
}
?>