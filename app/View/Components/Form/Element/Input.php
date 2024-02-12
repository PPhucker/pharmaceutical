<?php

namespace App\View\Components\Form\Element;

use App\View\Components\Form\FormElement;
use Illuminate\View\View;

/**
 * Компонент элемента Input.
 */
class Input extends FormElement
{

    public $name;

    public $value;

    public $id;

    public $type;

    public $class;

    public $required;

    public $readonly;

    public $checked;

    public $errorName;

    public $min;

    public $max;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        string $value = null,
        string $id = null,
        string $type = 'text',
        string $class = 'form-control',
        string $errorName = null,
        string $min = null,
        string $max = null,
        bool $required = null,
        bool $readonly = null,
        bool $checked = null
    ) {
        $this->name = $name;
        $this->errorName = $this->transformBracketedName($name);
        $this->value = $value ?? old($name);
        $this->id = $id;
        $this->type = $type;
        $this->class = $class;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->checked = $checked;
        $this->max = $max;
        $this->min = $min;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.form.element.input');
    }
}
