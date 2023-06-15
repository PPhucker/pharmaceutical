<?php

namespace App\Models\Documents\Acts;

use App\Models\Admin\Organizations\Organization;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Documents\Acts\Act
 *
 * @property int $id
 * @property int|null $userId Пользователь
 * @property string $number Номер
 * @property string $date Дата
 * @property int $organizationId Исполнитель
 * @property int $contractorId Заказчик
 * @property string|null $filename Прикрепленный файл
 * @property Carbon|null $deletedAt
 * @property Carbon|null $createdAt
 * @property string $updatedAt
 * @property-read Organization $contractor
 * @property-read Organization $organization
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Documents\Acts\ActService> $production
 * @property-read int|null $productionCount
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Act newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Act newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Act onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Act query()
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereContractorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Act withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Act withoutTrashed()
 * @mixin \Eloquent
 */
class Act extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STORAGE = 'public/documents/acts/';

    protected $table = 'documents_acts';

    protected $fillable = [
        'user_id',
        'number',
        'date',
        'organization_id',
        'contractor_id',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getDateAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y');
    }

    /**
     * @return BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    /**\
     * @return BelongsTo
     */
    public function contractor()
    {
        return $this->belongsTo(Organization::class, 'contractor_id');
    }

    /**
     * @return HasMany
     */
    public function production()
    {
        return $this->hasMany(ActService::class, 'act_id')
            ->withTrashed();
    }
}
