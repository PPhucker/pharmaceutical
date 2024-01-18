<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use App\Traits\Classifier\Nomenclature\HasOkeiClassifier;
use App\Traits\Classifier\Nomenclature\HasOkpd2Classifier;
use App\Traits\Classifier\Nomenclature\Product\HasCatalogProducts;
use App\Traits\Classifier\Nomenclature\Product\HasInternationalName;
use App\Traits\Classifier\Nomenclature\Product\HasRegistrationNumber;
use App\Traits\Classifier\Nomenclature\Product\HasTypeOfEndProduct;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    use HasTypeOfEndProduct;
    use HasInternationalName;
    use HasRegistrationNumber;
    use HasOkeiClassifier;
    use HasOkpd2Classifier;
    use HasCatalogProducts;

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
}
