<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

abstract class FormElement extends Component
{
    /**
     * Замена скобок на точки в имени элемента массива.
     *
     * @param string $name
     *
     * @return string
     */
    protected function transformBracketedName(string $name): string
    {
        if (mb_substr($name, -1) === ']') {
            $name = rtrim(
                str_replace(
                    ['[', ']'],
                    '.',
                    str_replace(
                        '][',
                        '.',
                        $name
                    )
                ),
                '.'
            );
        }

        return $name;
    }
}
