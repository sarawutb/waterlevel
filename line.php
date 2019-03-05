 <?php
  

function send_LINE($msg){
 $access_token = 'KKcOBh5b2TiUvP+0v/EpKCjXDQB0285sLayp6aC/Y42u4gySrpgm8MQkqT5rBhpKqUnwvfK7yYlDFDMI2qey4YaZpZO4z8+y7qp62JuHyn9v65x6Fh3I7+1l6wdA4NdbWa5WGzU6cweJSJ5By5pdIwdB04t89/1O/w1cDnyilFU=
'; 

  $messages = [
        'type' => 'text',
        'text' => $msg
        //'text' => $text
      ];

      // Make a POST Request to Messaging API to reply to sender
      $url = 'https://api.line.me/v2/bot/message/push';
      $data = [

        'to' => 'U75a113bb4a54bf53f9d6abfea0cd844f',
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

?>
