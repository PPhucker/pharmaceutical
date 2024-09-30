<?php

namespace App\Models\Classifier\Nomenclature\Material;

use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use App\Traits\Classifier\Nomenclature\Relation\HasOkeiClassifier;
use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель комплектующего.
 */
class Material extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RelationshipsTrait;
    use HasOkeiClassifier;

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
    public function getCreatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y H:i:s');
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeOfMaterial::class, 'type_id');
    }

    /**
     * @return BelongsToMany
     */
    public function catalogProducts(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductCatalog::class,
            'product_catalog_materials'
        )
            ->withPivot('user_id')
            ->withTimestamps();
    }

    /**
     * @param Builder $query
     * @param int     $nds
     *
     * @return Builder
     */
    public function scopeNds($query, int $nds = 0): Builder
    {
        if ($nds > 0) {
            return $query->where('nds', $nds);
        }

        return $query;
    }
}
