<?php

namespace App\Models\Admin\Organizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Admin\Organizations\Car
 *
 * @property int $id
 * @property int|null $userId Пользователь
 * @property int $organizationId ID Организации
 * @property string $carModel Марка
 * @property string $stateNumber Гос. номер
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Admin\Organizations\Organization $organization
 * @method static \Illuminate\Database\Eloquent\Builder|Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Car query()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCarModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereStateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Car withoutTrashed()
 * @mixin \Eloquent
 */
class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'organizations_cars';

    protected $fillable = [
        'user_id',
        'organization_id',
        'car_model',
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
