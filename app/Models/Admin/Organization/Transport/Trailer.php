<?php

namespace App\Models\Admin\Organization\Transport;

use App\Models\Admin\Organization\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Admin\Organizations\Trailer
 *
 * @property int                                              $id
 * @property int|null                                         $userId Пользователь
 * @property int                                              $organizationId ID Организации
 * @property string                                           $type Тип прицепа
 * @property string                                           $stateNumber Гос. номер
 * @property \Illuminate\Support\Carbon|null                  $deletedAt
 * @property \Illuminate\Support\Carbon|null                  $createdAt
 * @property \Illuminate\Support\Carbon|null                  $updatedAt
 * @property-read \App\Models\Admin\Organization\Organization $organization
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereStateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer withoutTrashed()
 * @mixin \Eloquent
 */
class Trailer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'organizations_trailers';

    protected $fillable = [
        'user_id',
        'organization_id',
        'type',
        'state_number',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
