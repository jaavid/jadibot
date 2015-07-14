<?php

namespace Zelenin\Telegram\Bot\Type;

class ForceReply extends ReplyMarkup
{
    /**
     * Shows reply interface to the user, as if they manually selected the bot‘s message and tapped ’Reply'
     *
     * @var boolean
     */
    public $force_reply = true;
}
