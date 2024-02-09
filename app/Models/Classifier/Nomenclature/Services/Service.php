<?php

namespace App\Models\Classifier\Nomenclature\Services;

use App\Models\Auth\User;
use App\Models\Classifier\Nomenclature\OKEI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Classifiers\Nomenclature\Services\Service
 *
 * @property int $id
 * @property int|null $userId Пользователь
 * @property string $name Название
 * @property string|null $okeiCode Код ОКЕИ
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read OKEI|null $okei
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereOkeiCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service withoutTrashed()
 * @mixin \Eloquent
 */
class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'classifier_services';

    protected $fillable = [
        'user_id',
        'name',
        'okei_code',
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
     * @return BelongsTo
     */
    public function okei()
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }
}
