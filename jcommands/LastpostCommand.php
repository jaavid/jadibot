<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;
/**
 * User "/help" command
 */
class LastpostCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'lastpost';

    /**
     * @var string
     */
    protected $description = 'نمایش آخرین پست';

    /**
     * @var string
     */
    protected $usage = '/lastpost';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * @inheritdoc
     */
    public function execute(){
        $message    = $this->getMessage();
        $chat_id    = $message->getFrom()->getId();
		$page 		= trim($message->getText(true));
		$pagenumber = '1';
		if ($page === '' || $page === '1') {
			$pagenumber = '1';
		} else{
			$pagenumber = $page;
		}
		
		
			
		$client 	= new Client(['base_uri' =>'http://jadi.net/wp-json/wp/v2/']);
		$path   	= 'posts';
        $query  	= ['per_page'=> '1', 'page'=>$pagenumber,'_embed'=>'1',];
		//$query  	= ['per_page'=> '1','_embed'=>'1',];
        $response 	= $client->get($path, ['query' => $query]);
		$array 		= json_decode($response->getBody()->getContents(), true);
		foreach ($array as $item) {
			$date 		= $item['date'];
			$title 		= $item['title']['rendered'];
	        $text 		= $item['content']['rendered'];	
			$a_name 	= $item['_embedded']['author'][0]['name'];
			$a_link 	= $item['_embedded']['author'][0]['link'];
			$acomments 	= $item['_embedded']['replies'][0];
			$returncomment  = '';
			foreach ($acomments as $comment) {
				$returncomment .= "👤 ".$comment['author_name'].": \n".strip_tags($comment['content']['rendered'])."\n\n"; 
			}
			$content 	= strip_tags($text);
			$link 		= $array[0]['guid']['rendered'];
			
			$show = 
			"📎 [".$title."]"."(".$link.") \n \n ".
			"👤 [".$a_name."](".$a_link.") 📆".$date."\n \n ".
			$content."\n\n".
			$returncomment;
		}
		

		$data = [
            'chat_id' => $chat_id,
            'reply_to_message_id' => $message->getMessageId(),
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
            'text'    => $show,
        ];
        return Request::sendMessage($data);
    }
}
