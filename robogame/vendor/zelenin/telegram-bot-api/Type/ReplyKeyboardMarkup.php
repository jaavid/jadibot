<?php

namespace Zelenin\Telegram\Bot\Type;

class ReplyKeyboardMarkup extends ReplyMarkup
{
    /**
     * Array of button rows, each represented by an Array of Strings
     *
     * @var string[][]
     */
    public $keyboard;

    /**
     * Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     *
     * @var boolean
     */
    public $resize_keyboard = false;

    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     *
     * @var boolean
     */
    public $one_time_keyboard = false;
}
