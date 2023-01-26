<?php

namespace App\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Edit extends Component
{
    public $route;
    /**
     * @var false
     */
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $disabled = false)
    {
        $this->route = $route;
        $this->disabled = (bool)$disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.buttons.edit');
    }
}
