<?php

namespace App\Models\Classifier\Nomenclature\Product;

use App\Models\Auth\User;
use App\Models\Classifier\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель региональной надвабки готовой продукции.
 */
class ProductRegionalAllowance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_regional_allowances';

    protected $fillable = [
        'user_id',
        'product_catalog_id',
        'region_id',
        'allowance',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCatalog::class, 'product_catalog_id');
    }

    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
