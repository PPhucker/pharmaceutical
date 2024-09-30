<?php

namespace App\View\Components\Form\Element;

use App\View\Components\Form\FormElement;
use Illuminate\View\View;

/**
 * Компонент элемента Select.
 */
class Select extends FormElement
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $errorName;
    /**
     * @var string|null
     */
    public $id;
    /**
     * @var bool
     */
    public $readonly;

    /**
     * @param string      $name
     * @param string|null $id
     */
    public function __construct(string $name, string $id = null)
    {
        $this->name = $name;
        $this->errorName = $this->transformBracketedName($name);
        $this->id = $id;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('components.form.element.select');
    }
}
