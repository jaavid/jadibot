<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

/**
 * User "/podcast" command
 */
class PodcastCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'podcast';

    /**
     * @var string
     */
    protected $description = 'نمایش آخرین پادکست';

    /**
     * @var string
     */
    protected $usage = '/podcast';

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
        $data['text'] = 'نمایش آخرین پادکست جادی';
        return Request::sendMessage($data);
    }
}
