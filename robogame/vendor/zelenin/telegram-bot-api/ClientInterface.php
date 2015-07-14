<?php

namespace Zelenin\Telegram\Bot;

interface ClientInterface
{
    /**
     * @param string $method
     * @param array $params
     *
     * @return Response
     */
    public function request($method, $params = []);
}
