<?php

namespace App\Models\Admin\Organization;

use App\Traits\Model\RelationshipsTrait;
use App\Traits\Organization\HasOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель сотрудников организации.
 */
class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasOrganization;
    use RelationshipsTrait;

    protected $table = 'organizations_staff';

    protected $fillable = [
        'organization_id',
        'organization_place_of_business_id',
        'name',
        'post'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    /**
     * @return BelongsTo
     */
    public function placeOfBusiness(): BelongsTo
    {
        return $this->belongsTo(PlaceOfBusiness::class, 'organization_place_of_business_id');
    }
}
