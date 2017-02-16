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
        $this->client->imageType = config('emojione.imageType');
        if (config('emojione.imagePathPNG')) {
            $this->client->imagePathPNG = config('emojione.imagePathPNG');
        }
        if (config('emojione.imagePathSVG')) {
            $this->client->imagePathSVG = config('emojione.imagePathSVG');
        }

        $this->client->sprites = config('emojione.sprites');
        if (config('emojione.imagePathSVGSprites')) {
            $this->client->imagePathSVGSprites = config('emojione.imagePathSVGSprites');
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
}
