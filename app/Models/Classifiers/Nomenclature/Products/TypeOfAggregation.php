<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\Nomenclature\Products\TypeOfAggregation
 *
 * @property string                                                             $code Код типа
 * @property string|null                                                        $name Название типа
 * @property-read Collection<int, ProductCatalog> $endProducts
 * @property-read int|null                                                      $endProductsCount
 * @method static Builder|TypeOfAggregation newModelQuery()
 * @method static Builder|TypeOfAggregation newQuery()
 * @method static Builder|TypeOfAggregation query()
 * @method static Builder|TypeOfAggregation whereCode($value)
 * @method static Builder|TypeOfAggregation whereName($value)
 * @mixin Eloquent
 */
class TypeOfAggregation extends Model
{
    use HasFactory;

    protected $table = 'classifier_types_of_aggregation';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    public $timestamps = false;

    protected $fillable = ['code', 'name'];

    public function endProducts()
    {
        return $this->belongsToMany(
            ProductCatalog::class,
            'product_catalog_types_of_aggregation'
        )
            ->withPivot('product_quantity');
    }
}
