<?php

namespace Zelenin\Telegram\Bot;

use stdClass;

class Response
{
    /**
     * @var boolean
     */
    private $ok;
    /**
     * @var stdClass
     */
    private $result;

    /**
     * @var integer|null
     */
    private $error_code;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @param $ok
     * @param $result
     * @param null $error_code
     * @param null $description
     */
    public function __construct($ok, $result, $error_code = null, $description = null)
    {
        $this->ok = (bool)$ok;
        $this->result = $result;
        $this->error_code = $error_code;
        $this->description = $description;
    }

    /**
     * @return boolean
     */
    public function getOk()
    {
        return $this->ok;
    }

    /**
     * @return mixed|stdClass
     */

    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return integer|null
     */
    public function getErrorCode()
    {
        return $this->error_code;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
