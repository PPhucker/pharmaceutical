<?php

namespace App\Models\Admin\Organizations;

use App\Models\Auth\User;
use App\Models\Classifiers\LegalForm;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Models\Classifiers\Nomenclature\Products\ProductPrice;
use App\Models\Contractor\Contract;
use App\Models\Documents\Acts\Act;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Traits\Organizations\Documents\HasDocuments;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * App\Models\Admin\Organizations\Organization
 *
 * @property int                                                                              $id
 * @property int|null                                                                         $userId
 * @property string|null                                                                      $legalFormType
 * @property string                                                                           $name
 * @property string                                                                           $INN
 * @property string                                                                           $OKPO
 * @property string|null                                                                      $contacts
 * @property Carbon|null                                                                      $createdAt
 * @property Carbon|null                                                                      $updatedAt
 * @property Carbon|null                                                                      $deletedAt
 * @property-read Collection<int, BankAccountDetail>                                          $bankAccountDetails
 * @property-read int|null                                                                    $bankAccountDetailsCount
 * @property-read Collection<int, ProductCatalog>                                             $catalogProducts
 * @property-read int|null                                                                    $catalogProductsCount
 * @property-read LegalForm|null                                                              $legalForm
 * @property-read Collection<int, PlaceOfBusiness>                                            $placesOfBusiness
 * @property-read int|null                                                                    $placesOfBusinessCount
 * @property-read Collection<int, ProductPrice>                                               $productPrices
 * @property-read int|null                                                                    $productPricesCount
 * @property-read Collection<int, Staff>                                                      $staff
 * @property-read int|null                                                                    $staffCount
 * @property-read User|null                                                                   $user
 * @method static Builder|Organization newModelQuery()
 * @method static Builder|Organization newQuery()
 * @method static Builder|Organization onlyTrashed()
 * @method static Builder|Organization query()
 * @method static Builder|Organization whereContacts($value)
 * @method static Builder|Organization whereCreatedAt($value)
 * @method static Builder|Organization whereDeletedAt($value)
 * @method static Builder|Organization whereINN($value)
 * @method static Builder|Organization whereId($value)
 * @method static Builder|Organization whereLegalFormType($value)
 * @method static Builder|Organization whereName($value)
 * @method static Builder|Organization whereOKPO($value)
 * @method static Builder|Organization whereUpdatedAt($value)
 * @method static Builder|Organization whereUserId($value)
 * @method static Builder|Organization withTrashed()
 * @method static Builder|Organization withoutTrashed()
 * @property string|null                                          $kpp КПП
 * @property-read Collection<int, Act> $acts
 * @property-read int|null                                        $actsCount
 * @property-read Collection<int, BankAccountDetail>              $bankAccountDetails
 * @property-read Collection<int, Car>                            $cars
 * @property-read int|null                                        $carsCount
 * @property-read Collection<int, ProductCatalog>                 $catalogProducts
 * @property-read Collection<int, Driver>                         $drivers
 * @property-read int|null                                        $driversCount
 * @property-read Collection<int, InvoiceForPayment>              $invoicesForPayment
 * @property-read int|null                                        $invoicesForPaymentCount
 * @property-read Collection<int, PlaceOfBusiness>                $placesOfBusiness
 * @property-read Collection<int, ProductPrice>                   $productPrices
 * @property-read Collection<int, Staff>                          $staff
 * @property-read Collection<int, Trailer>                                           $trailers
 * @property-read int|null                                                           $trailersCount
 * @method static Builder|Organization whereKpp($value)
 * @mixin Eloquent
 */
class Organization extends Model
{
    use HasDocuments;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'organizations';

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

    protected $appends = [
        'full_name'
    ];


    public function getFullNameAttribute(): string
    {
        return "{$this->legal_form_type} {$this->name}";
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    /**
     * @return BelongsTo
     */
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

    public function staff()
    {
        return $this->hasMany(Staff::class)
            ->withTrashed();
    }

    public function catalogProducts()
    {
        return $this->hasMany(ProductCatalog::class, 'organization_id')
            ->withTrashed();
    }

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class, 'organization_id');
    }

    /**
     * @return HasMany
     */
    public function drivers()
    {
        return $this->hasMany(Driver::class, 'organization_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'organization_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function trailers()
    {
        return $this->hasMany(Trailer::class, 'organization_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'organization_id')
            ->withTrashed();
    }
}
