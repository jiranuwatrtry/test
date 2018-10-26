<?php header ('Content-type: text/html ; charset=utf-8');


$access_token = 'rQjaiK5DMZ2/+Avc1qu5SGbhELh2RUOSMiyMFCyAI7BiNw41s++c5niONbko8vOwfUS+FbeHPYHMoHiL2P8XqYIckcRWQhpitoH8vy5JE6oSgT1GckYtUnSSIqAeu+7w1SZlECWoeyzc1fTb7dx/fgdB04t89/1O/w1cDnyilFU=';
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
			$userId = $event['source']['userId'];
			$groupId = $event['source']['groupId'];
			$text = $event['message']['text'];
					// Get replyToken
			$replyToken = $event['replyToken'];
			if(strpos($text, 'น้ำมัน') !== false){
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
	
				
			
			}else if(strpos($text, 'ลงทะเบียน') !== false){
				$x_tra = str_replace("ลงทะเบียน","", $text);
      				
				$service_no = $x_tra;
      				
				

				$lineid ="Ua40f0a45c80487921763376ed0b72cf4";
	$access_token = 'v8+dLBrQQq0eb26mIOI8TSJjhxsJFrAOaDz1MdncVOyRqv7mdtPTI6fxa6YsJbU16n40F+OTHzWarptr9kYgRGPZbxC+RvXYKPyG+uKxfExyvkfzap7Hw90e/E+IOofq0cv2a+ShZSR4DY3d/uJbGgdB04t89/1O/w1cDnyilFU=';
	$url = 'https://api.line.me/v2/bot/message/push';
	$data = array("to"=> "$lineid",
		"messages"=>array(array(
				 
					  "type"=>"text",
					  "text"=>"เลขหมายบริการ ".$service_no." id_line ".$userId." ต้องการลงทะเบียน line Bill"
					  )
			 ));
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



			$messages = [
					'type' => 'text',
					'text' => "ระบบได้ส่งคำขอใช้บริการ  line Bill ของท่านแล้ว เมื่อดำเนินการแล้วเสร็จ ระบบจะแจ้งเตือนให้ท่านทราบครับ"
				];
					

			
			}else if(strpos($text, 'balance') !== false){
				
      					
			$ch = curl_init(); 

        		// set url สำหรับดึงข้อมูล 
        		curl_setopt($ch, CURLOPT_URL, "http://93.190.51.85:8080/ChatBOTData/LineGetBalanceWS?line_id=$userId"); 

        		//return the transfer as a string 
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        		// ตัวแปร $output เก็บข้อมูลทั้งหมดที่ดึงมา 
        		$output = curl_exec($ch); 
             		// ปิดการเชื่อต่อ
        		curl_close($ch); 
				$output = str_replace("@@POPUP@@","", $output);
				$output = str_replace("{","", $output);
    				$output = str_replace(";","\n", $output);
    				$output = str_replace("}","", $output);
    				$output = str_replace("[","", $output);
    				$output = str_replace("]","", $output);
    				$output = str_replace("service_no","เลขหมายบริการ", $output);
    				$output = str_replace("response","", $output);
    				$output = str_replace(":","", $output);
    				$output = str_replace(",","", $output);
    				$output = str_replace('"','', $output);
							$messages = [
								'type' => 'text',
								'text' => $output
								];
					

			
			
			}else if(strpos($text, 'หวยงวดนี้') !== false ){
					$h1= rand(0,9);
					$h2= rand(1,9);
					$h3= rand(0,9);
					$h4= rand(0,9);
      					$h5= rand(1,9);
					 
								
							$messages = [
								'type' => 'text',
								'text' => "หวยงวดนี้ผมคิดว่า สามตัวมี : ".$h1.$h2.$h3."  และสองตัวมี : ".$h4.$h5 ." แน่นอนครับ"
								];
					
			
			}else if(strpos($text, 'ผลบอล') !== false){
				$x_tra = str_replace("ผลบอล","", $text);
      				$pieces = explode("|", $x_tra);
				$a=array("เสมอกับ","แพ้","ชนะ");
					$random_keys=array_rand($a,2);
					
				
							$messages = [
								'type' => 'text',
								'text' => "ผมคิดว่าทีม ".$pieces[0]." ".$a[$random_keys[0]]." ทีม ".$pieces[1]." ครับ"
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
			else if(strpos($text, 'groupid') !== false){
			// Build message to reply back
				   
				
			$messages = [
				
				'type' => 'text',
				'text' => $groupId
				
				
			];
				
			}else if(strpos($text, 'id') !== false){
			// Build message to reply back
				   
				
			$messages = [
				
				'type' => 'text',
				'text' => $userId
				
				
			];
				
			}else{
			// Build message to reply back
			

			
						
				
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
