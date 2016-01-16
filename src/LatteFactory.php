<?php

namespace Dasim\LaravelLatte;

use Illuminate\Contracts\View\Factory as FactoryContract;
use Illuminate\Foundation\Application;
use RuntimeException;

class LatteFactory implements FactoryContract
{

  private $latte;
  private $globals;

  public function __construct(Application $app)
  {
    $this->latte = $app['latte.engine'];
    $this->globals = $app['latte.globals'];
  }

  public function exists($view)
  {
    try {
        $content = $this->latte->getLoader()->getContent($view);
        return true;
    } catch (RuntimeException $e) {
        return false;
    }
  }

  /**
   * Get the evaluated view contents for the given path.
   *
   * @param  string $path
   * @param  array $data
   * @param  array $mergeData
   * @return \Illuminate\Contracts\View\View
   */
  public function file($path, $data = [], $mergeData = [])
  {
    // or maybe use the String loader
    if (!file_exists($path)) {
      return false;
    }

    $filePath = dirname($path);
    $fileName = basename($path);

    $this->latte->getLoader()->addPath($filePath);

    return new LatteView($this, $fileName, $data);
  }

  public function make($view, $data = [], $mergeData = [])
  {
    $data = array_merge($mergeData, $data);

    return new LatteView($this, $view, $data);
  }

  public function share($key, $value = null)
  {
    $this->globals->addGlobal($key, $value);
  }

  public function render($view, $data)
  {
    $view =
        resource_path()
        . '/views/'
        . str_replace('.', '/', $view)
        . '.latte';
    foreach ($this->globals->getGlobals() as $key => $value) {
        $data[$key] = $value;
    }
    return $this->latte->render($view, $data);
  }

  /**
   * Register a view composer event.
   *
   * @param  array|string $views
   * @param  \Closure|string $callback
   * @param  int|null $priority
   * @return array
   */
  public function composer($views, $callback, $priority = null)
  {

  }

  /**
   * Register a view creator event.
   *
   * @param  array|string $views
   * @param  \Closure|string $callback
   * @return array
   */
  public function creator($views, $callback)
  {

  }

  /**
   * Add a new namespace to the loader.
   *
   * @param  string $namespace
   * @param  string|array $hints
   * @return void
   */
  public function addNamespace($namespace, $hints)
  {

  }

}