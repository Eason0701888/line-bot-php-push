<?php

require_once __DIR__ . '/vendor/autoload.php';
$CHANNEL_ACCESS_TOKEN="VfcdUobfc4kKV+SbzTXQDOnvBjpFIkJqla35htny9vPB+3uVC9B5Dkwy6e6eSDGjbJQyHQMVk9+W9ALd7+Px4LcmAZMxoaE1Qyvgkzk0B99Q6vQCMusoUsjR6UHtZDHzgYrNY9OYzefblJvD7CxNCwdB04t89/1O/w1cDnyilFU=";
$CHANNEL_SECRET="7e61c3a59c473a50f7d2f691669751a0";
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($CHANNEL_ACCESS_TOKEN);
$to="Ue004c4797cf171301dccf7e7d8ef7d62";


$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $CHANNEL_SECRET]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->pushMessage($to, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

 ?>


