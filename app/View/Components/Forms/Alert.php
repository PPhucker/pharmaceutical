<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public $success;
    public $fail;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($success = 'success', $fail = 'fail')
    {
        $this->success = $success;
        $this->fail = $fail;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.forms.alert');
    }
}
