<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;

class Message extends Type
{
    /**
     * Unique message identifier
     *
     * @var integer
     */
    public $message_id;

    /**
     * Sender
     *
     * @var User
     */
    public $from;

    /**
     * Date the message was sent in Unix time
     *
     * @var integer
     */
    public $date;

    /**
     * Conversation the message belongs to — user in case of a private message, GroupChat in case of a group
     *
     * @var User|GroupChat
     */
    public $chat;

    /**
     * Optional. For forwarded messages, sender of the original message
     *
     * @var User
     */
    public $forward_from;

    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     *
     * @var integer
     */
    public $forward_date;

    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     *
     * @var static
     */
    public $reply_to_message;

    /**
     * For text messages, the actual UTF-8 text of the message
     *
     * @var string
     */
    public $text;

    /**
     * Optional. Message is an audio file, information about the file
     *
     * @var Audio
     */
    public $audio;

    /**
     * Optional. Message is a general file, information about the file
     *
     * @var Document
     */
    public $document;

    /**
     * Optional. Message is a photo, available sizes of the photo
     *
     * @var PhotoSize[]
     */
    public $photo;

    /**
     * Optional. Message is a sticker, information about the sticker
     *
     * @var Sticker
     */
    public $sticker;

    /**
     * Optional. Message is a video, information about the video
     *
     * @var Video
     */
    public $video;

    /**
     * Optional. Message is a shared contact, information about the contact
     *
     * @var Contact
     */
    public $contact;

    /**
     * Optional. Message is a shared location, information about the location
     * @var Location
     */
    public $location;

    /**
     * Optional. A new member was added to the group, information about them (this member may be bot itself)
     *
     * @var User
     */
    public $new_chat_participant;

    /**
     * Optional. A member was removed from the group, information about them (this member may be bot itself)
     *
     * @var User
     */
    public $left_chat_participant;

    /**
     * Optional. A group title was changed to this value
     *
     * @var string
     */
    public $new_chat_title;

    /**
     * Optional. A group photo was change to this value
     *
     * @var PhotoSize[]
     */
    public $new_chat_photo;

    /**
     * Optional. Informs that the group photo was deleted
     *
     * @var boolean
     */
    public $delete_chat_photo;

    /**
     * Optional. Informs that the group has been created
     *
     * @var boolean
     */
    public $group_chat_created;

    /**
     * @param stdClass $result
     */
    public function loadResult(stdClass $result)
    {
        parent::loadResult($result);

        if (isset($result->from)) {
            $this->from = new User($result->from);
        }

        if (isset($result->chat)) {
            $this->chat = isset($result->chat->title) ? new GroupChat($result->chat) : new User($result->chat);
        }

        if (isset($result->forward_from)) {
            $this->forward_from = new User($result->forward_from);
        }

        if (isset($result->reply_to_message)) {
            $this->reply_to_message = new static($result->reply_to_message);
        }

        if (isset($result->audio)) {
            $this->audio = new Audio($result->audio);
        }

        if (isset($result->document)) {
            $this->document = new Document($result->document);
        }

        if (isset($result->photo)) {
            $this->photo = [];
            foreach ($result->photo as $photo) {
                $this->photo[] = new PhotoSize($photo);
            }
        }

        if (isset($result->sticker)) {
            $this->sticker = new Sticker($result->sticker);
        }

        if (isset($result->video)) {
            $this->video = new Video($result->video);
        }

        if (isset($result->contact)) {
            $this->contact = new Contact($result->contact);
        }

        if (isset($result->location)) {
            $this->location = new Location($result->location);
        }

        if (isset($result->new_chat_participant)) {
            $this->new_chat_participant = new User($result->new_chat_participant);
        }

        if (isset($result->left_chat_participant)) {
            $this->left_chat_participant = new User($result->left_chat_participant);
        }

        if (isset($result->location)) {
            $this->location = new Location($result->location);
        }

        if (isset($result->new_chat_photo)) {
            $this->new_chat_photo = [];
            foreach ($result->new_chat_photo as $photo) {
                $this->new_chat_photo[] = new PhotoSize($photo);
            }
        }
    }
}
