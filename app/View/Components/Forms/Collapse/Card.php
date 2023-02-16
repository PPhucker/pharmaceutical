<?php

namespace App\View\Components\Forms\Collapse;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $cardId;
    public $formId;
    public $title;
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cardId, $formId, $title, $route)
    {
        $this->cardId = $cardId;
        $this->formId = $formId;
        $this->title = $title;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.forms.collapse.card');
    }
}
