<?php
//Some PHP Errors?!
date_default_timezone_set('America/New_York');

//Start Coding ^_^
require 'vendor/autoload.php';
require 'config.php';

//Recive Data
$data 		= json_decode(file_get_contents('php://input'), true);
$jsondata 	= file_get_contents('php://input');
//Create Bot
$client 	= new Zelenin\Telegram\Bot\Api($token);
//Parse Recived Data
$chatid 	= $data['message']['chat']['id'];
$text 		= $data['message']['text'];
$messageid 	= $data['message']['message_id'];
$updateid 	= $data['update_id'];
$senderid 	= $data['message']['from']['id'];
$zaman 		= $data['message']['date'];
$messageid 	= $data['message']['message_id'];
// Initialize Database
$db 		= new \MysqliDb($dbconf);
// Insert Recived Data To Database
$dbdata 	= array('ID' => '', 'Uid' => $updateid, 'Mid' => $messageid, 'Fid' => $senderid, 'Cid' => $chatid, 'Date' => $zaman, 'Text' => $text, 'Json' => $jsondata);
$id 		= $db -> insert('jadi_recived', $dbdata);

$mp3 		= "http://jadi.net/radiogeek.mp3";
switch ($text) {
	case '/podcast' :
	case '/podcast@jadibot' :
	case '/podcast@JadiBot' :
		try {
			$url 		= "http://jadi.net/tag/podcast/feed/";
			$rss 		= Feed::loadRss($url); 
			$items 		= $rss->item;
			$lastitem 	= $items[0];
			$lastlink 	= $lastitem->link;
			$lasttitle 	= $lastitem->title;
			$message 	= $lasttitle."\n".$lastlink; 
			$params 	= array('chat_id' => $chatid, 'action' => 'typing');
			$response = $client -> sendChatAction($params);
			$response = $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));						
			$response = $client -> sendAudio(array('chat_id' => $chatid, 'audio' => fopen($mp3, 'r'), 'reply_to_message_id' => $messageid));			
			#2.Send Report To Group
			$response = $client -> forwardMessage(array('chat_id' => $agroup, 'message_id' => $messageid, 'from_chat_id' => $chatid));
		} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
			echo $e -> getMessage();
		}
		break;
	case '/lastpost' :
	case '/lastpost@jadibot' :
	case '/lastpost@JadiBot' :
		try {
			$url 		= "http://jadi.net/feed/";
			$rss 		= Feed::loadRss($url);
			$items 		= $rss->item;
			$lastitem 	= $items[0];
			$lastlink 	= $lastitem->link;
			$lasttitle 	= $lastitem->title;
			$message 	= $lasttitle."\n".$lastlink; 
			$params 	= array('chat_id' => $chatid, 'action' => 'typing');
			$response 	= $client -> sendChatAction($params);
			$response 	= $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));			
			#2.Send Report To Group
			$response 	= $client -> forwardMessage(array('chat_id' => $agroup, 'message_id' => $messageid, 'from_chat_id' => $chatid));
		} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
			echo $e -> getMessage();
		}
		break;
	case '/help' :
	case '/help@jadibot' :
	case '/help@JadiBot' :
		try {
			$params 	= array('chat_id' => $chatid, 'action' => 'typing');
			$response 	= $client -> sendChatAction($params);
			$defaulttext = "شما میتوانید برای دریافت  آخرین مطلب وبلاگ جادی از فرمان \n /lastpost \n و برای دریافت آخرین پادکست از \n /podcast \n  استفاده کنید.";
			$params 	= array('chat_id' => $chatid, 'text' => $defaulttext, 'reply_to_message_id' => $messageid);
			$response 	= $client -> sendMessage($params);
			$response 	= $client -> forwardMessage(array('chat_id' => $agroup, 'message_id' => $messageid, 'from_chat_id' => $chatid));
		} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
			echo $e -> getMessage();
		}
		break;
	default :
		try {
			$response 	= $client -> forwardMessage(array('chat_id' => $agroup, 'message_id' => $messageid, 'from_chat_id' => $chatid));
		} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
			echo $e -> getMessage();
		}
		break;
		}