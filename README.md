# laravel-emojione <img alt="❤️" width="30" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/2764.png">

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

<img alt="😀" width="50" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/1f600.png"> <img alt="🏋🏼" width="50" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/1f3cb-1f3fc.png"> <img alt="❤️" width="50" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/2764.png"> <img alt="☮" width="50" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/262e.png">


Laravel package to make it easier working with the gorgeous emojis from [EmojiOne](https://emojione.com/). 

Remember to read the [EmojiOne Free License](https://www.emojione.com/licenses/free) and provide the appropriate attribution. Or buy a  [premium license](https://www.emojione.com/licenses/premium)

## Upgrading from 3.x to 4.x

1. Update your composer dependency to: `"christofferok/laravel-emojione": "^4.0"` and run `composer update`
2. Update `config/emojione.php` (if you have one) with `'emojiVersion' => '4.0'`

If you are serving the assets yourself then you need to do the following things:

1. Update your emojione/assets composer dependency to: `"emojione/assets": "^4.0"` and run `composer update`
2. Update `config/emojione.php` with the correct paths and versions
3. Publish the assets again. See "Assets" section further down

## EmojiOne 4.x/3.x vs 2.0
EmojiOne made a lot of changes in their licensing and which resources are provided in the free license. v2 code is still available in the [emojione-v2](https://github.com/christofferok/laravel-emojione/tree/emojione-v2) branch. If you are upgrading this package, be aware that the SVG assets are not available anymore. 

## Install

Via Composer

``` bash
$ composer require christofferok/laravel-emojione
```
__If you are on Laravel 5.4 or lower you need to add the following to your `config/app.php` file:__

Add the ServiceProvider to the providers array in `config/app.php`

``` php
ChristofferOK\LaravelEmojiOne\LaravelEmojiOneServiceProvider::class,
```

Add this to the aliases array in `config/app.php`

``` php
'LaravelEmojiOne' => ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade::class,
```

Config:

``` bash
$ php artisan vendor:publish --tag=config --provider="ChristofferOK\LaravelEmojiOne\LaravelEmojiOneServiceProvider"
```

## Usage

``` php
LaravelEmojiOne::toShort($str); // - native unicode -> shortnames
LaravelEmojiOne::shortnameToImage($str); // - shortname -> images
LaravelEmojiOne::unicodeToImage($str); // - native unicode -> images
LaravelEmojiOne::toImage($str); // - native unicode + shortnames -> images (mixed input)
```

Blade (equivalent to `LaravelEmojiOne::toImage($str)`): 

`@emojione(':smile:')` -> <img alt="😀" width="20" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/64/1f600.png">

`@emojione(':smile: ❤️')` -> <img alt="😀" width="20" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/1f600.png"><img alt="❤️" width="20" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/2764.png">

🚨 The output is not escaped so be careful with what you pass into `@emojione`.

More details about how `toImage($str)` works can be found at [https://github.com/Ranks/emojione/blob/master/examples/PHP.md](https://github.com/Ranks/emojione/blob/master/examples/PHP.md)

### Example
You want to let users put emoji a comment. 
When you are saving a comment, you might want to run the content through `LaravelEmojiOne::toShort($str)` to convert `😄` and other emoji to `:smile:` etc. 

```php
Comment::create([
  'content' => LaravelEmojiOne::toShort(request('content'))
]);
```
So if someone leaves a comment like `This is an awesome comment 😄🔥` it will be saved as `This is an awesome comment :smile: :fire:`

In your view where you display your comments you can use 

```php
@emojione($comment->content)
```
and that will convert `:smile:` and `😄` to the emojione equivalent. 


## Assets
By default it will use the assets from JSDelivr.

Remember to run this before trying to publish any of the assets:

```bash
composer require emojione/assets
```

If you want to serve the assets yourself you can publish them with the following commands. Remember to update `config/emojione.php`

PNG files in sizes 32/64/128:

``` bash
$ php artisan vendor:publish --tag=public --provider="ChristofferOK\LaravelEmojiOne\LaravelEmojiOneServiceProvider"
```

In `config/emojione.php` specify the local path. Remember to specify which size you want in the path (32/64/128). 

```php
'imagePathPNG' => '/vendor/emojione/png/64/',
```

### Sprites
If you want to use sprites:

``` bash
$ php artisan vendor:publish --tag=sprites --provider="ChristofferOK\LaravelEmojiOne\LaravelEmojiOneServiceProvider"
```

In `config/emojione.php` enable sprites:

```php
'sprites' => true,
'spriteSize' => 32, // 32 or 64
```

Add the stylesheet to your HTML:

```html
<link rel="stylesheet" href="/vendor/emojione/sprites/emojione-sprite-{{ config('emojione.spriteSize') }}.min.css"/>
```


## License

Remember to read the [EmojiOne Free License](https://www.emojione.com/developers/free-license) and provide the appropriate attribution. Or buy a  [premium license](https://www.emojione.com/developers/premium-license)

[ico-version]: https://img.shields.io/packagist/v/christofferok/laravel-emojione.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/christofferok/laravel-emojione/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/christofferok/laravel-emojione.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/christofferok/laravel-emojione.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/christofferok/laravel-emojione.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/christofferok/laravel-emojione
[link-travis]: https://travis-ci.org/christofferok/laravel-emojione
[link-scrutinizer]: https://scrutinizer-ci.com/g/christofferok/laravel-emojione/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/christofferok/laravel-emojione
[link-downloads]: https://packagist.org/packages/christofferok/laravel-emojione
[link-author]: https://github.com/christofferok
