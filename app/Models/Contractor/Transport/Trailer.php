<?php

namespace App\Models\Contractor\Transport;

use App\Traits\Contractor\HasContractor;
use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Прицепы контрагента.
 */
class Trailer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasContractor;
    use RelationshipsTrait;

    protected $table = 'contractors_trailers';

    protected $fillable = [
        'user_id',
        'contractor_id',
        'type',
        'state_number',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
