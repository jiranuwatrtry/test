<?php
$access_token = 'v8+dLBrQQq0eb26mIOI8TSJjhxsJFrAOaDz1MdncVOyRqv7mdtPTI6fxa6YsJbU16n40F+OTHzWarptr9kYgRGPZbxC+RvXYKPyG+uKxfExyvkfzap7Hw90e/E+IOofq0cv2a+ShZSR4DY3d/uJbGgdB04t89/1O/w1cDnyilFU=';
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
				
				

				// ที่อยู่ของเอกสาร WSDL ของเว็บเซอร์วิส ปตท");
				$wsdl = 'http://www.pttplc.com/webservice/pttinfo.asmx?WSDL';

				// สร้างออปเจกต์ SoapClient เพื่อเรียกใช้เว็บเซอร์วิส
				$client = new SoapClient($wsdl);


 
				// เมธอดที่ต้องการเรียกใช้ CurrentOilPrice
				$methodName = 'CurrentOilPrice';

				// อินพุตพารามิเตอร์ของเมธอด CurrentOilPrice คือ
				// Language ซึ่งเราตั้งค่าให้เป็นตัวแปร $Language
				$params = array('Language'=>'EN');

				// ระบุค่าของ SOAP Action URI
				$soapAction = 'http://www.pttplc.com/ptt_webservice/CurrentOilPrice';

				// ใช้ฟังก์ชัน _soapCall ในการเรียกเมธอดที่ระบุ
				// ต้องระบุพารามิเตอร์และ SOAP Action
				$objectResult = $client->__soapCall($methodName, array('parameters' => $params), array('soapaction' => $soapAction));

				// จะต้องดูค่าฟิลด์ที่ชื่อตรงกับชื่อของอิลิเมนต์ที่ระบุใน
				// Output Message ซึ่งในที่นี้ก็คือ
				// CurrentOilPriceResult
				//echo $objectResult->CurrentOilPriceResult;

				$ob = $objectResult->CurrentOilPriceResult;
				$xml = new SimpleXMLElement($ob);
           
				// PRICE_DATE , PRODUCT ,PRICE
				foreach ($xml  as  $key =>$val) {  
              
				if($val->PRICE != ''){
				//echo $val->PRICE_DATE.'  '.$val->PRODUCT .'  ราคา  '.$val->PRICE.' บาท<br>';
                
				$messages = [
				'type' => 'text',
				'text' => $val->PRODUCT .'  ราคา  '.$val->PRICE.' บาท<br>'
				];
				}

				}
				
			
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
			$url = 'https://api.line.me/v2/bot/message/reply';
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

