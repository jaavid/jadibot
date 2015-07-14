<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;

class Document extends Type
{
    /**
     * Unique file identifier
     *
     * @var string
     */
    public $file_id;

    /**
     * Document thumbnail as defined by sender
     *
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Original filename as defined by sender
     *
     * @var string
     */
    public $file_name;

    /**
     * Optional. MIME type of the file as defined by sender
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
