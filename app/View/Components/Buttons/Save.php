<?php

namespace App\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Save extends Component
{
    public $formId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($formId)
    {
        $this->formId = $formId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.buttons.save');
    }
}
