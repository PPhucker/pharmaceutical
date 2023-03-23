<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use App\Models\Admin\Organizations\Organization;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
