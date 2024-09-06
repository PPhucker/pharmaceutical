<?php

namespace App\Models\Classifier\Nomenclature\Product\Catalog\Price;

use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\Organization\Relation\HasOrganization;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель цены продукта
 */
class ProductPrice extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RelationshipsTrait;
    use HasUser;
    use HasOrganization;

    protected $table = 'product_prices';

    protected $fillable = [
        'user_id',
        'product_catalog_id',
        'organization_id',
        'price',
        'nds',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i:s');
    }

    /**
     * @return BelongsTo
     */
    public function catalogProduct()
    {
        return $this->belongsTo(ProductCatalog::class, 'product_catalog_id');
    }
}
