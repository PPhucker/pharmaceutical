<?php

namespace App\Http\Requests\Documents\Shipment\Waybills;

use App\Http\Requests\Documents\Shipment\UpdateShipmentRequest;

class UpdateWaybillRequest extends UpdateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.waybills.actions.update.fail';

    /**
     * @return array[]
     */
    public function rules()
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
    protected function prepareForValidation()
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
}
