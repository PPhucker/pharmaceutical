<?php

namespace App\Models\Contractors;

use App\Models\Auth\User;
use App\Traits\Contractors\PlacesOfBusiness\Documents\HasDocuments;
use App\Traits\Contractors\PlacesOfBusiness\Notifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель места осуществления деятельности контрагента.
 */
class PlaceOfBusiness extends Model
{
    use HasDocuments;
    use HasFactory;
    use SoftDeletes;
    use Notifications;

    protected $table = 'contractors_places_of_business';

    protected $fillable = [
        'user_id',
        'contractor_id',
        'identifier',
        'registered',
        'index',
        'address',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Дата создания в формате d.m.Y.
     *
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class)
            ->withTrashed();
    }
}
