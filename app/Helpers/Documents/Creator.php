<?php

namespace App\Helpers\Documents;

use App\Models\Admin\Organizations\BankAccountDetail as OrganizationAccount;
use App\Models\Contractors\BankAccountDetail as ContractorAccount;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Creator
{
    protected const RUBLES = ['рубль', 'рубля', 'рублей'];

    protected const COPECKS = ['копейка', 'копейки', 'копеек'];

    /**
     * @param OrganizationAccount $account
     *
     * @return object
     */
    protected function getOrganizationAccountDetails(OrganizationAccount $account)
    {
        $bank = $account->bankClassifier;

        return (object)(
            [
                'name' => $bank->name,
                'BIC' => $bank->BIC,
                'correspondent_account' => $bank->correspondent_account,
                'payment_account' => $account->payment_account,
            ]
        );
    }

    /**
     * @param ContractorAccount $account
     *
     * @return object
     */
    protected function getContractorAccountDetails(ContractorAccount $account)
    {
        $bank = $account->bankClassifier;

        return (object)(
            [
                'name' => $bank->name,
                'BIC' => $bank->BIC,
                'correspondent_account' => $bank->correspondent_account,
                'payment_account' => $account->payment_account,
            ]
        );
    }

    /**
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return object
     */
    protected function getInvoiceForPayment(InvoiceForPayment $invoiceForPayment)
    {

        $date = Str::dateInWords(
            Carbon::create($invoiceForPayment->date)->format('Y-m-d'),
            '-',
            ' '
        );

        return (object) [
            'date' => $date,
            'number' => $invoiceForPayment->number,
        ];
    }

    /**
     * @param $number
     *
     * @return string
     */
    protected function numberFormat($number)
    {
        return number_format($number, 2, ',', ' ');
    }
}
