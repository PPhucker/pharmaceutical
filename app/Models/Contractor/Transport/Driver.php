<?php

namespace App\Models\Contractor\Transport;

use App\Traits\Contractor\Relation\HasContractor;
use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Водитель контрагента.
 */
class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasContractor;
    use RelationshipsTrait;

    protected $table = 'contractors_drivers';

    protected $fillable = [
        'user_id',
        'contractor_id',
        'name',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
