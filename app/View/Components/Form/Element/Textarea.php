<?php

namespace App\View\Components\Form\Element;

use App\View\Components\Form\FormElement;
use Illuminate\View\View;

/**
 * Компонент элемента Textarea.
 */
class Textarea extends FormElement
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string|null
     */
    public $id;
    /**
     * @var string|null
     */
    public $text;
    /**
     * @var int
     */
    public $rows;
    /**
     * @var string
     */
    public $errorName;
    /**
     * @var bool
     */
    public $readonly;

    /**
     * @param string      $name
     * @param string|null $id
     * @param string|null $text
     * @param bool        $readonly
     * @param int         $rows
     */
    public function __construct(
        string $name,
        string $id = null,
        string $text = null,
        bool $readonly = false,
        int $rows = 2
    ) {
        $this->name = $name;
        $this->errorName = $this->transformBracketedName($name);
        $this->id = $id;
        $this->readonly = $readonly;
        $this->text = $text;
        $this->rows = $rows;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('components.form.element.textarea');
    }
}
