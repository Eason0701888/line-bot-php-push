<?php

require_once __DIR__ . '/vendor/autoload.php';
$CHANNEL_ACCESS_TOKEN="VfcdUobfc4kKV+SbzTXQDOnvBjpFIkJqla35htny9vPB+3uVC9B5Dkwy6e6eSDGjbJQyHQMVk9+W9ALd7+Px4LcmAZMxoaE1Qyvgkzk0B99Q6vQCMusoUsjR6UHtZDHzgYrNY9OYzefblJvD7CxNCwdB04t89/1O/w1cDnyilFU=";
$CHANNEL_SECRET="7e61c3a59c473a50f7d2f691669751a0";


$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($CHANNEL_ACCESS_TOKEN);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $CHANNEL_SECRET]);
$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
foreach ($events as $event) {
  if ($event instanceof \LINE\LINEBot\Event\PostbackEvent) {
    error_log('postback : ' . file_get_contents('php://input')); // date data in postback field
  }

  if ($event instanceof \LINE\LINEBot\Event\MessageEvent) {
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
      $json = array(
        "replyToken" => $event->getReplyToken(),
        "messages" => [
          array(
            "type" => "template",
            "altText" => "this is a confirm template",
            "template" => array(
                "type" => "confirm",
                "text" => "Are you sure?",
                "actions" => [
                    array(
                      "type" => "datetimepicker",
                      "data" => "datestring", // will be included in postback action
                      "label" => "Please Choose",
                      "mode" => "date", // date | time | datetime
                      //"initial": "", // 2017-06-18 | 00:00 | 2017-06-18T00:00
                      //"max": "", // 2017-06-18 | 00:00 | 2017-06-18T00:00
                      //"min": "", // 2017-06-18 | 00:00 | 2017-06-18T00:00
                    ),
                    array(
                      "type" => "message",
                      "label" => "No",
                      "text" => "no"
                    )
                ]
            )
          )
        ]
      );

      $curl = curl_init() ;
      curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/message/reply") ;
      curl_setopt($curl, CURLOPT_HEADER, true);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $CHANNEL_ACCESS_TOKEN));
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($json));
      curl_exec($curl);
    }
    continue;
  }
}

 ?>