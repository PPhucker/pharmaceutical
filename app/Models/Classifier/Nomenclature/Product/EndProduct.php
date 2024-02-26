<?php

namespace App\Models\Classifier\Nomenclature\Product;

use App\Traits\Classifier\Nomenclature\Relation\HasOkeiClassifier;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель конечного продукта.
 */
class EndProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUser;
    use HasOkeiClassifier;
    use RelationshipsTrait;

    protected $table = 'classifier_end_products';

    protected $foreign_key = 'product_id';

    protected $fillable = [
        'user_id',
        'type_id',
        'international_name_id',
        'registration_number_id',
        'okei_code',
        'okpd2_code',
        'short_name',
        'full_name',
        'marking',
        'best_before_date',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date): string
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i:s');
    }

    /**
     * @return HasMany
     */
    public function catalogProducts(): HasMany
    {
        return $this->hasMany(ProductCatalog::class, $this->foreign_key);
    }

    /**
     * @return BelongsTo
     */
    public function okpd2(): BelongsTo
    {
        return $this->belongsTo(OKPD2::class, 'okpd2_code');
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeOfEndProduct::class, 'type_id');
    }

    /**
     * @return BelongsTo
     */
    public function internationalName(): BelongsTo
    {
        return $this->belongsTo(InternationalNameOfEndProduct::class, 'international_name_id');
    }

    /**
     * @return BelongsTo
     */
    public function registrationNumber(): BelongsTo
    {
        return $this->belongsTo(RegistrationNumberOfEndProduct::class, 'registration_number_id');
    }
}
