<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель регионов РФ.
 */
class Region extends Model
{
    use HasFactory;

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
