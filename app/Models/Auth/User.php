<?php

namespace App\Models\Auth;

use App\Models\Admin\Organizations\BankAccountDetail;
use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\PlaceOfBusiness as OrganizationPlaceOfBusiness;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Models\Classifiers\Nomenclature\Products\ProductPrice;
use App\Models\Contractors\ContactPerson;
use App\Models\Contractors\Contractor;
use App\Models\Contractors\PlaceOfBusiness;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use App\Traits\Auth\Documents\HasDocuments;
use App\Traits\Auth\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\Auth\User
 *
 * @property int    $id
 * @property string $name
 * @property string                                                     $email
 * @property Carbon|null                                                $emailVerifiedAt
 * @property string                                                     $password
 * @property string|null                                                $rememberToken
 * @property Carbon|null                                                $createdAt
 * @property Carbon|null                                                $updatedAt
 * @property Carbon|null                                                $deletedAt
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null                                              $notificationsCount
 * @property-read Collection|Permission[]                               $permissions
 * @property-read int|null                                              $permissionsCount
 * @property-read Collection|Role[]                                     $roles
 * @property-read int|null                                              $rolesCount
 * @property-read Collection|PersonalAccessToken[]                      $tokens
 * @property-read int|null                                              $tokensCount
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User withTrashed()
 * @method static Builder|User withoutTrashed()
 * @mixin Builder
 * @property-read Collection<int, BankAccountDetail> $bankAccountDetails
 * @property-read int|null $bankAccountDetailsCount
 * @property-read Collection<int, ProductCatalog> $catalogProducts
 * @property-read int|null $catalogProductsCount
 * @property-read Collection<int, ContactPerson> $contactPersons
 * @property-read int|null $contactPersonsCount
 * @property-read Collection<int, Contractor> $contractors
 * @property-read int|null $contractorsCount
 * @property-read Collection<int, \App\Models\Contractors\BankAccountDetail> $contractorsBankAccountDetails
 * @property-read int|null $contractorsBankAccountDetailsCount
 * @property-read Collection<int, PlaceOfBusiness> $contractorsPlacesOfBusiness
 * @property-read int|null $contractorsPlacesOfBusinessCount
 * @property-read Collection<int, EndProduct> $endProducts
 * @property-read int|null $endProductsCount
 * @property-read Collection<int, Organization> $organizations
 * @property-read int|null $organizationsCount
 * @property-read Collection<int, OrganizationPlaceOfBusiness> $organizationsPlacesOfBusiness
 * @property-read int|null $organizationsPlacesOfBusinessCount
 * @property-read Collection<int, ProductPrice> $productPrices
 * @property-read int|null $productPricesCount
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, HasDocuments, SoftDeletes;

    protected $dates = ['email_verified_at',];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organizations()
    {
        return $this->hasMany(Organization::class)
            ->withTrashed();
    }

    public function organizationsPlacesOfBusiness()
    {
        return $this->hasMany(OrganizationPlaceOfBusiness::class)
            ->withTrashed();
    }

    public function bankAccountDetails()
    {
        return $this->hasMany(BankAccountDetail::class)
            ->withTrashed();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)->format('d.m.Y');
    }

    public function contractors()
    {
        return $this->hasMany(Contractor::class)
            ->withTrashed();
    }

    public function contractorsPlacesOfBusiness()
    {
        return $this->hasMany(PlaceOfBusiness::class)
            ->withTrashed();
    }

    public function contractorsBankAccountDetails()
    {
        return $this->hasMany(\App\Models\Contractors\BankAccountDetail::class)
            ->withTrashed();
    }

    public function contactPersons()
    {
        return $this->hasMany(ContactPerson::class)
            ->withTrashed();
    }

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'user_id')
            ->withTrashed();
    }

    public function catalogProducts()
    {
        return $this->hasMany(ProductCatalog::class, 'user_id')
            ->withTrashed();
    }

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class, 'user_id')
            ->withTrashed();
    }
}
