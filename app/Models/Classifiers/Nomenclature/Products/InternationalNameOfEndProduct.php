<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\Nomenclature\Products\InternationalNameOfEndProduct
 *
 * @property int                                                            $id
 * @property string                                                         $name Международное непатентованное название
 * @property-read Collection<int, EndProduct> $endProducts
 * @property-read int|null                                                  $endProductsCount
 * @method static Builder|InternationalNameOfEndProduct newModelQuery()
 * @method static Builder|InternationalNameOfEndProduct newQuery()
 * @method static Builder|InternationalNameOfEndProduct query()
 * @method static Builder|InternationalNameOfEndProduct whereId($value)
 * @method static Builder|InternationalNameOfEndProduct whereName($value)
 * @mixin Eloquent
 */
class InternationalNameOfEndProduct extends Model
{
    use HasFactory;

    protected $table = 'classifier_international_names_of_end_products';

    public $timestamps = false;

    protected $fillable = ['name'];

    protected $guarded = ['id'];

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'international_name_id');
    }
}
