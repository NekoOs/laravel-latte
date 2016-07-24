# wodCZ/laravel-latte

Integration of [Latte: amazing template engine for PHP](https://github.com/nette/latte) to Laravel

This package registers Latte\Engine service with proper compiled view directory and auto-recompile based on debug mode.  

## Installation

```
composer require wodcz/laravel-latte:dev-master
```

then register
```
\wodCZ\LaravelLatte\LatteProvider::class,
```

## Disclaimer

This will only work with default view Factory (\Illuminate\View\Factory)

This bridge contains no tests, as I don't know how to test this :) 

This is my very-first integration, it was not used more than by renaming welcome.blade.php to welcome.latte.
Things may not work.
