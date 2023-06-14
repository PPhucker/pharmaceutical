<?php

namespace App\View\Components\Sidebar\Menu\Dropdown;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public $icon;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $icon, string $title)
    {
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
        return view('components.sidebar.menu.dropdown.item');
    }
}
