# Displore Machete

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Quality Score][ico-code-quality]][link-code-quality]

This package provides additional directives and extensions for Laravel's Blade template engine. After all, a Machete is quite useful in a code jungle.

## Install

### Via [Displore Core][link-displore-core]

``` bash
$ php artisan displore:install machete
```
This does everything for you, from the Composer requirement to the addition of Laravel service providers.

### Via Composer

``` bash
$ composer require displore/machete
```
This requires the addition of the Machete service provider and Theme and Widget facade alias to config/app.php     
`Displore\Machete\MacheteServiceProvider::class,`
and the facades
`Displore\Machete\Facades\Theme::class,`
`Displore\Widgets\Facades\Widget::class,`

### Configuration

The theming and widgets services comes with some configuration.
```bash
$ php artisan vendor:publish --tag=displore.themes.config
$ php artisan vendor:publish --tag=displore.widgets.config
```

## Usage

### Blade directives

``` php
@datetime($var)
@ifLoggedIn() // end with @endIf
@layout('master') // layouts/master.blade.php
@limit($string, 50) // limit to 50 characters.
@partial('errors') // partials/errors.blade.php
@title() // compiled to @yield('title') - the layout placement
@title('@default: My default') // compiled to @yield('title', 'My default')
@title('My site') // compiled to @section('title', 'My site')
```

### Presenters

1. Your presentable model should use the `Displore\Machete\Presenter\Presentable` trait.
2. Set a `$presenter` variable in your model, containing a path to the presenter class for that model.
3. The presenter should extend `Displore\Machete\Presenter`.
4. Now you can use the `present()` function on your model.

### Themes

By default, Machete prepares theming for your app. You can turn this off in the configuration.
Theme folders can be created and deleted through commands (disabled on production):
```bash
$ php artisan displore:theme create mytheme
```
```bash
$ php artisan displore:theme delete mytheme
```

A Theme facade is also available and usable as follows:
```php
Theme::set('mytheme')->register();
Theme::get();
Theme::setDefault();
Theme::getDefault();
Theme::asset('js/app.js');
```

### Widgets

With Laravel, the array of providers is found in a dedicated configuration file. In your views you can call the `Widget` facade to get widgets.

```php
Widget::get('headline');
```

It is also possible to use a dynamic widgets provider, meaning that on every request, all classes in a given path will be searched for the widget needed. Especially useful during development. For this, set `dynamic` to true in the configuration file.

You can also set widgets during runtime, with both the static and dynamic widgets provider:
```php
Widget::set('headline', new My\Widgets\Headline::class);
```

## Further documentation

To be made.

## Change log

Please see [changelog](changelog.md) for more information what has changed recently.

## Testing

In a Laravel application, with [Laravel Packager](https://github.com/Jeroen-G/laravel-packager):
``` bash
$ php artisan packager:git *Displore Github url*
$ php artisan packager:tests
$ phpunit
```

## Contributing

Please see [contributing](contributing.md) for details.

## Credits

- [JeroenG][link-author]
- [All Contributors][link-contributors]

## License

The EUPL License. Please see the [License File](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/displore/machete.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/displore/machete.svg?style=flat-square

[link-displore-core]: https://github.com/displore/core

[link-packagist]: https://packagist.org/packages/displore/machete
[link-code-quality]: https://scrutinizer-ci.com/g/displore/machete
[link-author]: https://github.com/Jeroen-G
[link-contributors]: ../../contributors
