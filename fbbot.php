<?php

$access_token = "EAACeO8sH1wwBAOqdR1h9GKt2HqHRKHcJP4RNvo18IfdlVNYyzObmIt4XGtN5gTOnrTBdyy6uktnsu93wUdTVAHQZBltZCVSnq4Vze5X06bpuRPGD2wqZB6jHto5QUkuOXzRuEsmX4PourZCkeSkFVmwMIPtbjYpAAyZCAXlsAgvqshxZBR16jG";
$verify_token = "ty_RTY";

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
				 $ch = curl_init(); 
        // set url สำหรับดึงข้อมูล 
        curl_setopt($ch, CURLOPT_URL, "http://www.csit.itsisaket.com/ptt.php"); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // ตัวแปร $output เก็บข้อมูลทั้งหมดที่ดึงมา 
        $output = curl_exec($ch); 
        
     
   
        // ปิดการเชื่อต่อ
        curl_close($ch);    
		            
				$messages = [
				'type' => 'text',
				'text' => $output
				];
	
				
			
			}else if($text == 'โทรศัพท์'){
								
							$messages = [
								'type' => 'text',
								'text' => $text1." : https://www.toteservice.com/MainEs/"
								];
					
			
			}else{
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text." : รับทราบครับ"
				
			];
			}
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
			
			
		}
	}
}
echo "OK";
		
