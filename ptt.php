<?php

//รับตัวแปรจาก $_POST["name"] มาเก็บไว้ใน $Language
$Language = $_POST["language"];
echo 'Language : '.$Language.'<br>';

// ที่อยู่ของเอกสาร WSDL ของเว็บเซอร์วิส ปตท");
$wsdl = 'http://www.pttplc.com/webservice/pttinfo.asmx?WSDL';

// สร้างออปเจกต์ SoapClient เพื่อเรียกใช้เว็บเซอร์วิส
$client = new SoapClient($wsdl);


 
// เมธอดที่ต้องการเรียกใช้ CurrentOilPrice
$methodName = 'CurrentOilPrice';

// อินพุตพารามิเตอร์ของเมธอด CurrentOilPrice คือ
// Language ซึ่งเราตั้งค่าให้เป็นตัวแปร $Language
$params = array('Language'=>$Language);

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
              //foreach ($xml  as  $key =>$val) {  
              
           //if($val->PRICE != ''){
             // echo $val->PRICE_DATE.'  '.$val->PRODUCT .'  ราคา  '.$val->PRICE.' บาท<br>';
                
			//	}
//$ptt = json_encode($val);
//echo $ptt;

// $data_string = json_encode($val); //ทำให้เป็น json ด้วยฟังก์ชัน json_encode
 
// $ch = curl_init('http://localhost/ptt.php'); //ตรงนี้อย่าลืมเปลี่ยนเป็น url ที่ต้องการส่งค่าไปนะครับ
 
// //ในกรณีที่ต้องการส่งเป็น method อื่น เช่น DELETE, PUT, HEAD ก็เปลี่ยนได้ที่นี่ครับ
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json', //ระบุว่าค่าที่ส่งไปเป็นแบบ json
//     'Content-Length: ' . strlen($data_string))  //บอกขนาดของ json ที่ส่งไปด้วย
// );
 
// $result = curl_exec($ch);
// curl_close($ch);

     // } 
      
      echo json_encode($xml);     

?>

