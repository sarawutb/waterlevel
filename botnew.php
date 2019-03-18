<?php
function send_LINE($msg){}

$API_URL = 'https://api.line.me/v2/bot/message/reply';
$ACCESS_TOKEN = 'W6j0/wKI5kGrpmHJWUjriP8Rxc8k3CwP7izdeCtIi8mNTaaNdb59Y5tLgdGl2bZoqUnwvfK7yYlDFDMI2qey4YaZpZO4z8+y7qp62JuHyn87PZ0qBjSMQ5BPH2NU+ZWSdGKd2dCjsoDMQ8vEACEUPwdB04t89/1O/w1cDnyilFU='; // Access Token ค่าที่เราสร้างขึ้น
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

if ( sizeof($request_array['events']) > 0 )
{

 foreach ($request_array['events'] as $event)
 {
  $reply_message = '';
  $reply_token = $event['replyToken'];

  if ( $event['type'] == 'message' ) 
  {
   if( $event['message']['type'] == 'text' )
   {
    $text = $event['message']['text'];
   // $reply_message = 'ระบบได้รับข้อความ ('.$text.') ของคุณแล้ว';
    if ($text == 'เปิด'){
       $reply_message = 'เปิดแล้วจ้า';
    }
    else if($text == 'ปิด'){
     $reply_message = 'ปิดแล้วจ้า!';
    }
    else if($text == 'ดูคำสั่ง'){
      
      $reply_message = "คำสั่งในระบบมีดีงนี้ค่ะ
      1. = ปิด : ปิดแล้ว
      2. = เปิด : เปิดแล้ว";
     }
   else if($text == 'ดูปริมาณน้ำ'){
      //exปริมาณน้ำ
      $at = 1000;
      $bf = 500;
      $reply_message = 'ปริมาณน้ำที่ใช้ไปของวันนี้คือ'.($at-$bf).'ลูกบาศก์เมตร';
   }
//เลือก
   else if($text == 'ตัวเลือก'){
      $reply_message = 'เลือกคำสั่ง
      1. ตอบ1
      2. ตอบ2
      3. ตอบ3
      ';
      for($i=0;$i<=5;i++){
         $reply_message = $i;
      }
   }

//
    else {
      $temp = rand(1,3);
      if($temp == 1){
         $reply_message = 'ขอโทษค่ะ ฉันไม่รู้จักคำสั่งนี้!';
      }
      else if($temp == 2){
         $reply_message = 'โปรดใช้คำสั่งใหม่ค่ะ!';
      }
      else if($temp == 3){
         $reply_message = 'ลองใหม่อีกครั้ง!';
      }
    }
   }
   else
    $reply_message = 'ระบบได้รับ '.ucfirst($event['message']['type']).' ของคุณแล้ว';
  }
  else
   $reply_message = 'ระบบได้รับ Event '.ucfirst($event['type']).' ของคุณแล้ว';
 
  if( strlen($reply_message) > 0 )
  {
   //$reply_message = iconv("tis-620","utf-8",$reply_message);
   $data = [
    'replyToken' => $reply_token,
    'messages' => [['type' => 'text', 'text' => $reply_message]]
   ];
   $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

   $send_result = send_reply_message($API_URL, $POST_HEADER, $post_body);
   echo "Result: ".$send_result."\r\n";
  }
 }
}

echo "OK";

function send_reply_message($url, $post_header, $post_body)
{
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 $result = curl_exec($ch);
 curl_close($ch);

 return $result;
}


?>
