<?php

namespace App\Http\Requests\Admin\Logs;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация для страницы списка логов.
 */
class LogRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user' => [
                'nullable',
                'string',
                'max:100',
            ],
            'action' => [
                'nullable',
                'string',
                'max:20',
            ],
            'model' => [
                'nullable',
                'string',
                'max:100',
            ],
            'start_date' => [
                'nullable',
                'date',
            ],
            'to_date' => [
                'nullable',
                'date',
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $filteredInput = array_filter(
            $this->input(),
            static function ($value) {
                return $value !== null;
            }
        );

        $this->replace($filteredInput);
    }
}
