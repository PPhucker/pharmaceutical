<?php

namespace App\View\Components\Tables\Filters;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectFilter extends Component
{
    public $title;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $name)
    {
        $this->title = $title;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.tables.filters.select-filter');
    }
}
