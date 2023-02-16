<?php

namespace App\View\Components\Tables\Filters;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateFilter extends Component
{
    public $fromDate;
    public $toDate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.tables.filters.date-filter');
    }
}
