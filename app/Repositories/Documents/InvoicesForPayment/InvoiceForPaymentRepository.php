<?php

namespace App\Repositories\Documents\InvoicesForPayment;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment as Model;
use App\Repositories\CoreRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Репозиторий счетов на оплату.
 */
class InvoiceForPaymentRepository extends CoreRepository
{
    /**
     * Все счета на оплату.
     *
     * @param array $filters
     *
     * @return Collection
     */
    public function getAll(array $filters): Collection
    {
        $invoices = $this->clone()->select(
            [
                'documents_invoices_for_payment.id',
                'documents_invoices_for_payment.user_id',
                'documents_invoices_for_payment.organization_id',
                'documents_invoices_for_payment.organization_place_id',
                'documents_invoices_for_payment.contractor_id',
                'documents_invoices_for_payment.contractor_place_id',
                'documents_invoices_for_payment.number',
                'documents_invoices_for_payment.date',
                'documents_invoices_for_payment.deleted_at',
            ]
        );

        if (isset($filters['organization_id'])) {
            $invoices->where(
                'documents_invoices_for_payment.organization_id',
                (int)$filters['organization_id']
            );
        }

        if (isset($filters['filling_type'])) {
            $invoices->where(
                'documents_invoices_for_payment.filling_type',
                $filters['filling_type']
            );
        }

        return $invoices
            ->whereBetween(
                'documents_invoices_for_payment.date',
                [$filters['fromDate'], $filters['toDate']]
            )
            ->withTrashed()
            ->with(
                [
                    'organization:id,name,legal_form_type',
                    'organizationPlaceOfBusiness:id,address',
                    'contractor:id,name,legal_form_type',
                    'contractorPlaceOfBusiness:id,address',
                ]
            )
            ->orderBy('date', 'desc')
            ->orderBy('number', 'desc')
            ->get();
    }

    /**
     * Счет на оплату по ID.
     *
     * @param int $id
     *
     * @return InvoiceForPayment
     */
    public function getById(int $id): InvoiceForPayment
    {
        $invoice = $this->clone()->find($id);

        $invoice->load(
            [
                'user' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name'
                        ]
                    );
                },
                'contractor' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'legal_form_type'
                        ]
                    )
                        ->with('legalForm:abbreviation');
                },
                'contractorPlaceOfBusiness' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'address',
                        ]
                    );
                },
                'contractorBankAccountDetail' => static function ($query) {
                    $query->select(
                        'id',
                        'bank',
                        'payment_account',
                    )
                        ->with('bankClassifier:BIC,name');
                },
                'organization' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'legal_form_type'
                        ]
                    )
                        ->with(
                            [
                                'legalForm:abbreviation',
                            ]
                        );
                },
                'organizationPlaceOfBusiness' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'address',
                        ]
                    );
                },
                'organizationBankAccountDetail' => static function ($query) {
                    $query->select(
                        'id',
                        'bank',
                        'payment_account',
                    )
                        ->with('bankClassifier:BIC,name');
                },
            ]
        );

        return $invoice;
    }

    /**
     * Хранилище счетов на оплату.
     *
     * @param int $id
     *
     * @return Collection
     */
    public function getStorage(int $id): Collection
    {
        $invoice = $this->model::find($id);

        $fileDate = Carbon::create($invoice->date);

        return collect(
            [
                'directory' => Model::FILES_DIRECTORY
                    . $fileDate->format('Y')
                    . '/'
                    . $fileDate->format('m')
                    . '/',
                'filename' => '№'
                    . $invoice->number
                    . '_'
                    . Carbon::now()->format('d_m_Y_H_i_s')
                    . '.pdf',
            ]
        );
    }

    /**
     * Получить последний номер счета за текущий год.
     *
     * @param int $organizationId
     *
     * @return int
     */
    public function getLastNumber(int $organizationId): int
    {
        return (int)$this->model::whereYear(
            'created_at',
            date('Y')
        )
            ->where(
                'organization_id',
                '=',
                $organizationId
            )
            ->withoutTrashed()
            ->latest()
            ->first()
            ->number;
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
