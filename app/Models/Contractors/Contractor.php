<?php

namespace App\Models\Contractors;

use App\Models\Auth\User;
use App\Models\Classifiers\LegalForm;
use App\Traits\Contractors\Documents\HasDocuments;
use App\Traits\Contractors\Notifications;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Contractors\Contractor
 *
 * @property int                                     $id
 * @property int|null                                $userId
 * @property string|null                             $legalFormType
 * @property string                                  $name
 * @property string                                  $INN
 * @property string                                  $OKPO
 * @property string|null                             $contacts
 * @property Carbon|null                             $createdAt
 * @property Carbon|null                             $updatedAt
 * @property Carbon|null                             $deletedAt
 * @property-read Collection<int, BankAccountDetail> $bankAccountDetails
 * @property-read int|null                           $bankAccountDetailsCount
 * @property-read Collection<int, ContactPerson>     $contactPersons
 * @property-read int|null                           $contactPersonsCount
 * @property-read LegalForm|null                     $legalForm
 * @property-read Collection<int, PlaceOfBusiness>   $placesOfBusiness
 * @property-read int|null                           $placesOfBusinessCount
 * @property-read User|null                          $user
 * @method static Builder|Contractor newModelQuery()
 * @method static Builder|Contractor newQuery()
 * @method static Builder|Contractor onlyTrashed()
 * @method static Builder|Contractor query()
 * @method static Builder|Contractor whereContacts($value)
 * @method static Builder|Contractor whereCreatedAt($value)
 * @method static Builder|Contractor whereDeletedAt($value)
 * @method static Builder|Contractor whereINN($value)
 * @method static Builder|Contractor whereId($value)
 * @method static Builder|Contractor whereLegalFormType($value)
 * @method static Builder|Contractor whereName($value)
 * @method static Builder|Contractor whereOKPO($value)
 * @method static Builder|Contractor whereUpdatedAt($value)
 * @method static Builder|Contractor whereUserId($value)
 * @method static Builder|Contractor withTrashed()
 * @method static Builder|Contractor withoutTrashed()
 * @mixin Eloquent
 */
class Contractor extends Model
{
    use HasFactory, HasDocuments, SoftDeletes, Notifications;

    protected $table = 'contractors';

    protected $fillable = [
        'user_id',
        'legal_form_type',
        'name',
        'INN',
        'OKPO',
        'kpp',
        'contacts'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }

    public function legalForm()
    {
        return $this->belongsTo(LegalForm::class, 'legal_form_type');
    }

    public function placesOfBusiness()
    {
        return $this->hasMany(PlaceOfBusiness::class)
            ->withTrashed();
    }

    public function bankAccountDetails()
    {
        return $this->hasMany(BankAccountDetail::class)
            ->withTrashed();
    }

    public function contactPersons()
    {
        return $this->hasMany(ContactPerson::class)
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function drivers()
    {
        return $this->hasMany(Driver::class, 'contractor_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'contractor_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function trailers()
    {
        return $this->hasMany(Trailer::class, 'contractor_id')
            ->withTrashed();
    }
}
