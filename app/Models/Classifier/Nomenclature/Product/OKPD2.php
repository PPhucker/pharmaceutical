<?php

namespace App\Models\Classifier\Nomenclature\Product;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\Nomenclature\Products\OKPD2
 *
 * @property string                                                                       $code Код
 * @property string                                                                       $name Название
 * @property-read Collection<int, EndProduct>                                             $endProducts
 * @property-read int|null                                                                $endProductsCount
 * @method static Builder|OKPD2 newModelQuery()
 * @method static Builder|OKPD2 newQuery()
 * @method static Builder|OKPD2 query()
 * @method static Builder|OKPD2 whereCode($value)
 * @method static Builder|OKPD2 whereName($value)
 * @property-read Collection<int, \App\Models\Classifier\Nomenclature\Product\EndProduct> $endProducts
 * @mixin Eloquent
 */
class OKPD2 extends Model
{
    use HasFactory;

    protected $table = 'classifier_okpd2';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['code', 'name'];

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'okpd2_code');
    }
}
