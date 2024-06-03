<?php

namespace App\Models\Classifier\Nomenclature\Product;

use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель регистрационного номера конечной продукции.
 */
class RegistrationNumberOfEndProduct extends Model
{
    use HasFactory;
    use RelationshipsTrait;

    public $timestamps = false;
    protected $table = 'classifier_registration_numbers_of_end_products';
    protected $fillable = [
        'number',
    ];
    protected $guarded = [
        'id',
    ];

    /**
     * @return string
     */
    public function getNumAttribute(): string
    {
        return $this->number ?: __(
            'classifiers.nomenclature.products.registration_numbers.without_registration_number'
        );
    }
}
