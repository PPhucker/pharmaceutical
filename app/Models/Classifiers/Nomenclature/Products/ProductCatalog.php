<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\PlaceOfBusiness;
use App\Models\Auth\User;
use App\Traits\Classifiers\Nomenclature\Products\HasAggregationTypes;
use App\Traits\Classifiers\Nomenclature\Products\HasDocuments;
use App\Traits\Classifiers\Nomenclature\Products\HasMaterials;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель готовой продукции из каталога.
 */
class ProductCatalog extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasMaterials;
    use HasAggregationTypes;
    use HasDocuments;

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

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date): string
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i:s');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function endProduct(): BelongsTo
    {
        return $this->belongsTo(EndProduct::class, 'product_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function placeOfBusiness(): BelongsTo
    {
        return $this->belongsTo(PlaceOfBusiness::class, 'place_of_business_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_catalog_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function regionalAllowances(): HasMany
    {
        return $this->hasMany(ProductRegionalAllowance::class, 'product_catalog_id');
    }
}
