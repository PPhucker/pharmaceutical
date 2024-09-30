<?php

namespace App\Models\Classifier;

use App\Traits\Model\RelationshipsTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель классификатора банков.
 */
class Bank extends Model
{
    use HasFactory;
    use RelationshipsTrait;

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'classifier_banks';

    protected $keyType = 'string';

    protected $primaryKey = 'BIC';

    protected $fillable = [
        'BIC',
        'correspondent_account',
        'name',
    ];
}
