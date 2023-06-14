<?php

namespace App\View\Components\Tables\Filters;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrashedFilter extends Component
{
    public $tableId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tableId)
    {
        $this->tableId = $tableId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.tables.filters.trashed-filter');
    }
}
