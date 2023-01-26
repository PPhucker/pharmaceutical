<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $title;
    public $back;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $back = '#')
    {
        $this->back = $back;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.form');
    }
}
