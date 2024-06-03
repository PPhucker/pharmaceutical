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

    public $disabled;

    public $errorName;

    public $min;

    public $max;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name = null,
        string $value = null,
        string $id = null,
        string $type = 'text',
        string $class = 'form-control',
        string $errorName = null,
        string $min = null,
        string $max = null,
        bool $required = null,
        bool $readonly = null,
        bool $checked = null,
        bool $disabled = null
    ) {
        $this->id = $id;
        $this->name = $name ?: $id;
        $this->errorName = $this->transformBracketedName($this->name);
        $this->value = $value ?? old($this->transformBracketedName($this->name));
        $this->type = $type;
        $this->class = $class;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->checked = $checked;
        $this->disabled = $disabled;
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
