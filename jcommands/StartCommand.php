<?php
namespace Longman\TelegramBot\Commands\SystemCommands;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

/**
 * Start command
 */
class StartCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'فرمان شروع';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $text    = 'سلام!' . PHP_EOL . 'برای مشاهده همه فرمان ها  /help را وارد کنید';

        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
        ];
		Request::sendChatAction(['chat_id' => $chat_id,'action'  => 'typing',]); 
        return Request::sendMessage($data);
    }
}
