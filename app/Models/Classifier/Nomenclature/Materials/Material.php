<?php

namespace App\Models\Classifier\Nomenclature\Materials;

use App\Models\Auth\User;
use App\Models\Classifier\Nomenclature\OKEI;
use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Classifiers\Nomenclature\Materials\Material
 *
 * @property int                                  $id
 * @property int|null                             $typeId   Тип комплектующего
 * @property string|null                          $okeiCode Код ОКЕИ
 * @property string                               $name     Название комплектующего
 * @property Carbon|null                          $createdAt
 * @property Carbon|null                          $updatedAt
 * @property Carbon|null                          $deletedAt
 * @property-read Collection<int, ProductCatalog> $endProducts
 * @property-read int|null                        $endProductsCount
 * @property-read OKEI|null                       $okei
 * @property-read TypeOfMaterial|null             $type
 * @method static Builder|Material newModelQuery()
 * @method static Builder|Material newQuery()
 * @method static Builder|Material onlyTrashed()
 * @method static Builder|Material query()
 * @method static Builder|Material whereCreatedAt($value)
 * @method static Builder|Material whereDeletedAt($value)
 * @method static Builder|Material whereId($value)
 * @method static Builder|Material whereName($value)
 * @method static Builder|Material whereOkeiCode($value)
 * @method static Builder|Material whereTypeId($value)
 * @method static Builder|Material whereUpdatedAt($value)
 * @method static Builder|Material withTrashed()
 * @method static Builder|Material withoutTrashed()
 * @property float|null $price Цена с НДС
 * @property float|null $nds НДС
 * @property-read Collection<int, ProductCatalog> $endProducts
 * @method static Builder|Material whereNds($value)
 * @method static Builder|Material wherePrice($value)
 * @mixin Eloquent
 */
class Material extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'classifier_materials';

    protected $fillable = [
        'type_id',
        'okei_code',
        'name',
        'price',
        'nds',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y H:i:s');
    }

    /**
     * @return BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(TypeOfMaterial::class, 'type_id');
    }

    /**
     * @return BelongsTo
     */
    public function okei()
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }

    /**
     * @return BelongsToMany
     */
    public function endProducts()
    {
        return $this->belongsToMany(
            ProductCatalog::class,
            'product_catalog_materials'
        )
            ->withPivot('user_id')
            ->withTimestamps();
    }
}
