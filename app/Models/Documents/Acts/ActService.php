<?php

namespace App\Models\Documents\Acts;

use App\Models\Auth\User;
use App\Models\Classifier\Nomenclature\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Documents\Acts\ActService
 *
 * @property int $id
 * @property int|null $userId Пользователь
 * @property int $actId Акт
 * @property int $serviceId Работа, услуга
 * @property int $quantity Кол-во
 * @property float $price Цена
 * @property float $nds НДС
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Documents\Acts\Act $act
 * @property-read Service $service
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ActService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActService onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActService query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereActId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereNds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActService withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActService withoutTrashed()
 * @mixin \Eloquent
 */
class ActService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'documents_acts_services';

    protected $fillable = [
        'user_id',
        'act_id',
        'service_id',
        'quantity',
        'price',
        'nds',
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
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function act()
    {
        return $this->belongsTo(Act::class, 'act_id');
    }
}
