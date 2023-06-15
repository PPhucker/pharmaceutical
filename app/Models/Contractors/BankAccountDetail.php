<?php

namespace App\Models\Contractors;

use App\Models\Auth\User;
use App\Models\Classifiers\Bank;
use App\Traits\Contractors\BankAccountDetails\Documents\HasDocuments;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Contractors\BankAccountDetail
 *
 * @property int             $id
 * @property int             $contractorId
 * @property int|null        $userId
 * @property string|null     $bank
 * @property string          $paymentAccount
 * @property Carbon|null     $createdAt
 * @property Carbon|null     $updatedAt
 * @property Carbon|null     $deletedAt
 * @property-read Bank|null  $bankClassifier
 * @property-read Contractor $contractor
 * @property-read User|null  $user
 * @method static Builder|BankAccountDetail newModelQuery()
 * @method static Builder|BankAccountDetail newQuery()
 * @method static Builder|BankAccountDetail onlyTrashed()
 * @method static Builder|BankAccountDetail query()
 * @method static Builder|BankAccountDetail whereBank($value)
 * @method static Builder|BankAccountDetail whereContractorId($value)
 * @method static Builder|BankAccountDetail whereCreatedAt($value)
 * @method static Builder|BankAccountDetail whereDeletedAt($value)
 * @method static Builder|BankAccountDetail whereId($value)
 * @method static Builder|BankAccountDetail wherePaymentAccount($value)
 * @method static Builder|BankAccountDetail whereUpdatedAt($value)
 * @method static Builder|BankAccountDetail whereUserId($value)
 * @method static Builder|BankAccountDetail withTrashed()
 * @method static Builder|BankAccountDetail withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Documents\InvoicesForPayment\InvoiceForPayment> $invoicesForPayment
 * @property-read int|null $invoicesForPaymentCount
 * @mixin Eloquent
 */
class BankAccountDetail extends Model
{
    use HasFactory, HasDocuments, SoftDeletes;

    protected $table = 'contractors_bank_account_details';

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

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function bankClassifier()
    {
        return $this->belongsTo(Bank::class, 'bank');
    }
}
