<?php header ('Content-type: text/html ; charset=utf-8');
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
	
				
			
			}else if(strpos($text, 'โทรศัพท์') !== false){
				$x_tra = str_replace("โทรศัพท์","", $text);
      				$pieces = explode(" ", $x_tra);
      				$tel = str_replace("","",$pieces[0]);
      		
								
							$messages = [
								'type' => 'text',
								'text' => $tel
								];
					

			
			}else if(strpos($text, 'แม็ก') !== false || strpos($text, 'พง') !== false || strpos($text, 'สน') !== false || strpos($text, 'ตี้') !== false){
				
      					$a=array("เป็นความจริงเลยเดียว","โกหกทั้งเพ","มันไม่ใช่ความจริง","แล้วไงล่ะ","หรอ");
					$random_keys=array_rand($a,2);
					 
								
							$messages = [
								'type' => 'text',
								'text' => $text." : ".$a[$random_keys[0]]
								];
					

			
			}else if(strpos($text, 'หวย') !== false ){
				
      					$h= rand(10,99);
					 
								
							$messages = [
								'type' => 'text',
								'text' => "หวยงวดหน้า คือ : ".$h
								];
					
			
			}else if(strpos($text, 'ผลบอล') !== false){
				$x_tra = str_replace("ผลบอล","", $text);
      				$pieces = explode("|", $x_tra);
    				$p1=str_replace("[","",$pieces[0]);
    				$p2=str_replace("]","",$pieces[1]);
					 
								$h= rand($p1,$p2);
							$messages = [
								'type' => 'text',
								'text' => "ผมคิดว่าทีม ".$h." ชนะครับ"
								];
					
			
			}else if (strpos($text, 'อากาศ') !== false){
				$x_tra = str_replace("อากาศ","", $text);
      				$pieces = explode(" ", $x_tra);
      				$_question = str_replace("","",$pieces[0]);
      		
				
				$ch = curl_init(); 

        // set url สำหรับดึงข้อมูล 
        curl_setopt($ch, CURLOPT_URL, "https://boiling-lake-75961.herokuapp.com/weather.php?province=$_question"); 

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
			}
// 			else{
// 			// Build message to reply back
// 			$messages = [
// 				'type' => 'text',
// 				'text' => $text." : รับทราบครับ"
				
// 			];
// 			}
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
