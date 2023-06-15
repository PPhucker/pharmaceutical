<?php

namespace App\Models\Contractors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Contractors\Car
 *
 * @property int $id
 * @property int|null $userId Пользователь
 * @property int $contractorId ID Контрагента
 * @property string $carModel Марка
 * @property string $stateNumber Гос. номер
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Contractors\Contractor $contractor
 * @method static \Illuminate\Database\Eloquent\Builder|Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Car query()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCarModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereContractorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereId($value)
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

    protected $table = 'contractors_cars';

    protected $fillable = [
        'user_id',
        'contractor_id',
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
    public function contractor()
    {
        return $this->belongsTo(Contractor::class, 'contractor_id');
    }
}
