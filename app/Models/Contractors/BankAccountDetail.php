<?php

namespace App\Models\Contractors;

use App\Models\Classifiers\Bank;
use App\Traits\Contractor\HasContractor;
use App\Traits\Document\HasInvoicesForPayment;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель банковских реквизитов контрагента.
 */
class BankAccountDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUser;
    use HasContractor;
    use HasInvoicesForPayment;
    use RelationshipsTrait;

    protected $table = 'contractors_bank_account_details';

    protected $foreign_key = 'contractor_bank_id';

    protected $fillable = [
        'contractor_id',
        'user_id',
        'bank',
        'payment_account'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    /**
     * @return BelongsTo
     */
    public function bankClassifier(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank');
    }
}
