<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;

interface TypeInterface
{
    /**
     * @param stdClass $result
     */
    public function loadResult(stdClass $result);
}
