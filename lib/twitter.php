<?php
/*
Description: Twitter PHP code
Author: Andrew MacBean
Version: 1.0.0
*/

class Twitter{

/** Method to make twitter api call for the users timeline in XML */ 
function twitter_status($twitter_id) {	
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, "http://twitter.com/statuses/user_timeline/$twitter_id.xml");
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($c, CURLOPT_TIMEOUT, 5);
	$response = curl_exec($c);
	$responseInfo = curl_getinfo($c);
	curl_close($c);
	if (intval($responseInfo['http_code']) == 200) {
		if (class_exists('SimpleXMLElement')) {
			$xml = new SimpleXMLElement($response);
			return $xml;
		} else {
			return $response;
		}
	} else {
		return false;
	}
}

/** Method to add hyperlink html tags to any urls, twitter ids or hashtags in the tweet */ 
function processLinks($text) {
	$text = utf8_decode( $text );
	$text = preg_replace('@(https?://([-\w\.]+)+(d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>',  $text );
	$text = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $text);  
	$text = preg_replace("#(^|[\n ])\#([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://hashtags.org/search?query=\\2\" >#\\2</a>'", $text);
	return $text;
}

/** Main method to retrieve the tweets and return html for display */
function get_tweets($twitter_id, 
					$nooftweets=3, 
					$dateFormat="M d Y H:i:s", 
					$includeReplies=false, $dateTimeZone="Europe/London",
					$beforeTweetsHtml="<ul>", 
					$tweetStartHtml="<li class=\"tweet\"><span class=\"tweet-status\">",
					$tweetMiddleHtml="</span><br/><span class=\"tweet-details\">",
					$tweetEndHtml="</span></li>", 
					$afterTweetsHtml="</ul>") {

	date_default_timezone_set($dateTimeZone);
	$result = Array();
	$i=0;
   	if ( $twitter_xml = Twitter::twitter_status($twitter_id) ) {
		//$result = $beforeTweetsHtml;
		foreach ($twitter_xml->status as $key => $status) {
			if ($includeReplies == true | substr_count($status->text,"@") == 0 | strpos($status->text,"@") != 0) {
				$message = Twitter::processLinks($status->text);
				$res = "<div class='tweet_content'>".utf8_encode($message)."</div>";
				$ago = Twitter::timeago(strtotime($status->created_at));
				$source = $status->source;
				$res .= "<div class='tweet_info'>$ago via $source</div>";
				$result[$i] = $res;
				++$i;
				if ($i == $nooftweets) break;
    			}
    		}
    }
	return $result;
    
}

function timeago($referencedate=0, $timepointer='', $measureby='', $autotext=true){    ## Measureby can be: s, m, h, d, or y
    if($timepointer == '') $timepointer = time();
    $Raw = $timepointer-$referencedate;## Raw time difference
    $Clean = abs($Raw);
    $calcNum = array(array('s', 60), array('m', 60*60), array('h', 60*60*60), array('d', 60*60*60*24), array('y', 60*60*60*24*365));    ## Used for calculating
    $calc = array('s' => array(1, 'second'), 'm' => array(60, 'minute'), 'h' => array(60*60, 'hour'), 'd' => array(60*60*24, 'day'), 'y' => array(60*60*24*365, 'year'));    ## Used for units and determining actual differences per unit (there probably is a more efficient way to do this)
   
    if($measureby == ''){    ## Only use if nothing is referenced in the function parameters
        $usemeasure = 's';    ## Default unit
   
        for($i=0; $i<count($calcNum); $i++){    ## Loop through calcNum until we find a low enough unit
            if($Clean <= $calcNum[$i][1]){        ## Checks to see if the Raw is less than the unit, uses calcNum b/c system is based on seconds being 60
                $usemeasure = $calcNum[$i][0];    ## The if statement okayed the proposed unit, we will use this friendly key to output the time left
                $i = count($calcNum);            ## Skip all other units by maxing out the current loop position
            }       
        }
    }else{
        $usemeasure = $measureby;                ## Used if a unit is provided
    }
   
    $datedifference = floor($Clean/$calc[$usemeasure][0]);    ## Rounded date difference
   
    if($autotext==true && ($timepointer==time())){
        if($Raw < 0){
            $prospect = ' from now';
        }else{
            $prospect = ' ago';
        }
    }
   
    if($referencedate != 0){        ## Check to make sure a date in the past was supplied
        if($datedifference == 1){    ## Checks for grammar (plural/singular)
            return $datedifference . ' ' . $calc[$usemeasure][1] . ' ' . $prospect;
        }else{
            return $datedifference . ' ' . $calc[$usemeasure][1] . 's ' . $prospect;
        }
    }else{
        return 'No input time referenced.';
    }
}

}
?>