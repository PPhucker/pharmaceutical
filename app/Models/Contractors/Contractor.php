<?php

namespace App\Models\Contractors;

use App\Models\Classifiers\LegalForm;
use App\Models\Contractors\Transport\Car;
use App\Models\Contractors\Transport\Driver;
use App\Models\Contractors\Transport\Trailer;
use App\Traits\Contractors\Notifications;
use App\Traits\Document\HasInvoicesAndPackingLists;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Контрагент
 */
class Contractor extends Model
{
    use RelationshipsTrait;
    use HasInvoicesAndPackingLists;
    use HasFactory;
    use Notifications;
    use SoftDeletes;
    use HasUser;

    protected $table = 'contractors';

    protected $foreign_key = 'contractor_id';

    protected $fillable = [
        'user_id',
        'legal_form_type',
        'name',
        'INN',
        'OKPO',
        'kpp',
        'contacts',
        'comment',
    ];

    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [
        'full_name'
    ];

    /**
     * Получить дату создания в формате d.m.Y H:i:s.
     *
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y H:i:s');
    }

    /**
     * Возвращает имя контрагента вместе с организационно-правовой формой.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->legal_form_type} {$this->name}";
    }

    /**
     * @return BelongsTo
     */
    public function legalForm(): BelongsTo
    {
        return $this->belongsTo(LegalForm::class, 'legal_form_type');
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
    public function contactPersons(): HasMany
    {
        return $this->hasMany(ContactPerson::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class, 'contractor_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'contractor_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function trailers(): HasMany
    {
        return $this->hasMany(Trailer::class, 'contractor_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'contractor_id')
            ->withTrashed();
    }

    /**
     * @param int $organizationId
     *
     * @return bool
     */
    public function hasContract(int $organizationId): bool
    {
        foreach ($this->contracts as $contract) {
            if ($contract->is_valid && $contract->organization_id === $organizationId) {
                return true;
            }
        }

        return false;
    }
}
