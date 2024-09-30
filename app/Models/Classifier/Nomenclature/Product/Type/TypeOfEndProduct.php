<?php

namespace App\Models\Classifier\Nomenclature\Product\Type;

use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель типа готовой продукции.
 */
class TypeOfEndProduct extends Model
{
    use HasFactory;
    use RelationshipsTrait;

    protected $table = 'classifier_types_of_end_products';

    protected $fillable = [
        'name',
        'color',
    ];

    protected $guarded = [
        'id',
    ];

    public $timestamps = false;
}
