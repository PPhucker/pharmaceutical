<?php

// @formatter:off

/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Admin\Organizations {

    use App\Models\Auth\User;
    use App\Models\Classifiers\Bank;
    use Eloquent;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Admin\Organizations\BankAccountDetail
     *
     * @property int                                    $id
     * @property int                                    $organizationId
     * @property int|null                               $userId
     * @property string|null                            $bank
     * @property string                                 $paymentAccount
     * @property Carbon|null        $createdAt
     * @property Carbon|null        $updatedAt
     * @property Carbon|null        $deletedAt
     * @property-read Bank|null $bankClassifier
     * @property-read Organization                      $organization
     * @property-read User|null                         $user
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail newQuery()
     * @method static Builder|BankAccountDetail onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail query()
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail whereBank($value)
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail whereOrganizationId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail wherePaymentAccount($value)
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|BankAccountDetail whereUserId($value)
     * @method static Builder|BankAccountDetail withTrashed()
     * @method static Builder|BankAccountDetail withoutTrashed()
     */
    class BankAccountDetail extends Eloquent
    {
    }
}

namespace App\Models\Admin\Organizations {

    use App\Models\Auth\User;
    use App\Models\Classifiers\LegalForm;
    use Eloquent;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Admin\Organizations\Organization
     *
     * @property int                                                                                               $id
     * @property int|null
     *           $userId
     * @property string|null
     *           $legalFormType
     * @property string
     *           $name
     * @property string                                                                                            $INN
     * @property string
     *           $OKPO
     * @property string|null
     *           $contacts
     * @property Carbon|null
     *           $createdAt
     * @property Carbon|null
     *           $updatedAt
     * @property Carbon|null
     *           $deletedAt
     * @property-read Collection|BankAccountDetail[]
     *                $bankAccountDetails
     * @property-read int|null
     *                $bankAccountDetailsCount
     * @property-read LegalForm|null
     *                $legalForm
     * @property-read Collection|PlaceOfBusiness[]
     *                $placesOfBusiness
     * @property-read int|null
     *                $placesOfBusinessCount
     * @property-read Collection|Staff[]
     *                $staff
     * @property-read int|null
     *                $staffCount
     * @property-read User|null
     *                $user
     * @method static \Illuminate\Database\Eloquent\Builder|Organization newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Organization newQuery()
     * @method static Builder|Organization onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|Organization query()
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereContacts($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereINN($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereLegalFormType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereOKPO($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Organization whereUserId($value)
     * @method static Builder|Organization withTrashed()
     * @method static Builder|Organization withoutTrashed()
     */
    class Organization extends Eloquent
    {
    }
}

namespace App\Models\Admin\Organizations {

    use App\Models\Auth\User;
    use Eloquent;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Admin\Organizations\PlaceOfBusiness
     *
     * @property int                             $id
     * @property int|null                        $userId
     * @property int                             $organizationId
     * @property string|null                     $identifier
     * @property int                             $registered
     * @property string                          $index
     * @property string                          $address
     * @property Carbon|null $createdAt
     * @property Carbon|null $updatedAt
     * @property Carbon|null $deletedAt
     * @property-read Organization               $organization
     * @property-read Collection|Staff[]         $staff
     * @property-read int|null                   $staffCount
     * @property-read User|null                  $user
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness newQuery()
     * @method static Builder|PlaceOfBusiness onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness query()
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereAddress($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereIdentifier($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereIndex($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereOrganizationId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereRegistered($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfBusiness whereUserId($value)
     * @method static Builder|PlaceOfBusiness withTrashed()
     * @method static Builder|PlaceOfBusiness withoutTrashed()
     */
    class PlaceOfBusiness extends Eloquent
    {
    }
}

namespace App\Models\Admin\Organizations {

    use Eloquent;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Admin\Organizations\Staff
     *
     * @property int                             $id
     * @property int                             $organizationId
     * @property int                             $organizationPlaceOfBusinessId
     * @property string                          $name
     * @property string                          $post
     * @property Carbon|null $createdAt
     * @property Carbon|null $updatedAt
     * @property Carbon|null $deletedAt
     * @property-read Organization               $organization
     * @property-read PlaceOfBusiness            $placeOfBusiness
     * @method static \Illuminate\Database\Eloquent\Builder|Staff newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Staff newQuery()
     * @method static Builder|Staff onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|Staff query()
     * @method static \Illuminate\Database\Eloquent\Builder|Staff whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Staff whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Staff whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Staff whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOrganizationId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOrganizationPlaceOfBusinessId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Staff wherePost($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Staff whereUpdatedAt($value)
     * @method static Builder|Staff withTrashed()
     * @method static Builder|Staff withoutTrashed()
     */
    class Staff extends Eloquent
    {
    }
}

namespace App\Models\Auth {

    use Eloquent;

    /**
     * App\Models\Auth\Permission
     *
     * @property int            $id
     * @property string         $name
     * @property string         $slug
     * @property Carbon|null    $createdAt
     * @property Carbon|null    $updatedAt
     * @property Carbon|null    $deletedAt
     * @property-read Role|null $roles
     * @method static Builder|Permission newModelQuery()
     * @method static Builder|Permission newQuery()
     * @method static Builder|Permission onlyTrashed()
     * @method static Builder|Permission query()
     * @method static Builder|Permission whereCreatedAt($value)
     * @method static Builder|Permission whereDeletedAt($value)
     * @method static Builder|Permission whereId($value)
     * @method static Builder|Permission whereName($value)
     * @method static Builder|Permission whereSlug($value)
     * @method static Builder|Permission whereUpdatedAt($value)
     * @method static Builder|Permission withTrashed()
     * @method static Builder|Permission withoutTrashed()
     * @mixin Builder
     */
    class Permission extends Eloquent
    {
    }
}

namespace App\Models\Auth {

    use Eloquent;

    /**
     * App\Models\Auth\Role
     *
     * @property int                    $id
     * @property string                 $name
     * @property string                 $slug
     * @property Carbon|null            $createdAt
     * @property Carbon|null            $updatedAt
     * @property Carbon|null            $deletedAt
     * @property-read Permission|null   $permissions
     * @property-read Collection|User[] $users
     * @property-read int|null          $usersCount
     * @method static Builder|Role newModelQuery()
     * @method static Builder|Role newQuery()
     * @method static Builder|Role onlyTrashed()
     * @method static Builder|Role query()
     * @method static Builder|Role whereCreatedAt($value)
     * @method static Builder|Role whereDeletedAt($value)
     * @method static Builder|Role whereId($value)
     * @method static Builder|Role whereName($value)
     * @method static Builder|Role whereSlug($value)
     * @method static Builder|Role whereUpdatedAt($value)
     * @method static Builder|Role withTrashed()
     * @method static Builder|Role withoutTrashed()
     * @mixin Builder
     */
    class Role extends Eloquent
    {
    }
}

namespace App\Models\Auth {

    use App\Models\Admin\Organizations\BankAccountDetail;
    use App\Models\Admin\Organizations\Organization;
    use App\Models\Admin\Organizations\PlaceOfBusiness;
    use Eloquent;
    use Illuminate\Database\Eloquent\Collection;

    /**
     * App\Models\Auth\User
     *
     * @property int                                                                                               $id
     * @property string
     *           $name
     * @property string
     *           $email
     * @property Carbon|null
     *           $emailVerifiedAt
     * @property string
     *           $password
     * @property string|null
     *           $rememberToken
     * @property Carbon|null
     *           $createdAt
     * @property Carbon|null
     *           $updatedAt
     * @property Carbon|null
     *           $deletedAt
     * @property-read DatabaseNotificationCollection|DatabaseNotification[]
     *                $notifications
     * @property-read int|null
     *                $notificationsCount
     * @property-read Collection|Permission[]
     *                $permissions
     * @property-read int|null
     *                $permissionsCount
     * @property-read Collection|Role[]
     *                $roles
     * @property-read int|null
     *                $rolesCount
     * @property-read Collection|PersonalAccessToken[]
     *                $tokens
     * @property-read int|null
     *                $tokensCount
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
     * @property-read Collection|BankAccountDetail[]
     *                $bankAccountDetails
     * @property-read int|null
     *                $bankAccountDetailsCount
     * @property-read Collection|Organization[]
     *                $organizations
     * @property-read int|null
     *                $organizationsCount
     * @property-read Collection|PlaceOfBusiness[]
     *                $organizationsPlacesOfBusiness
     * @property-read int|null
     *                $organizationsPlacesOfBusinessCount
     */
    class User extends Eloquent
    {
    }
}

namespace App\Models\Classifiers {

    use App\Models\Admin\Organizations\BankAccountDetail;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;

    /**
     * App\Models\Classifiers\Bank
     *
     * @property string                                                                                            $BIC
     * @property string
     *           $correspondentAccount
     * @property string
     *           $name
     * @property-read Collection|BankAccountDetail[]
     *                $bankAccountDetails
     * @property-read int|null
     *                $bankAccountDetailsCount
     * @method static Builder|Bank newModelQuery()
     * @method static Builder|Bank newQuery()
     * @method static Builder|Bank query()
     * @method static Builder|Bank whereBIC($value)
     * @method static Builder|Bank whereCorrespondentAccount($value)
     * @method static Builder|Bank whereName($value)
     */
    class Bank extends Eloquent
    {
    }
}

namespace App\Models\Classifiers {

    use App\Models\Admin\Organizations\Organization;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;

    /**
     * App\Models\Classifiers\LegalForm
     *
     * @property string
     *           $abbreviation
     * @property string|null                                                                                  $decoding
     * @property-read Collection|Organization[]
     *                $organizations
     * @property-read int|null
     *                $organizationsCount
     * @method static Builder|LegalForm newModelQuery()
     * @method static Builder|LegalForm newQuery()
     * @method static Builder|LegalForm query()
     * @method static Builder|LegalForm whereAbbreviation($value)
     * @method static Builder|LegalForm whereDecoding($value)
     */
    class LegalForm extends Eloquent
    {
    }
}

