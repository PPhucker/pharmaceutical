<?php

namespace App\Models\Classifiers;

use App\Models\Admin\Organizations\BankAccountDetail;
use App\Models\Contractors\BankAccountDetail as ContractorBankAccountDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
