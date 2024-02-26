<?php

namespace App\Models\Classifier\Nomenclature\Product;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\Nomenclature\Products\TypeOfEndProduct
 *
 * @property int                                                            $id
 * @property string|null                                                                  $color Цвет типа
 * @property string                                                                       $name Тип готовой продукции
 * @property-read Collection<int, EndProduct>                                             $endProducts
 * @property-read int|null                                                                $endProductsCount
 * @method static Builder|TypeOfEndProduct newModelQuery()
 * @method static Builder|TypeOfEndProduct newQuery()
 * @method static Builder|TypeOfEndProduct query()
 * @method static Builder|TypeOfEndProduct whereColor($value)
 * @method static Builder|TypeOfEndProduct whereId($value)
 * @method static Builder|TypeOfEndProduct whereName($value)
 * @property-read Collection<int, \App\Models\Classifier\Nomenclature\Product\EndProduct> $endProducts
 * @mixin Eloquent
 */
class TypeOfEndProduct extends Model
{
    use HasFactory;

    protected $table = 'classifier_types_of_end_products';

    protected $fillable = ['name', 'color'];

    protected $guarded = ['id'];

    public $timestamps = false;

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'type_id')
            ->withTrashed();
    }
}
