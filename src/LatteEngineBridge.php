<?php


namespace wodCZ\LaravelLatte;


use Illuminate\Contracts\View\Engine as EngineInterface;
use Latte\Engine;

class LatteEngineBridge implements EngineInterface
{

    /** @var Engine */
    private $latte;

    public function __construct(Engine $latte)
    {
        $this->latte = $latte;
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @param  string $path
     * @param  array $data
     * @return string
     */
    public function get($path, array $data = [])
    {
        return $this->latte->renderToString($path, $data);
    }

}
