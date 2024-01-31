<?php

namespace App\Models\Admin\Organization;

use App\Models\Auth\User;
use App\Models\Classifiers\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


class BankAccountDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organizations_bank_account_details';

    protected $fillable = [
        'organization_id',
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

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function bankClassifier()
    {
        return $this->belongsTo(Bank::class, 'bank');
    }
}
