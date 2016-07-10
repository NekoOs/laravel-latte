# wodCZ/laravel-latte

Integration of [Latte: amazing template engine for PHP](https://github.com/nette/latte) to Laravel

## Installation

This package registers Latte engine and .latte extension to existing EngineResolver and FileViewFinder.

Unfortunately, FileViewFinder is not registered as singleton in Laravel view provider, so this package has to override
 its implementation. In fact, it is the same code as in current Laravel, with `latte` extension added.
 Result of this is that it may not be compatible with future versions - please keep this in mind.

```
composer require wodcz/laravel-latte:dev-master
```

then register
```
\wodCZ\LaravelLatte\LatteProvider::class,
```
after
```
Illuminate\View\ViewServiceProvider::class,
```

## Disclaimer

This is my very-first integration, it was not used more than by renaming welcome.blade.php to welcome.latte.
Things may not work.
