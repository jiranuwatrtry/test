<?php
$access_token = '9c52ef9e-04be-4a73-a933-93824b979b09';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
					// Get replyToken
			$replyToken = $event['replyToken'];
			if($text == 'น้ำมัน'){
			$messages = [
				'type' => 'text',
				'text' => $text." : http://www.pttplc.com/th/getoilprice.aspx"
				];
			}else if($text == 'โทรศัพท์'){
			$messages = [
				'type' => 'text',
				'text' => $text." : https://www.toteservice.com/MainEs/"
				];
			}else{
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text." : รับทราบครับ"
				
			];
			}
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://m.me/1305226329532390?ref=1';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
			
			
		}
	}
}
echo "OK";
