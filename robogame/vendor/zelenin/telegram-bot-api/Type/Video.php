<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;

class Video extends Type
{
    /**
     * Unique identifier for this file
     *
     * @var string
     */
    public $file_id;

    /**
     * Video width as defined by sender
     *
     * @var integer
     */
    public $width;

    /**
     * Video height as defined by sender
     *
     * @var integer
     */
    public $height;

    /**
     * Duration of the video in seconds as defined by sender
     *
     * @var integer
     */
    public $duration;

    /**
     * Video thumbnail
     *
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Mime type of a file as defined by sender
     *
     * @var string
     */
    public $mime_type;

    /**
     * Optional. File size
     *
     * @var integer
     */
    public $file_size;

    /**
     * Optional. Text description of the video (usually empty)
     *
     * @var string
     */
    public $caption;

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
