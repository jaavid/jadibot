<?php

namespace Zelenin\Telegram\Bot;

use stdClass;
use Zelenin\Telegram\Bot\Type\Message;
use Zelenin\Telegram\Bot\Type\ReplyMarkup;
use Zelenin\Telegram\Bot\Type\Update;
use Zelenin\Telegram\Bot\Type\User;
use Zelenin\Telegram\Bot\Type\UserProfilePhotos;

class Api
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @param $method
     * @param array $params
     *
     * @return mixed|stdClass
     *
     * @throws NotOkException
     */
    public function request($method, $params = [])
    {
        $response = $this->getClient()->request($method, $params);
        if (!$response->getOk()) {
            throw new NotOkException('Code: ' . $response->getErrorCode() . '. Description: "' . $response->getDescription() . '".');
        }
        return $response->getResult();
    }

    /**
     * @return Client|ClientInterface
     */
    private function getClient()
    {
        if (!$this->client instanceof ClientInterface) {
            $this->client = new Client($this->token);
        }
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return User
     *
     * @throws NotOkException
     */
    public function getMe()
    {
        return new User($this->request('getMe'));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendMessage($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return new Message($this->request('sendMessage', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function forwardMessage($params)
    {
        return new Message($this->request('forwardMessage', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendPhoto($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return new Message($this->request('sendPhoto', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendAudio($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return new Message($this->request('sendAudio', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendDocument($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return new Message($this->request('sendDocument', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendSticker($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return new Message($this->request('sendSticker', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendVideo($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return new Message($this->request('sendVideo', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendLocation($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return new Message($this->request('sendLocation', $params));
    }

    /**
     * @param $params
     *
     * @return mixed
     *
     * @throws NotOkException
     */
    public function sendChatAction($params)
    {
        return $this->request('sendChatAction', $params);
    }

    /**
     * @param $params
     *
     * @return UserProfilePhotos
     *
     * @throws NotOkException
     */
    public function getUserProfilePhotos($params)
    {
        return new UserProfilePhotos($this->request('getUserProfilePhotos', $params));
    }

    /**
     * @param $params
     *
     * @return Update[]
     *
     * @throws NotOkException
     */
    public function getUpdates($params)
    {
        return array_map(function (stdClass $item) {
            return new Update($item);
        }, $this->request('getUpdates', $params));
    }

    /**
     * @param $params
     *
     * @return mixed
     *
     * @throws NotOkException
     */
    public function setWebhook($params)
    {
        return $this->request('setWebhook', $params);
    }
}
