<?php

require_once __DIR__ . '/vendor/autoload.php';
$CHANNEL_ACCESS_TOKEN="VfcdUobfc4kKV+SbzTXQDOnvBjpFIkJqla35htny9vPB+3uVC9B5Dkwy6e6eSDGjbJQyHQMVk9+W9ALd7+Px4LcmAZMxoaE1Qyvgkzk0B99Q6vQCMusoUsjR6UHtZDHzgYrNY9OYzefblJvD7CxNCwdB04t89/1O/w1cDnyilFU=";
$CHANNEL_SECRET="7e61c3a59c473a50f7d2f691669751a0";
$to="Ue004c4797cf171301dccf7e7d8ef7d62";


$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($CHANNEL_ACCESS_TOKEN);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $CHANNEL_SECRET]);
//$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
//$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
/*
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->pushMessage($to, $textMessageBuilder);
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
*/
$message_obj = [
    "to" => "Ue004c4797cf171301dccf7e7d8ef7d62",
    "messages" => [
      [
        "type" => "text",
        "text" => "finally點"
      ]
    ]
  ];

$curl = curl_init() ;
curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/message/push") ;
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $CHANNEL_ACCESS_TOKEN));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($message_obj));
curl_exec($curl);
 ?>


