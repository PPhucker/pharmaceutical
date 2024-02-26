<?php

namespace App\Models\Classifier\Nomenclature\Product;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProduct
 *
 * @property int                                                                          $id
 * @property string                                                                       $number Регистрационный номер
 * @property-read Collection<int, EndProduct>                                             $endProducts
 * @property-read int|null                                                                $endProductsCount
 * @method static Builder|RegistrationNumberOfEndProduct newModelQuery()
 * @method static Builder|RegistrationNumberOfEndProduct newQuery()
 * @method static Builder|RegistrationNumberOfEndProduct query()
 * @method static Builder|RegistrationNumberOfEndProduct whereId($value)
 * @method static Builder|RegistrationNumberOfEndProduct whereNumber($value)
 * @property-read Collection<int, \App\Models\Classifier\Nomenclature\Product\EndProduct> $endProducts
 * @mixin Eloquent
 */
class RegistrationNumberOfEndProduct extends Model
{
    use HasFactory;

    protected $table = 'classifier_registration_numbers_of_end_products';

    protected $fillable = ['number'];

    protected $guarded = ['id'];

    public $timestamps = false;

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'registration_number_id');
    }
}
