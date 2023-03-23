<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
