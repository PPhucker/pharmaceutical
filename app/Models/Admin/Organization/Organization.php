<?php

namespace App\Models\Admin\Organization;

use App\Models\Admin\Organization\Transport\Car;
use App\Models\Admin\Organization\Transport\Driver;
use App\Models\Admin\Organization\Transport\Trailer;
use App\Models\Contractor\Contract;
use App\Traits\Classifier\Relation\HasLegalForm;
use App\Traits\Document\Relation\HasInvoicesAndPackingLists;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель организации.
 */
class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RelationshipsTrait;
    use HasInvoicesAndPackingLists;
    use HasUser;
    use HasLegalForm;

    protected $table = 'organizations';

    protected $foreign_key = 'organization_id';

    protected $fillable = [
        'user_id',
        'legal_form_type',
        'name',
        'INN',
        'OKPO',
        'kpp',
        'contacts',
    ];

    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'full_name',
    ];


    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->legal_form_type} {$this->name}";
    }

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
     * @return HasMany
     */
    public function placesOfBusiness(): HasMany
    {
        return $this->hasMany(PlaceOfBusiness::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function bankAccountDetails(): HasMany
    {
        return $this->hasMany(BankAccountDetail::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class, $this->foreign_key)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, $this->foreign_key)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function trailers(): HasMany
    {
        return $this->hasMany(Trailer::class, $this->foreign_key)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, $this->foreign_key)
            ->withTrashed();
    }
}
