<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Restore extends Component
{
    public $route;
    public $itemId;
    /**
     * @var false|mixed
     */
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $itemId, $disabled = false)
    {
        $this->route = $route;
        $this->itemId = $itemId;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.buttons.restore');
    }
}
