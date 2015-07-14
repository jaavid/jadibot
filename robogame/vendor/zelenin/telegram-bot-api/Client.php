<?php

namespace Zelenin\Telegram\Bot;

use GuzzleHttp\Exception\ClientException;

class Client implements ClientInterface
{
    /**
     * @var string
     */
    private $baseUrl = 'https://api.telegram.org/bot{token}/{method}';

    /**
     * @var string
     */
    private $token;

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @param string $method
     * @param array $params
     *
     * @return Response
     */
    public function request($method, $params = [])
    {
        $client = new \GuzzleHttp\Client();

        $multipartParams = [];
        foreach ($params as $key => $value) {
            $multipartParams[] = [
                'name' => $key,
                'contents' => is_scalar($value) ? (string)$value : $value
            ];
        }

        try {
            $response = $client->post($this->getUrl($method), [
                'verify' => false,
                'multipart' => $multipartParams ?: null
            ]);
            $response = json_decode($response->getBody());
            return new Response($response->ok, $response->result);
        } catch (ClientException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents());
            return new Response($response->ok, null, $response->error_code, $response->description);
        }
    }

    /**
     * @param string $method
     *
     * @return string
     */
    private function getUrl($method)
    {
        return strtr($this->baseUrl, [
            '{token}' => $this->token,
            '{method}' => $method
        ]);
    }
}
