[![Dependency Status](https://www.versioneye.com/user/projects/55a6800a6666330014000026/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55a6800a6666330014000026)
![Tag](https://img.shields.io/github/tag/jaavid/jadibot.svg)
![Release](https://img.shields.io/github/release/jaavid/jadibot.svg)
![PHP](https://img.shields.io/badge/PHP-8-blue?logo=php)



# jadibot
Telegram Bot for jadi.net. This is a single purpose program which lets you interact with [www.Jadi.net](http://jadi.net) using Telegram messenger; although you can modify it to use other weblogs or even sites.

### Installation
1. Install dependencies using [Composer](https://getcomposer.org/):

   ```bash
   composer install
   ```

2. Copy the sample configuration and update it with your bot credentials:

   ```bash
   cp config.php.sample config.php
   ```

   Edit `config.php` and set your Telegram bot token and other settings.

### Usage
Run the bot with PHP:

```bash
php hook.php
```

You can also host `hook.php` on a web server and set it as the Telegram webhook.

If you simply want to use the public instance of JadiBot, head to [https://t.me/jadibot](https://t.me/jadibot) and start with `/start` to see the list of commands.

These commands are available:

- `/help` shows the help
- `/lastpost` shows the last post on the blog
- `/podcast` lets you play the last podcast

### To do

- [x] Remove Default Message
- [x] Add /help Command
- [ ] Documentation
- [ ] Unsubscribe Command
- [ ] Old Posts Command
- [ ] Old Podcasts Command
- [x] Random Post Command (/random)
