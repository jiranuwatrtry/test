<?php    header ('Content-type: text/html ; charset=utf-8');

     
      
      
 
   
//$province = $_POST["province"];
//$province = "เชียงใหม่";
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
               foreach ($value as $k => $v) {  
                       //if( $v->Province == $province) {    
                foreach ($v as $ky => $vy) { 
                   

                    if($ky == 'Province'){echo "จังหวัด : ".$vy."\n"; } 
                    if($ky == 'StationNameTh'){echo "สถานีตรวจวัด : ".$vy."\n"; }                         
                    if($ky == 'Observe') {foreach ($vy as $kya => $vya) { 
                        
                        if($kya == 'Time') {  echo "วันที่ตรวจวัด  :  ".$vya."\n"; }
                        if($kya == 'Temperature') {foreach ($vya as $kyab => $vyab) { 
                            if($kyab == 'Value'){echo "อุณหภูมอากาศปัจจุบัน : ".$vyab."  Cํ"."\n";} }} 
                        
                        if($kya == 'MaxTemperature') {foreach ($vya as $kyab => $vyab) { 
                            if($kyab == 'Value'){echo "อุณหภูมสุงสุดใน24ชม.ที่ผ่านมา : ".$vyab."  Cํ"."\n";} }} 
            
                        if($kya == 'MinTemperature') {foreach ($vya as $kyab => $vyab) { 
                            if($kyab == 'Value'){echo "อุณหภูมต่ำสุดใน24ชม.ที่ผ่านมา  : ".$vyab."  Cํ"."\n";} }}
                        
                        if($kya == 'RelativeHumidity') {foreach ($vya as $kyab => $vyab) { 
                            if($kyab == 'Value'){echo "ค่าเฉลี่ยความชื้นสัมพัทธ์ : ".$vyab."  %"."\n";} }} 
                           
                        if($kya == 'WindSpeed') {foreach ($vya as $kyab => $vyab) { 
                            if($kyab == 'Value'){echo "ค่าเฉลี่ยความเร็วลม : ".$vyab."  km/h"."\n";} }}    
                        
                        if($kya == 'Rainfall') {foreach ($vya as $kyab => $vyab) { 
                            if($kyab == 'Value'){echo "ค่าเฉลี่ยปริมาณน้ำฝน : ".$vyab."  %"."\n"."\n";} }}
                        }}            
                } 
            //}    
                    
                    }
                }
                }
  

?>
