<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель регионов РФ.
 */
class Region extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'classifier_regions';

    protected $fillable = [
        'name',
        'zone',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
    ];
}
