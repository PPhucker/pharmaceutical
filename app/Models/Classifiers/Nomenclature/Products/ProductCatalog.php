<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\PlaceOfBusiness;
use App\Models\Auth\User;
use App\Traits\Classifiers\Nomenclature\Products\HasAggregationTypes;
use App\Traits\Classifiers\Nomenclature\Products\HasMaterials;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class ProductCatalog extends Model
{
    use HasFactory, SoftDeletes, HasMaterials, HasAggregationTypes;

    protected $table = 'product_catalog';

    protected $fillable = [
        'user_id',
        'product_id',
        'organization_id',
        'place_of_business_id',
        'GTIN',
    ];

    protected $guarded = [
        'id',
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

    public function endProduct()
    {
        return $this->belongsTo(EndProduct::class, 'product_id')
            ->withTrashed();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id')
            ->withTrashed();
    }

    public function placeOfBusiness()
    {
        return $this->belongsTo(PlaceOfBusiness::class, 'place_of_business_id')
            ->withTrashed();
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_catalog_id')
            ->withTrashed();
    }


}
