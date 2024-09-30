<?php

namespace App\Models\Admin\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Contractor\BankAccountDetail as ContractorBankAccountDetail;

/**
 * Модель банковских реквизитов организации.
 */
class BankAccountDetail extends ContractorBankAccountDetail
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'organizations_bank_account_details';

    protected $foreign_key = 'organization_bank_id';

    protected $fillable = [
        'organization_id',
        'user_id',
        'bank',
        'payment_account'
    ];
}
