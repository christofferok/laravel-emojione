<?php

namespace ChristofferOK\LaravelEmojiOne;

use Emojione\Client;
use Emojione\Ruleset;

class LaravelEmojiOne
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(new Ruleset());

        $this->client->emojiSize = config('emojione.emojiSize');
        $this->client->sprites = config('emojione.sprites');
        $this->client->spriteSize = config('emojione.spriteSize');
        $this->client->emojiVersion = config('emojione.emojiVersion');

        if (config('emojione.imagePathPNG')) {
            $this->client->imagePathPNG = url(config('emojione.imagePathPNG')) . '/';
        }
        else{
            // Use the CDN if 'imagePathPNG' config is not set
            $this->client->imagePathPNG = 'https://cdn.jsdelivr.net/emojione/assets' . '/' . $this->client->emojiVersion . '/png/' . $this->client->emojiSize . '/';
        }
    }

    public function toImage($str)
    {
        return $this->client->toImage($str);
    }

    public function toShort($str)
    {
        return $this->client->toShort($str);
    }

    public function shortnameToImage($str)
    {
        return $this->client->shortnameToImage($str);
    }

    public function unicodeToImage($str)
    {
        return $this->client->unicodeToImage($str);
    }

    public function getClient()
    {
        return $this->client;
    }
}
