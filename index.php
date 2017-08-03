<?php
 
$strAccessToken = "ACCESS_TOKEN";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {7c+ImaVslAA9wD7zMWNjhOp8ytN2aQSGObYR0bdPF8h+rquZbaj2lwbN1Wu5gvv6GgOJCdshGRc1BL7Ugd0EfPncKufz0/gq0/1nqIn7t8quV5fIau1JTwmOckAOYVVpNdLtUFY7Tj7eWyr9imyXjgdB04t89/1O/w1cDnyilFU=}";
 
if($arrJson['events'][0]['message']['text'] == "สวัสดี"||"ดีจ้า"||"อันยอง"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ดีจ้าอันยองเราชื่ออึนฮานะเป็นBotแชทสำหรับให้ข้อมูลท่องเที่ยวเกาหลีของKwan";
}else if($arrJson['events'][0]['message']['text'] == "ชื่ออะไร"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "imagemap";
  $arrPostData['messages'][0]['baseUrl'] = "https://f.ptcdn.info/625/046/000/oew2o2chebLyLzFxttl-o.jpg";
  $arrPostData['messages'][0]['altText'] = "ฉันชื่ออึนฮา ยินดีที่ได้รู้จัก";
  $arrPostData['messages'][0]['baseSize']['height']= "1040";
  $arrPostData['messages'][0]['baseSize']['width']= "1040";
  $arrPostData['messages'][0]['actions']['type']= "message";
  $arrPostData['messages'][0]['actions']['text']= "annyeong";
  $arrPostData['messages'][0]['actions']['area']['x']= "520";
  $arrPostData['messages'][0]['actions']['area']['y']= "0";
  $arrPostData['messages'][0]['actions']['area']['width']= "520";
  $arrPostData['messages'][0]['actions']['area']['height']= "1040";
 
}else if($arrJson['events'][0]['message']['text'] == "อยู่"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "location";
  $arrPostData['messages'][0]['title'] = "นี้บ้านช้าน";
  $arrPostData['messages'][0]['address'] = "Seoul Gungnum";
  $arrPostData['messages'][0]['latitude'] = "35.65910807942215";
  $arrPostData['messages'][0]['longitude'] = "139.70372892916203";
 
}else if($arrJson['events'][0]['message']['text'] == "ชื่ออะไร"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันยังไม่มีชื่อนะ";
}else if($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
 
?>
