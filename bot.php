<?php
 require("pub.php");
 //require("line.php");
 require("botnew.php");

//

//

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON

$events = 'test';
// Validate parsed JSON data
/*
if (!is_null($events['ESP'])) {
	
	send_LINE($events['ESP']);
		
	echo "OK";
	}
	
*/

if (!is_null($events['events'])) {
	//send_LINE($events);
	
	//echo "line bot";
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back

			$Topic = "NodeMCU1" ;
			getMqttfromlineMsg($Topic,$text);
			   
			
		}
	}
	send_LINE($replyToken);
}
//$Topic = "NodeMCU1" ;
//$text = "Test";
//getMqttfromlineMsg($Topic,$text);

//echo "OK3";
?>
