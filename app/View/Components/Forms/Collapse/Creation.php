<?php

namespace App\View\Components\Forms\Collapse;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Creation extends Component
{
    public $cardId;
    public $errorName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cardId, $errorName)
    {
        $this->cardId = $cardId;
        $this->errorName = $errorName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.forms.collapse.creation');
    }
}
