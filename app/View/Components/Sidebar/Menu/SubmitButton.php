<?php

namespace App\View\Components\Sidebar\Menu;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubmitButton extends Component
{
    public $route;
    public $formId;
    public $icon;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $formId, $icon, $title)
    {
        $this->route = $route;
        $this->formId = $formId;
        $this->icon = $icon;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.sidebar.menu.submit-button');
    }
}
