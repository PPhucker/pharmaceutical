<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use App\Models\Admin\Organizations\Organization;
use App\Models\Auth\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Classifiers\Nomenclature\Products\ProductPrice
 *
 * @property int $id
 * @property int|null            $userId Пользователь
 * @property int                 $productCatalogId Продукт из каталога
 * @property int                 $organizationId Организация
 * @property float               $retailPrice Розничная цена
 * @property float|null          $tradePrice Оптовая цена
 * @property float               $nds НДС
 * @property int|null            $tradeQuantity Кол-во продукции для оптовой цены
 * @property Carbon|null         $createdAt
 * @property Carbon|null         $updatedAt
 * @property Carbon|null         $deletedAt
 * @property-read ProductCatalog $catalogProduct
 * @property-read Organization   $organization
 * @property-read User|null      $user
 * @method static Builder|ProductPrice newModelQuery()
 * @method static Builder|ProductPrice newQuery()
 * @method static Builder|ProductPrice onlyTrashed()
 * @method static Builder|ProductPrice query()
 * @method static Builder|ProductPrice whereCreatedAt($value)
 * @method static Builder|ProductPrice whereDeletedAt($value)
 * @method static Builder|ProductPrice whereId($value)
 * @method static Builder|ProductPrice whereNds($value)
 * @method static Builder|ProductPrice whereOrganizationId($value)
 * @method static Builder|ProductPrice whereProductCatalogId($value)
 * @method static Builder|ProductPrice whereRetailPrice($value)
 * @method static Builder|ProductPrice whereTradePrice($value)
 * @method static Builder|ProductPrice whereTradeQuantity($value)
 * @method static Builder|ProductPrice whereUpdatedAt($value)
 * @method static Builder|ProductPrice whereUserId($value)
 * @method static Builder|ProductPrice withTrashed()
 * @method static Builder|ProductPrice withoutTrashed()
 * @mixin Eloquent
 */
class ProductPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_prices';

    protected $fillable = [
        'user_id',
        'product_catalog_id',
        'organization_id',
        'retail_price',
        'trade_price',
        'nds',
        'trade_quantity',
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

    public function catalogProduct()
    {
        return $this->belongsTo(ProductCatalog::class, 'product_catalog_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
