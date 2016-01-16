<?php

namespace Dasim\LaravelLatte;

class LatteGlobals
{

  private $globals = [];


  public function getGlobals()
  {
    return $this->globals;
  }


  public function addGlobal($key, $value)
  {
      $this->globals[$key] = $value;
  }

}