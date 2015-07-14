<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;

abstract class Type implements TypeInterface
{
    /**
     * @param stdClass $result
     */
    public function __construct(stdClass $result = null)
    {
        if ($result instanceof stdClass) {
            $this->loadResult($result);
        }
    }

    /**
     * @param stdClass $result
     */
    public function loadResult(stdClass $result)
    {
        foreach ($result as $key => $value) {
            $this->$key = $value;
        }
    }
}
