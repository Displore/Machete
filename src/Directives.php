<?php

namespace Displore\Machete;

use Illuminate\Support\Facades\Blade;

class Directives
{
    /**
     * Format a timestamp.
     * From: https://laravel.com/docs/5.1/blade#extending-blade.
     * 
     * @return string
     */
    public function datetime()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo with{$expression}->format('m/d/Y H:i'); ?>";
        });
    }

    /**
     * Shortcut to show contents to logged in users. End with `@endIf`.
     * 
     * @return string
     */
    public function ifLoggedIn()
    {
        Blade::directive('ifLoggedIn', function () {
            return '<?php if(Auth::check()): ?>';
        });
    }

    /**
     * Shortcut to extend a layout.
     * 
     * @return string
     */
    public function layout()
    {
        Blade::directive('layout', function ($expression) {
            return Blade::compileString("@extends(layouts.{$expression})");
        });
    }

    /**
     * Truncate the text if it is longer than a given maximum.
     *
     * @return string
     */
    public function limit()
    {
        Blade::directive('limit', function ($arguments) {
            list($string, $length) = explode(',', str_replace(['(', ')', ' '], '', $arguments));

            return "<?php echo str_limit({$string}, {$length}); ?>";
        });
    }

    /**
     * Shortcut to include a partial view.
     * 
     * @return string
     */
    public function partial()
    {
        Blade::directive('partial', function ($expression) {
            return Blade::compileString("@include(partials.{$expression})");
        });
    }

    /**
     * Show the page's title.
     * Use `@title` in your layout, `@title('my page')` in your pages.
     * 
     * @return string
     */
    public function title()
    {
        Blade::directive('title', function ($expression) {

            // If something is provided with `@title()`.
            if ($expression) {

                // If that something starts with `@default:` it is the default title,
                // Meaning it can still be overwritten by another file.
                if (str_contains($expression, '@default:')) {
                    //if (substr($title, 1, 9) == '@default:') {
                    $title = str_replace(['(', ')', '@default:'], '', $expression);

                    return "<title> <?php echo \$__env->yieldContent('title', {$title}); ?> </title>";
                }

                // Nope, no default title, show the actual one.
                $title = str_replace(['(', ')'], '', $expression);

                return "<?php \$__env->startSection('title', {$title}); ?>";
            }

            // It's just the layout placement.
            return "<title> <?php echo \$__env->yieldContent('title'); ?> </title>";
        });
    }
}
