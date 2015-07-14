<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;

class Sticker extends Type
{
    /**
     * Unique identifier for this file
     *
     * @var string
     */
    public $file_id;

    /**
     * Sticker width
     *
     * @var integer
     */
    public $width;

    /**
     * Sticker height
     *
     * @var integer
     */
    public $height;

    /**
     * Sticker thumbnail in .webp or .jpg format
     *
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. File size
     *
     * @var integer
     */
    public $file_size;

    /**
     * @param stdClass $result
     */
    public function loadResult(stdClass $result)
    {
        parent::loadResult($result);

        if (isset($result->thumb)) {
            $this->thumb = new PhotoSize($result->thumb);
        }
    }
}
