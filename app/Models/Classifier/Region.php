<?php

namespace App\Models\Classifier;

use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель регионов РФ.
 */
class Region extends Model
{
    use HasFactory;
    use RelationshipsTrait;

    protected $table = 'classifier_regions';

    protected $fillable = [
        'name',
        'zone',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
