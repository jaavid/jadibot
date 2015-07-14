# Telegram Bot API Client

[Telegram](https://telegram.org) [Bot](https://core.telegram.org/bots) [API](https://core.telegram.org/bots/api) Client

## Installation

### Composer

The preferred way to install this extension is through [Composer](http://getcomposer.org/).

Either run

```
php composer.phar require "zelenin/telegram-bot-api" "~0.0"
```

or add

```
"zelenin/telegram-bot-api": "~0.0"
```

to the require section of your ```composer.json```

## Usage

```php
$client = new Zelenin\Telegram\Bot\Api($token);

try {
    $response = $client->sendMessage([
        'chat_id' => $chatId,
        'text' => 'Test message
    ]);
    print_r($response);
    
    $response = $client->sendPhoto([
    	'chat_id' => $myId,
    	'photo' => fopen('/home/www/photo.jpg', 'r')
    ]);
    print_r($response);
} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
    echo $e->getMessage();
}
```

See [Bot API documentation](https://core.telegram.org/bots/api) for other methods.

## Author

[Aleksandr Zelenin](https://github.com/zelenin/), e-mail: [aleksandr@zelenin.me](mailto:aleksandr@zelenin.me)
