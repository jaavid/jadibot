<?php
namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

/**
 * User "/surprise" command
 */
class SurpriseCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'surprise';

    /**
     * @var string
     */
    protected $description = 'نمایش سورپرایز';

    /**
     * @var string
     */
    protected $usage = '/surprise';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * @inheritdoc
     */
     public function execute(){
        $message     = $this->getMessage();
        $chat_id     = $message->getFrom()->getId();
        $data = [
            'chat_id'    => $chat_id,
            'parse_mode' => 'markdown',
        ];
        $data['text'] = 'نمایش یک سورپرایز';
        return Request::sendMessage($data);
    }
}
