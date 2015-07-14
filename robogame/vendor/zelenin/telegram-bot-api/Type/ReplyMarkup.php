<?php

namespace Zelenin\Telegram\Bot\Type;

class ReplyMarkup extends Type
{
    /**
     * Optional. Use this parameter if you want to hide keyboard for specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     *
     * @var boolean
     */
    public $selective = false;
}
