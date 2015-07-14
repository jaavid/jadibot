<?php

namespace Zelenin\Telegram\Bot\Type;

class Contact extends Type
{
    /**
     * Contact's phone number
     *
     * @var string
     */
    public $phone_number;

    /**
     * Contact's first name
     *
     * @var string
     */
    public $first_name;

    /**
     * Optional. Contact's last name
     *
     * @var string
     */
    public $last_name;

    /**
     * Optional. Contact's user identifier in Telegram
     *
     * @var string
     */
    public $user_id;
}
