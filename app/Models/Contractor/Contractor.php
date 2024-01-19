<?php

namespace App\Models\Contractor;

use App\Models\Contractor\Transport\Car;
use App\Models\Contractor\Transport\Driver;
use App\Models\Contractor\Transport\Trailer;
use App\Traits\Classifier\HasLegalForm;
use App\Traits\Contractor\HasBankAccountDetails;
use App\Traits\Contractor\HasContactPersons;
use App\Traits\Contractor\HasPlacesOfBusiness;
use App\Traits\Document\HasInvoicesAndPackingLists;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\Notification\Email\EmailToVerificationContractorsUsers;
use App\Traits\User\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель контрагента
 */
class Contractor extends Model
{
    use EmailToVerificationContractorsUsers;
    use HasBankAccountDetails;
    use HasContactPersons;
    use HasFactory;
    use HasInvoicesAndPackingLists;
    use HasLegalForm;
    use HasPlacesOfBusiness;
    use HasUser;
    use RelationshipsTrait;
    use SoftDeletes;

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
