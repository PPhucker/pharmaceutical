<?php

namespace App\View\Components\Tables;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    public $id;
    /**
     * @var mixed|null
     */
    public $targets;
    /**
     * @var false|mixed
     */
    public $domOrderType;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $domOrderType = false, $targets = null)
    {
        $this->id = $id;
        $this->domOrderType = $domOrderType;
        $this->targets = $targets;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.tables.main');
    }
}
