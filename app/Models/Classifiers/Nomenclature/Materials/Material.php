<?php

namespace App\Models\Classifiers\Nomenclature\Materials;

use App\Models\Classifiers\Nomenclature\OKEI;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Classifiers\Nomenclature\Materials\Material
 *
 * @property int                                                                $id
 * @property int|null                                                           $typeId Тип комплектующего
 * @property string|null                                                        $okeiCode Код ОКЕИ
 * @property string                                                             $name Название комплектующего
 * @property Carbon|null                                                        $createdAt
 * @property Carbon|null                                                        $updatedAt
 * @property Carbon|null                                                        $deletedAt
 * @property-read Collection<int, ProductCatalog> $endProducts
 * @property-read int|null                                                      $endProductsCount
 * @property-read OKEI|null                                                     $okei
 * @property-read TypeOfMaterial|null                                           $type
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
 * @mixin Eloquent
 */
class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classifier_materials';

    protected $fillable = ['type_id', 'okei_code', 'name'];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }
    public function type()
    {
        return $this->belongsTo(TypeOfMaterial::class, 'type_id');
    }

    public function okei()
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }

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
