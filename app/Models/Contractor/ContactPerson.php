<?php

namespace App\Models\Contractor;

use App\Traits\Contractor\HasContractor;
use App\Traits\Model\RelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Контактное лицо контрагента.
 */
class ContactPerson extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasContractor;
    use RelationshipsTrait;

    protected $table = 'contractors_contact_persons';

    protected $fillable = [
        'contractor_id',
        'name',
        'post',
        'phone',
        'email'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }
}
