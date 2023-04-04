<?php

namespace App\Models\Classifiers\Nomenclature;

use App\Models\Classifiers\Nomenclature\Materials\Material;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\Nomenclature\OKEI
 *
 * @property string $code Код
 * @property string $unit Единица измерения
 * @property string $symbol Сокращение единицы измерения
 * @property-read Collection<int, EndProduct> $endProducts
 * @property-read int|null $endProductsCount
 * @property-read Collection<int, Material> $materials
 * @property-read int|null $materialsCount
 * @method static Builder|OKEI newModelQuery()
 * @method static Builder|OKEI newQuery()
 * @method static Builder|OKEI query()
 * @method static Builder|OKEI whereCode($value)
 * @method static Builder|OKEI whereSymbol($value)
 * @method static Builder|OKEI whereUnit($value)
 * @mixin Eloquent
 */
class OKEI extends Model
{
    use HasFactory;

    protected $table = 'classifier_okei';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'unit', 'symbol'];

    public $timestamps = false;

    public function materials()
    {
        return $this->hasMany(Material::class, 'okei_code')
            ->withTrashed();
    }

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'okei_code');
    }
}
