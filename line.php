 <?php
  

function send_LINE($msg){
 $access_token = 'caLVtgWgsej7hg4QNhlp+6gwksxuzTwDm01l/k3YICFAGppKOp1Hg7Bhi3qeOcP8qUnwvfK7yYlDFDMI2qey4YaZpZO4z8+y7qp62JuHyn/JjyZYFLFFTi8X0OY899ViyXcYYwejOcbVq40Ga7nLIAdB04t89/1O/w1cDnyilFU=';

  $messages = [
        'type' => 'text',
        'text' => $msg
        //'text' => $text
      ];

      // Make a POST Request to Messaging API to reply to sender
      $url = 'https://api.line.me/v2/bot/message/push';
      $data = [
        'to' => '209e5c6454a48f0b09e83cbd1016a718',
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
