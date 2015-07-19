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
	case '/start' :
	case '/start@jadibot' :
	case '/start@JadiBot' :
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
		
	case '/admin' :
	case '/admin@jadibot' :
	case '/admin@JadiBot' :	
		if ($chatid == $agroup ) {
			$keyboard 				= array();
			$keyboard['keyboard']	= array();
			$keyboard['keyboard'][]	= array("/count");
			$keyboard['keyboard'][]	= array("/top10");
			
				try {
				$params = ['chat_id' => $chatid, 'action' => 'typing'];
				$response = $client -> sendChatAction($params);
				$defaulttext = "فرمان های مدیریت روبات: \n تعداد کاربران روبات:\n /count \n ۱۰کاربر برتر:\n /top10";
				$params = ['chat_id' => $chatid, 'text' => $defaulttext, 'reply_to_message_id' => $messageid,'reply_markup'=> json_encode($keyboard)];
				$response = $client -> sendMessage($params);
			} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
				echo $e -> getMessage();
			}	
		}else{
				try {			
				$response = $client -> forwardMessage(['chat_id' => $agroup, 'message_id' => $messageid, 'from_chat_id' => $chatid]);
			} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
				echo $e -> getMessage();
			}
		}	
			
		break;
	
	case '/count' :
	case '/count@jadibot' :
	case '/count@JadiBot' :	
		if ($chatid == $agroup ) {
			$users 	= $db->rawQuery('SELECT count(distinct Fid) as count from jadi_recived');
			$users 	= $users[0];
			$users 	= $users['count'];
			
			$allmsg = $db->rawQuery('SELECT count(*) as count from jadi_recived');
			$allmsg = $allmsg[0];
			$allmsg = $allmsg['count'];
			
				try {
				$params = ['chat_id' => $chatid, 'action' => 'typing'];
				$response = $client -> sendChatAction($params);
				$defaulttext = "درحال حاضر 👤".$users." کاربر از روبات ما استفاده میکنند.\n و این روبات تاکنون 📩".$allmsg." پیام را دریافت کرده است.";
				$params = ['chat_id' => $chatid, 'text' => $defaulttext, 'reply_to_message_id' => $messageid];
				$response = $client -> sendMessage($params);
			} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
				echo $e -> getMessage();
			}	
		}else{
				try {			
				$response = $client -> forwardMessage(['chat_id' => $agroup, 'message_id' => $messageid, 'from_chat_id' => $chatid]);
			} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
				echo $e -> getMessage();
			}
		}		
		break;
	case '/top10' :
	case '/top10@jadibot' :
	case '/top10@JadiBot' :	
		if ($chatid == $agroup ) {
			$topusersq = 'SELECT Fid as userid, COUNT( Fid ) as msgcount 
				FROM  `jadi_recived` 
				GROUP BY Fid
				ORDER BY COUNT( Fid ) DESC 
				LIMIT 0 , 10';				
				$topusers = $db->rawQuery($topusersq);	
				$i = 1;			
				foreach ($topusers as $topuser) {
						$oneuserq = 'SELECT Json FROM  `jadi_recived` WHERE Fid ='.$topuser['userid'].' LIMIT 0 , 1';
						$oneuser  = $db->rawQuery($oneuserq);
						$oneuserj = json_decode($oneuser[0]['Json']);
						$oneuserm = $oneuserj->message;
						$oneuserf = $oneuserm->from;
						$oneusern = $oneuserf->first_name." ".$oneuserf->last_name;
						$oneuseru = $oneuserf->username;
						$oneuserg = $oneuserm->chat;
						$oneusert = $oneuserg->title;
						$oneusern = "👤 ".$oneusern;
						if (!empty($oneuseru)) {
							$oneusern = $oneusern."\n@".$oneuseru;
						}
						if (!empty($oneusert)) {
							$oneusern = $oneusern."\n📂 گروه : ".$oneusert;
						}
						
						try {
							$defaulttext = $i.".".$oneusern."\n که ".$topuser['msgcount']." پیام فرستاده است.\n".$uresponseresponse;
							$params = ['chat_id' => $agroup, 'text' => $defaulttext];
							$response = $client -> sendMessage($params);							
							} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
						echo $e -> getMessage();
					}
						$i++;
				}				
		}else{
				try {			
				$response = $client -> forwardMessage(['chat_id' => $agroup, 'message_id' => $messageid, 'from_chat_id' => $chatid]);
			} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
				echo $e -> getMessage();
			}
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