<?php

namespace App\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Detach extends Component
{
    public $route;
    public $itemId;
    public $detachId;
    public $detachName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $itemId, $detachName, $detachId)
    {
        $this->route = $route;
        $this->itemId = $itemId;
        $this->detachName = $detachName;
        $this->detachId = $detachId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.buttons.detach');
    }
}
