<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Warning extends Component
{
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.forms.warning');
    }
}
