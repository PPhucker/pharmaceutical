<?php

namespace App\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Delete extends Component
{
    public $route;
    public $itemId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $itemId)
    {
        $this->route = $route;
        $this->itemId = $itemId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.buttons.delete');
    }
}
