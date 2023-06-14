<?php

namespace App\View\Components\Sidebar;

use App\Models\Auth\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * @var string[]
     */
    public $organizations;
    public $position;
    public $id;
    public $label;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($position, $id, $label, $title)
    {
        /** TODO: Here will be a list of organizations after the creation of the corresponding model */
        $this->organizations = [
            (object)([
                'id' => 1,
                'name' => 'Company1'
            ]),
            (object)([
                'id' => 2,
                'name' => 'Company2'
            ]),
        ];
        /** */

        $this->position = $position;
        $this->id = $id;
        $this->label = $label;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.sidebar.menu');
    }
}
