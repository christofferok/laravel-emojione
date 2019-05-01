<?php

namespace ChristofferOK\LaravelEmojiOne;

use Emojione\Client;
use Emojione\Ruleset;

class LaravelEmojiOne
{
    /**
     * @var \Emojione\Client
     */
    private $client;

    /**
     * LaravelEmojiOne constructor.
     */
    public function __construct()
    {
        $this->client = new Client(new Ruleset());

        $this->client->emojiSize = config('emojione.emojiSize');
        $this->client->sprites = config('emojione.sprites');
        $this->client->spriteSize = config('emojione.spriteSize');
        $this->client->emojiVersion = config('emojione.emojiVersion');

        if (config('emojione.imagePathPNG')) {
            $this->client->imagePathPNG = url(config('emojione.imagePathPNG')) . '/';
        } else {
            // Use the CDN if 'imagePathPNG' config is not set
            $this->client->imagePathPNG = 'https://cdn.jsdelivr.net/emojione/assets' . '/' . $this->client->emojiVersion . '/png/' . $this->client->emojiSize . '/';
        }

        // config ascii option added ternary in case option isn't part of config
        $this->client->ascii = config('emojione.ascii') ? true : false;
    }

    /**
     * @param $str
     *
     * @return string
     */
    public function toImage($str)
    {
        return $this->client->toImage($str);
    }

    /**
     * @param $str
     *
     * @return string
     */
    public function toShort($str)
    {
        return $this->client->toShort($str);
    }

    /**
     * @param $str
     *
     * @return string
     */
    public function shortnameToImage($str)
    {
        return $this->client->shortnameToImage($str);
    }

    /**
     * @param $str
     *
     * @return string
     */
    public function unicodeToImage($str)
    {
        return $this->client->unicodeToImage($str);
    }

    /**
     * @return \Emojione\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
