<?php    header ('Content-type: text/html ; charset=utf-8');

     
      
      
 
   
$province = $_GET["province"];
// if (strpos($province, 'อากาศ') !== false) {
//       $x_tra = str_replace("อากาศ","", $province);
//       $pieces = explode(" ", $x_tra);
//       $_question = str_replace("/","",$pieces[0]);
      
    
//     }
       $ch = curl_init(); 

        //set url สำหรับดึงข้อมูล 
       curl_setopt($ch, CURLOPT_URL, "http://data.tmd.go.th/api/WeatherToday/V1/?type=json"); 

       // return the transfer as a string 
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

       // ตัวแปร $output เก็บข้อมูลทั้งหมดที่ดึงมา 
       $output = curl_exec($ch); 
        
       
        //  ปิดการเชื่อต่อ
       curl_close($ch);    
              // output ออกไปครับ
       //echo $output;
     
       $obj = json_decode($output);


       foreach ($obj as $key => $value) { 
              if($key == 'Stations'){  
               foreach ($value as $Stations_key => $Stations_value) {  
                       if($Stations_value->Province == $province) {    
                foreach ($Stations_value as $Stations_key_key => $Stations_value_value) { 
                   

                    if($Stations_key_key == 'Province'){echo "จังหวัด : ".$Stations_value_value."\n"; } 
                    if($Stations_key_key == 'StationNameTh'){echo "สถานีตรวจวัด : ".$Stations_value_value."\n"; }                         
                    if($Stations_key_key == 'Observe') {foreach ($Stations_value_value as $Observe_key => $Observe_value) { 
                        
                        if($Observe_key == 'Time') {  echo "วันที่ตรวจวัด  :  ".$Observe_value."\n"; }
                        if($Observe_key == 'Temperature') {foreach ($Observe_value as $Temperature_key => $Temperature_value) { 
                            if($Temperature_key == 'Value'){echo "อุณหภูมอากาศปัจจุบัน : ".$Temperature_value."  Cํ"."\n";} }} 
                        
                        if($Observe_key == 'MaxTemperature') {foreach ($Observe_value as $Temperature_key => $Temperature_value) { 
                            if($Temperature_key == 'Value'){echo "อุณหภูมสุงสุดใน24ชม.ที่ผ่านมา : ".$Temperature_value."  Cํ"."\n";} }} 
            
                        if($Observe_key == 'MinTemperature') {foreach ($Observe_value as $Temperature_key => $Temperature_value) { 
                            if($Temperature_key == 'Value'){echo "อุณหภูมต่ำสุดใน24ชม.ที่ผ่านมา  : ".$Temperature_value."  Cํ"."\n";} }}
                        
                        if($Observe_key == 'RelativeHumidity') {foreach ($Observe_value as $Temperature_key => $Temperature_value) { 
                            if($Temperature_key == 'Value'){echo "ค่าเฉลี่ยความชื้นสัมพัทธ์ : ".$Temperature_value."  %"."\n";} }} 
                           
                        if($Observe_key == 'WindSpeed') {foreach ($Observe_value as $Temperature_key => $Temperature_value) { 
                            if($Temperature_key == 'Value'){echo "ค่าเฉลี่ยความเร็วลม : ".$Temperature_value."  km/h"."\n";} }}    
                        
                        if($Observe_key == 'Rainfall') {foreach ($Observe_value as $Temperature_key => $Temperature_value) { 
                            if($Temperature_key == 'Value'){echo "ค่าเฉลี่ยปริมาณน้ำฝน : ".$Temperature_value."  %"."\n"."\n";} }}
                        }}            
                } 
            }    
                    
                    }
                }
                }
  

?>
