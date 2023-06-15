<?php

namespace App\Models\Contractors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Contractors\Trailer
 *
 * @property int $id
 * @property int|null $userId Пользователь
 * @property int $contractorId ID Контрактор
 * @property string $type Тип прицепа
 * @property string $stateNumber Гос. номер
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Contractors\Contractor $contractor
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereContractorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trailer whereId($value)
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

    public function contractor()
    {
        return $this->belongsTo(Contractor::class, 'contractor_id');
    }
}
