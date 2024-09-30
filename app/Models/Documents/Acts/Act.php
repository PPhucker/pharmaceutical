<?php

namespace App\Models\Documents\Acts;

use App\Models\Admin\Organization\Organization;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель акта.
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date): string
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getDateAttribute($date): string
    {
        return Carbon::parse($date)
            ->format('d.m.Y');
    }

    /**
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    /**\
     * @return BelongsTo
     */
    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'contractor_id');
    }

    /**
     * @return HasMany
     */
    public function production(): HasMany
    {
        return $this->hasMany(ActService::class, 'act_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function data(): HasMany
    {
        return $this->hasMany(ActService::class, 'act_id')
            ->withTrashed();
    }
}
