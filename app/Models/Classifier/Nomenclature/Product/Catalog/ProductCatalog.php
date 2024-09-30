<?php

namespace App\Models\Classifier\Nomenclature\Product\Catalog;

use App\Models\Classifier\Nomenclature\Product\EndProduct;
use App\Models\Classifier\Nomenclature\Product\Type\TypeOfAggregation;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use App\Traits\Classifier\Nomenclature\Product\Catalog\Relation\HasPrices;
use App\Traits\Classifier\Nomenclature\Product\Catalog\Relation\HasRegionalAllowances;
use App\Traits\Classifier\Nomenclature\Relation\Material\HasMaterials;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\Organization\Relation\HasOrganization;
use App\Traits\Organization\Relation\HasPlaceOfBusiness;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    use HasUser;
    use HasOrganization;
    use HasPlaceOfBusiness;
    use HasPrices;
    use HasRegionalAllowances;
    use RelationshipsTrait;

    protected $table = 'product_catalog';

    protected $foreign_key = 'product_catalog_id';

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
     * @return string
     */
    public function getPlaceOfProductionAttribute(): string
    {
        return $this->organization->full_name . ' - ' . $this->placeOfBusiness->address;
    }

    /**
     * @return string
     */
    public function getNameWithGTINAttribute(): string
    {
        $fullName = $this->endProduct->full_name;

        return $this->GTIN
            ? $fullName . ' GTIN: ' . $this->GTIN
            : $fullName;
    }

    /**
     * @return HasMany
     */
    public function invoiceForPaymentProduction(): HasMany
    {
        return $this->hasMany(InvoiceForPaymentProduct::class, 'product_catalog_id');
    }

    /**
     * @return HasMany
     */
    public function packingListProduction(): HasMany
    {
        return $this->hasMany(PackingListProduct::class, 'product_id');
    }

    /**
     * @return BelongsTo
     */
    public function endProduct(): BelongsTo
    {
        return $this->belongsTo(EndProduct::class, 'product_id');
    }

    /**
     * @return BelongsToMany
     */
    public function aggregationTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            TypeOfAggregation::class,
            'product_catalog_types_of_aggregation',
            'product_catalog_id',
            'aggregation_type'
        )
            ->withPivot('product_quantity');
    }
}
