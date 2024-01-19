<?php

namespace App\Models\Classifiers;

use App\Models\Admin\Organizations\BankAccountDetail;
use App\Models\Contractor\BankAccountDetail as ContractorBankAccountDetail;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\Bank
 *
 * @property string $BIC
 * @property string $correspondentAccount
 * @property string $name
 * @property-read Collection<int, BankAccountDetail> $bankAccountDetails
 * @property-read int|null $bankAccountDetailsCount
 * @property-read Collection<int, ContractorBankAccountDetail> $contractorsBankAccountDetails
 * @property-read int|null $contractorsBankAccountDetailsCount
 * @method static Builder|Bank newModelQuery()
 * @method static Builder|Bank newQuery()
 * @method static Builder|Bank query()
 * @method static Builder|Bank whereBIC($value)
 * @method static Builder|Bank whereCorrespondentAccount($value)
 * @method static Builder|Bank whereName($value)
 * @property-read Collection<int, BankAccountDetail> $bankAccountDetails
 * @property-read Collection<int, ContractorBankAccountDetail> $contractorsBankAccountDetails
 * @mixin Eloquent
 */
class Bank extends Model
{
    use HasFactory;

    protected $table = 'classifier_banks';

    protected $keyType = 'string';

    protected $primaryKey = 'BIC';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['BIC', 'correspondent_account', 'name'];

    public function bankAccountDetails()
    {
        return $this->hasMany(BankAccountDetail::class, 'bank')
            ->withTrashed();
    }

    public function contractorsBankAccountDetails()
    {
        return $this->hasMany(ContractorBankAccountDetail::class, 'bank')
            ->withTrashed();
    }
}
