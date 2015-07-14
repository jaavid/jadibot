<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;

class Update extends Type
{
    /**
     * The update‘s unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order.
     *
     * @var integer
     */
    public $update_id;

    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     *
     * @var Message
     */
    public $message;

    public function loadResult(stdClass $result)
    {
        parent::loadResult($result);

        if (isset($result->message)) {
            $this->message = new Message($result->message);
        }
    }
}
