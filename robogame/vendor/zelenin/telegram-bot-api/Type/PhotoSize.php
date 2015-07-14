<?php

namespace Zelenin\Telegram\Bot\Type;

class PhotoSize extends Type
{
    /**
     * Unique identifier for this file
     *
     * @var string
     */
    public $file_id;

    /**
     * Photo width
     *
     * @var integer
     */
    public $width;

    /**
     * Photo height
     *
     * @var integer
     */
    public $height;

    /**
     * Optional. File size
     *
     * @var integer
     */
    public $file_size;
}
