<?php

namespace App\Http\Requests\Documents\Shipment\PackingLists;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CreatePackingListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_for_payment_id' => [
                'required',
                'array',
                static function ($attribute, $value, $fail) {
                    $organizations = [];
                    $contractors = [];
                    $errors = [];
                    foreach ($value as $invoiceForPaymentId) {
                        $invoiceForPayment = InvoiceForPayment::find((int)$invoiceForPaymentId);
                        $organizations[] = $invoiceForPayment->organization->id;
                        $contractors[] = $invoiceForPayment->contractor->id;
                    }
                    /**
                     * Если разные поставщики в выбранных счетах на оплату
                     */
                    if (count(array_unique($organizations)) > 1) {
                        $errors[] = __('documents.shipment.packing_lists.errors.organization_id');
                    }
                    /**
                     * Если разные грузополучатели в выбранных счетах на оплату
                     */
                    if (count(array_unique($contractors)) > 1) {
                        $errors[] = __('documents.shipment.packing_lists.errors.contractor_id');
                    }

                    if ($errors) {
                        $fail($errors);
                    }
                },
            ],
            'invoice_for_payment_id.*' => [
                'required',
                'numeric',
            ],
        ];
    }

    public function messages()
    {
        return [
            'invoice_for_payment_id.required' => __(
                'documents.shipment.packing_lists.errors.invoice_for_payment_id'
            ),
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                foreach ($validator->errors()->get('invoice_for_payment_id') as $message) {
                    $validator->errors()->add(
                        'alert-errors',
                        $message
                    );
                }
            }
        });
    }
}
