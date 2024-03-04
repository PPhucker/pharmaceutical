<?php

namespace App\Models\Classifier\Nomenclature\Product;

use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель международного непатентованного названия готовой продукции.
 */
class InternationalNameOfEndProduct extends Model
{
    use HasFactory;
    use RelationshipsTrait;

    protected $table = 'classifier_international_names_of_end_products';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'id'
    ];
}
