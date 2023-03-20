<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use App\Models\Auth\User;
use App\Models\Classifiers\Nomenclature\OKEI;
use App\Traits\Classifiers\Nomenclature\Products\HasAggregationTypes;
use App\Traits\Classifiers\Nomenclature\Products\HasMaterials;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class EndProduct extends Model
{
    use HasFactory, SoftDeletes, HasMaterials, HasAggregationTypes;

    protected $table = 'classifier_end_products';

    protected $fillable = [
        'user_id',
        'type_id',
        'international_name_id',
        'registration_number_id',
        'okei_code',
        'okpd2_code',
        'short_name',
        'full_name',
        'marking',
        'best_before_date',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    public function type()
    {
        return $this->belongsTo(TypeOfEndProduct::class, 'type_id');
    }

    public function internationalName()
    {
        return $this->belongsTo(InternationalNameOfEndProduct::class, 'international_name_id');
    }

    public function registrationNumber()
    {
        return $this->belongsTo(RegistrationNumberOfEndProduct::class, 'registration_number_id');
    }

    public function okei()
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }

    public function okpd2()
    {
        return $this->belongsTo(OKPD2::class, 'okpd2_code');
    }
}
