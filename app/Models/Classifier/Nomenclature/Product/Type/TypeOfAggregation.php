<?php

namespace App\Models\Classifier\Nomenclature\Product\Type;

use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Модель типа агрегации готовой продукции.
 */
class TypeOfAggregation extends Model
{
    use HasFactory;
    use RelationshipsTrait;

    public $timestamps = false;

    protected $table = 'classifier_types_of_aggregation';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * @return BelongsToMany
     */
    public function productCatalog(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductCatalog::class,
            'product_catalog_types_of_aggregation'
        )
            ->withPivot('product_quantity');
    }

    /**
     * @return string
     */
    public function getNameWithCodeAttribute(): string
    {
        return $this->code . ' - ' . $this->name;
    }
}
