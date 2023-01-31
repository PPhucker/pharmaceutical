<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $id;
    /**
     * @var mixed|null
     */
    public $targets;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $targets = null)
    {
        $this->id = $id;
        $this->targets = $targets;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.table');
    }
}
