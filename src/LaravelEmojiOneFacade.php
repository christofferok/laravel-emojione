<?php

namespace ChristofferOK\LaravelEmojiOne;

use Illuminate\Support\Facades\Facade;

class LaravelEmojiOneFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LaravelEmojiOne::class;
    }
}
