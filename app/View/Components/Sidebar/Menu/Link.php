<?php

namespace App\View\Components\Sidebar\Menu;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    public $icon;
    public $title;
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $icon, $title)
    {
        $this->icon = $icon;
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
        return view('components.sidebar.menu.link');
    }
}
