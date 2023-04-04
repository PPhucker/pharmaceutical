<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\PlaceOfBusiness;
use App\Models\Auth\User;
use App\Models\Classifiers\Nomenclature\Materials\Material;
use App\Traits\Classifiers\Nomenclature\Products\HasAggregationTypes;
use App\Traits\Classifiers\Nomenclature\Products\HasMaterials;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Classifiers\Nomenclature\Products\ProductCatalog
 *
 * @property int                                     $id
 * @property int|null                                $userId Пользователь
 * @property int                                     $productId Продукт
 * @property int                                     $organizationId Организация
 * @property int                                     $placeOfBusinessId Место деятельности
 * @property Carbon|null                             $createdAt
 * @property Carbon|null                             $updatedAt
 * @property Carbon|null                             $deletedAt
 * @property string|null                             $GTIN Global Trade Item Number
 * @property-read Collection<int, TypeOfAggregation> $aggregationTypes
 * @property-read int|null                           $aggregationTypesCount
 * @property-read EndProduct                         $endProduct
 * @property-read Collection<int, Material>          $materials
 * @property-read int|null                           $materialsCount
 * @property-read Organization                       $organization
 * @property-read PlaceOfBusiness                    $placeOfBusiness
 * @property-read Collection<int, ProductPrice>      $prices
 * @property-read int|null                           $pricesCount
 * @property-read User|null                          $user
 * @method static Builder|ProductCatalog newModelQuery()
 * @method static Builder|ProductCatalog newQuery()
 * @method static Builder|ProductCatalog onlyTrashed()
 * @method static Builder|ProductCatalog query()
 * @method static Builder|ProductCatalog whereCreatedAt($value)
 * @method static Builder|ProductCatalog whereDeletedAt($value)
 * @method static Builder|ProductCatalog whereGTIN($value)
 * @method static Builder|ProductCatalog whereId($value)
 * @method static Builder|ProductCatalog whereOrganizationId($value)
 * @method static Builder|ProductCatalog wherePlaceOfBusinessId($value)
 * @method static Builder|ProductCatalog whereProductId($value)
 * @method static Builder|ProductCatalog whereUpdatedAt($value)
 * @method static Builder|ProductCatalog whereUserId($value)
 * @method static Builder|ProductCatalog withTrashed()
 * @method static Builder|ProductCatalog withoutTrashed()
 * @mixin Eloquent
 */
class ProductCatalog extends Model
{
    use HasFactory, SoftDeletes, HasMaterials, HasAggregationTypes;

    protected $table = 'product_catalog';

    protected $fillable = [
        'user_id',
        'product_id',
        'organization_id',
        'place_of_business_id',
        'GTIN',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    public function endProduct()
    {
        return $this->belongsTo(EndProduct::class, 'product_id')
            ->withTrashed();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id')
            ->withTrashed();
    }

    public function placeOfBusiness()
    {
        return $this->belongsTo(PlaceOfBusiness::class, 'place_of_business_id')
            ->withTrashed();
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_catalog_id')
            ->withTrashed();
    }


}
