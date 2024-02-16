<?php

namespace App\Models\Classifier\Nomenclature;

use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель классификатора ОКЕИ.
 */
class OKEI extends Model
{
    use HasFactory;
    use RelationshipsTrait;

    protected $table = 'classifier_okei';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'unit',
        'symbol',
    ];

    public $timestamps = false;
}
