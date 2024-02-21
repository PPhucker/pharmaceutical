<?php

namespace App\Models\Classifier\Nomenclature;

use App\Traits\Classifier\Nomenclature\Relation\HasOkeiClassifier;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель услуги.
 */
class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RelationshipsTrait;
    use HasUser;
    use HasOkeiClassifier;

    protected $table = 'classifier_services';

    protected $fillable = [
        'user_id',
        'name',
        'okei_code',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
