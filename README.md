# laravel-emojione <img alt="❤️" width="30" src="https://cdn.jsdelivr.net/emojione/assets/svg/2764.svg?v=2.2.7">

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

<img alt="😀" width="50" src="https://cdn.jsdelivr.net/emojione/assets/svg/1f600.svg?v=2.2.7">
<img alt="🏋🏼" width="50" src="https://cdn.jsdelivr.net/emojione/assets/svg/1f3cb-1f3fc.svg?v=2.2.7">
<img alt="❤️" width="50" src="https://cdn.jsdelivr.net/emojione/assets/svg/2764.svg?v=2.2.7">
<img alt="☮" width="50" src="https://cdn.jsdelivr.net/emojione/assets/svg/262e.svg?v=2.2.7">


Laravel package to make it easier working with the gorgeous emojis from [EmojiOne](http://emojione.com/). 

Remember to read the [EmojiOne license](http://emojione.com/licensing/) and provide the appropriate attribution.

## Install

Via Composer

``` bash
$ composer require christofferok/laravel-emojione
```

Add the ServiceProvider to the providers array in `config/app.php`

``` php
ChristofferOK\LaravelEmojiOne\LaravelEmojiOneServiceProvider::class,
```

Add the ServiceProvider to the aliases array in `config/app.php`

``` php
'LaravelEmojiOne' => ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade::class,
```

Config:

``` bash
$ php artisan vendor:publish --tag=config --provider="ChristofferOK\LaravelEmojiOne\LaravelEmojiOneServiceProvider"
```

## Usage
For more details look at [https://github.com/Ranks/emojione](https://github.com/Ranks/emojione)

``` php
LaravelEmojiOne::toShort($str); // - native unicode -> shortnames
LaravelEmojiOne::shortnameToImage($str); // - shortname -> images
LaravelEmojiOne::unicodeToImage($str); // - native unicode -> images
LaravelEmojiOne::toImage($str); // - native unicode + shortnames -> images (mixed input)
```

Blade (equivalent to `LaravelEmojiOne::toImage($str)`): 

`@emojione(':smile:')` -> <img alt="😀" width="20" src="https://cdn.jsdelivr.net/emojione/assets/svg/1f600.svg?v=2.2.7">

`@emojione(':smile: ❤️')` -> <img alt="😀" width="20" src="https://cdn.jsdelivr.net/emojione/assets/svg/1f600.svg?v=2.2.7"><img alt="❤️" width="20" src="https://cdn.jsdelivr.net/emojione/assets/svg/2764.svg?v=2.2.7">


### Styling
`<link rel="stylesheet" href="https://cdn.jsdelivr.net/emojione/2.2.7/assets/css/emojione.min.css"/>`

or if you are serving your own CSS:
`<link rel="stylesheet" href="/vendor/emojione/css/emojione.min.css"/>`

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

If you want to serve the assets yourself you can publish them with the following commands. Remember to update `config/emojione.php`

PNG, SVG and CSS files:

``` bash
$ php artisan vendor:publish --tag=public --provider="ChristofferOK\LaravelEmojiOne\LaravelEmojiOneServiceProvider"
```

### Sprites
If you want to use sprites:

``` bash
$ php artisan vendor:publish --tag=sprites --provider="ChristofferOK\LaravelEmojiOne\LaravelEmojiOneServiceProvider"
```
If using the PNG sprites you also have to use the following stylesheet:
`<link rel="stylesheet" href="/vendor/emojione/sprites/emojione.sprites.css"/>`


## License

Remember to read the [EmojiOne license](http://emojione.com/licensing/) and provide the appropriate attribution.

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
