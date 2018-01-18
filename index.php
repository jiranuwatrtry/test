<html>
<body>

<?php

//รับตัวแปรจาก $_POST["name"] มาเก็บไว้ใน $Language
//$Language = $_POST["language"];
$Language = 'TH';	
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
              foreach ($xml  as  $key =>$val) {  
              
            if($val->PRICE != ''){
              echo $val->PRICE_DATE.'  '.$val->PRODUCT .'  ราคา  '.$val->PRICE.' บาท<br>';
                }

               }

?>
 
 <?
// Convert Variable Array To Variable
 
while(list($xVarName, $xVarvalue) = each($_GET)) {
     ${$xVarName} = $xVarvalue;
}
 
 
while(list($xVarName, $xVarvalue) = each($_POST)) {
     ${$xVarName} = $xVarvalue;
}
 
while(list($xVarName, $xVarvalue) = each($_FILES)) {
     ${$xVarName."_name"} = $xVarvalue['name'];
     ${$xVarName."_type"} = $xVarvalue['type'];
     ${$xVarName."_size"} = $xVarvalue['size'];
     ${$xVarName."_error"} = $xVarvalue['error'];
     ${$xVarName} = $xVarvalue['tmp_name'];
}
?>
</body>
</html>

