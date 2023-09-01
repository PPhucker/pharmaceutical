<?php

namespace App\Http\Requests\Documents\Shipment\Waybills;

use App\Http\Requests\Documents\Shipment\UpdateShipmentRequest;
use App\Models\Documents\Shipment\Waybills\Waybill;
use Illuminate\Validation\Validator;

/**
 * Валидация обновления товарно-транспортной накладной.
 */
class UpdateWaybillRequest extends UpdateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.waybills.actions.update.fail';

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return array_merge(
            $this->rules,
            [
                'car_model' => [
                    'nullable',
                    'string',
                    'max:20',
                ],
                'state_car_number' => [
                    'nullable',
                    'string',
                    'max:15',
                ],
                'driver' => [
                    'nullable',
                    'string',
                    'max:40',
                ],
                'licence_card' => [
                    'nullable',
                    'string',
                    'max:15',
                ],
                'type_of_transportation' => [
                    'nullable',
                    'string',
                    'max:15',
                ],
                'trailer_1' => [
                    'nullable',
                    'string',
                    'max:10',
                ],
                'trailer_2' => [
                    'nullable',
                    'string',
                    'max:10',
                ],
                'state_trailer_1_number' => [
                    'nullable',
                    'string',
                    'max:15',
                ],
                'state_trailer_2_number' => [
                    'nullable',
                    'string',
                    'max:15',
                ],
            ]
        );
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $separator = ' - ';

        if ($car = $this->input('car')) {
            [$carModel, $carStateNumber] = explode($separator, $car);
            $this->merge(
                [
                    'car_model' => $carModel,
                    'state_car_number' => $carStateNumber,
                ]
            );
        } else {
            $this->merge(
                [
                    'car_model' => null,
                    'state_car_number' => null,
                ]
            );
        }

        if ($firstTrailer = $this->input('first_trailer')) {
            [$firstTrailerType, $firstTrailerStateNumber] = explode($separator, $firstTrailer);
            $this->merge(
                [
                    'trailer_1' => $firstTrailerType,
                    'state_trailer_1_number' => $firstTrailerStateNumber,
                ]
            );
        } else {
            $this->merge(
                [
                    'trailer_1' => null,
                    'state_trailer_1_number' => null,
                ]
            );
        }

        if ($secondTrailer = $this->input('second_trailer')) {
            [$secondTrailerType, $secondTrailerStateNumber] = explode($separator, $secondTrailer);
            $this->merge(
                [
                    'trailer_2' => $secondTrailerType,
                    'state_trailer_2_number' => $secondTrailerStateNumber,
                ]
            );
        } else {
            $this->merge(
                [
                    'trailer_2' => null,
                    'state_trailer_2_number' => null,
                ]
            );
        }
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $waybillId = (int)$this->input('document_id');

        $validator->after(function ($validator) use ($waybillId) {
            if (Waybill::find($waybillId)->approved) {
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.errors.approve_update')
                );
            }
        });

        parent::withValidator($validator);
    }
}
