<?php

namespace App\Models\Auth;

use App\Models\Contractors\BankAccountDetail;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use App\Traits\Auth\Documents\HasDocuments;
use App\Traits\Auth\HasContractors;
use App\Traits\Auth\HasNomenclature;
use App\Traits\Auth\HasOrganizations;
use App\Traits\Auth\HasRolesAndPermissions;
use Eloquent;
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
 * @property int                                                             $id
 * @property string                                                          $name
 * @property string                                                          $email
 * @property Carbon|null                                                     $emailVerifiedAt
 * @property string                                                          $password
 * @property string|null                                                     $rememberToken
 * @property Carbon|null                                                     $createdAt
 * @property Carbon|null                                                     $updatedAt
 * @property Carbon|null                                                     $deletedAt
 * @property-read DatabaseNotificationCollection|DatabaseNotification[]      $notifications
 * @property-read int|null                                                   $notificationsCount
 * @property-read Collection|Permission[]                                    $permissions
 * @property-read int|null                                                   $permissionsCount
 * @property-read Collection|Role[]                                          $roles
 * @property-read int|null                                                   $rolesCount
 * @property-read Collection|PersonalAccessToken[]                           $tokens
 * @property-read int|null                                                   $tokensCount
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
 * @property-read Collection<int, BankAccountDetail>                         $bankAccountDetails
 * @property-read int|null                                                   $bankAccountDetailsCount
 * @property-read Collection<int, ProductCatalog>                            $catalogProducts
 * @property-read int|null                                                   $catalogProductsCount
 * @property-read Collection<int, ContactPerson>                             $contactPersons
 * @property-read int|null                                                   $contactPersonsCount
 * @property-read Collection<int, Contractor>                                $contractors
 * @property-read int|null                                                   $contractorsCount
 * @property-read Collection<int, BankAccountDetail> $contractorsBankAccountDetails
 * @property-read int|null                                                   $contractorsBankAccountDetailsCount
 * @property-read Collection<int, PlaceOfBusiness>                           $contractorsPlacesOfBusiness
 * @property-read int|null                                                   $contractorsPlacesOfBusinessCount
 * @property-read Collection<int, EndProduct>                                $endProducts
 * @property-read int|null                                                   $endProductsCount
 * @property-read Collection<int, Organization>                              $organizations
 * @property-read int|null                                                   $organizationsCount
 * @property-read Collection<int, OrganizationPlaceOfBusiness>               $organizationsPlacesOfBusiness
 * @property-read int|null                                                   $organizationsPlacesOfBusinessCount
 * @property-read Collection<int, ProductPrice>                              $productPrices
 * @property-read int|null                                                   $productPricesCount
 * @property-read Collection<int, \App\Models\Documents\Acts\ActService> $actServices
 * @property-read int|null $actServicesCount
 * @property-read Collection<int, \App\Models\Documents\Acts\Act> $acts
 * @property-read int|null $actsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Appendixes\Appendix> $approvedAppendixes
 * @property-read int|null $approvedAppendixesCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Bills\Bill> $approvedBills
 * @property-read int|null $approvedBillsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\PackingLists\PackingList> $approvedPackingLists
 * @property-read int|null $approvedPackingListsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Protocols\Protocol> $approvedProtocols
 * @property-read int|null $approvedProtocolsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Waybills\Waybill> $approvedWaybills
 * @property-read int|null $approvedWaybillsCount
 * @property-read Collection<int, \App\Models\Admin\Organizations\BankAccountDetail> $bankAccountDetails
 * @property-read Collection<int, \App\Models\Classifiers\Nomenclature\Products\ProductCatalog> $catalogProducts
 * @property-read Collection<int, \App\Models\Contractors\ContactPerson> $contactPersons
 * @property-read Collection<int, \App\Models\Contractors\Contractor> $contractors
 * @property-read Collection<int, BankAccountDetail> $contractorsBankAccountDetails
 * @property-read Collection<int, \App\Models\Contractors\PlaceOfBusiness> $contractorsPlacesOfBusiness
 * @property-read Collection<int, \App\Models\Documents\Shipment\Appendixes\Appendix> $createdAppendixes
 * @property-read int|null $createdAppendixesCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Bills\Bill> $createdBills
 * @property-read int|null $createdBillsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\PackingLists\PackingList> $createdPackingLists
 * @property-read int|null $createdPackingListsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Protocols\Protocol> $createdProtocols
 * @property-read int|null $createdProtocolsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Waybills\Waybill> $createdWaybills
 * @property-read int|null $createdWaybillsCount
 * @property-read Collection<int, \App\Models\Classifiers\Nomenclature\Products\EndProduct> $endProducts
 * @property-read Collection<int, \App\Models\Documents\InvoicesForPayment\InvoiceForPaymentMaterial> $invoiceForPaymentMaterials
 * @property-read int|null $invoiceForPaymentMaterialsCount
 * @property-read Collection<int, \App\Models\Documents\InvoicesForPayment\InvoiceForPayment> $invoicesForPayment
 * @property-read int|null $invoicesForPaymentCount
 * @property-read Collection<int, \App\Models\Admin\Organizations\Organization> $organizations
 * @property-read Collection<int, \App\Models\Admin\Organizations\PlaceOfBusiness> $organizationsPlacesOfBusiness
 * @property-read Collection<int, \App\Models\Classifiers\Nomenclature\Products\ProductPrice> $productPrices
 * @property-read Collection<int, \App\Models\Classifiers\Nomenclature\Services\Service> $services
 * @property-read int|null $servicesCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Appendixes\Appendix> $updatedAppendixes
 * @property-read int|null $updatedAppendixesCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Bills\Bill> $updatedBills
 * @property-read int|null $updatedBillsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\PackingLists\PackingList> $updatedPackingLists
 * @property-read int|null $updatedPackingListsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Protocols\Protocol> $updatedProtocols
 * @property-read int|null $updatedProtocolsCount
 * @property-read Collection<int, \App\Models\Documents\Shipment\Waybills\Waybill> $updatedWaybills
 * @property-read int|null $updatedWaybillsCount
 * @mixin Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRolesAndPermissions;
    use HasDocuments;
    use SoftDeletes;
    use HasNomenclature;
    use HasOrganizations;
    use HasContractors;

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
}
