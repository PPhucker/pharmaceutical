<?php

namespace App\Models\Admin\Organizations;

use App\Models\Auth\User;
use App\Models\Classifiers\LegalForm;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Models\Classifiers\Nomenclature\Products\ProductPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organizations';

    protected $fillable = [
        'user_id',
        'legal_form_type',
        'name',
        'INN',
        'OKPO',
        'contacts'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
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

    public function legalForm()
    {
        return $this->belongsTo(LegalForm::class, 'legal_form_type');
    }

    public function placesOfBusiness()
    {
        return $this->hasMany(PlaceOfBusiness::class)
            ->withTrashed();
    }

    public function bankAccountDetails()
    {
        return $this->hasMany(BankAccountDetail::class)
            ->withTrashed();
    }

    public function staff()
    {
        return $this->hasMany(Staff::class)
            ->withTrashed();
    }

    public function catalogProducts()
    {
        return $this->hasMany(ProductCatalog::class, 'organization_id')
            ->withTrashed();
    }

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class, 'organization_id');
    }
}
