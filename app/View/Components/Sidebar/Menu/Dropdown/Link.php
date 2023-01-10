<?php

namespace App\View\Components\Sidebar\Menu\Dropdown;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    public $route;
    /**
     * @var string
     */
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, string $title)
    {
        $this->route = $route;
        $this->title = __($title);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.sidebar.menu.dropdown.link');
    }
}
