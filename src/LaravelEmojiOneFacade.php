<?php
namespace ChristofferOK\LaravelEmojiOne;

use Illuminate\Support\Facades\Facade;

class LaravelEmojiOneFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LaravelEmojiOne::class;
    }
}
