<?php

namespace App\Models\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\Notifications;
use App\Traits\Documents\Shipment\PackingLists\HasContractor;
use App\Traits\Documents\Shipment\PackingLists\HasOrganization;
use App\Traits\Documents\Shipment\PackingLists\HasShipmentDocuments;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Documents\Shipment\PackingLists\PackingList
 *
 * @property int $id
 * @property int|null $createdById Пользователь, создавший документ
 * @property int|null $updatedById Пользователь, изменивший документ
 * @property int|null $approvedById Пользователь, согласовавший документ
 * @property int $organizationId ID Организации
 * @property int $organizationPlaceId ID Адреса Отгрузки
 * @property int|null $organizationBankId ID Банковских реквизитов организации
 * @property int $contractorId ID Контрагента
 * @property int $contractorPlaceId ID Адреса Доставки
 * @property int|null $contractorBankId ID Банковских Реквизитов Контрагента
 * @property string $number Номер
 * @property string $date Дата выставления
 * @property string|null $director Руководитель
 * @property string|null $bookkeeper Главный бухгалтер
 * @property string|null $storekeeper Главный бухгалтер
 * @property int|null $approved Согласовано
 * @property string|null $comment Комментарий
 * @property string|null $filename Прикрепленный файл
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property string $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property string $approvedAt Дата и время согласования
 * @property-read \App\Models\Documents\Shipment\Appendixes\Appendix|null $appendix
 * @property-read \App\Models\Auth\User|null $approvedBy
 * @property-read \App\Models\Documents\Shipment\Bills\Bill|null $bill
 * @property-read \App\Models\Contractors\Contractor $contractor
 * @property-read \App\Models\Contractors\BankAccountDetail|null $contractorBankAccountDetail
 * @property-read \App\Models\Contractors\PlaceOfBusiness $contractorPlaceOfBusiness
 * @property-read \App\Models\Auth\User|null $createdBy
 * @property-read \App\Models\Admin\Organizations\Organization $organization
 * @property-read \App\Models\Admin\Organizations\BankAccountDetail|null $organizationBankAccountDetail
 * @property-read \App\Models\Admin\Organizations\PlaceOfBusiness $organizationPlaceOfBusiness
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Documents\Shipment\PackingLists\PackingListProduct> $production
 * @property-read int|null $productionCount
 * @property-read \App\Models\Documents\Shipment\Protocols\Protocol|null $protocol
 * @property-read \App\Models\Auth\User|null $updatedBy
 * @property-read \App\Models\Documents\Shipment\Waybills\Waybill|null $waybill
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList query()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereApprovedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereBookkeeper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereContractorBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereContractorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereContractorPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereOrganizationBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereOrganizationPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereStorekeeper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingList withoutTrashed()
 * @mixin \Eloquent
 */
class PackingList extends Shipment
{
    use HasOrganization;
    use HasContractor;
    use HasShipmentDocuments;
    use Notifications;

    public const STORAGE = self::SHIPMENT_STORAGE . '/packing_lists/';

    protected $table = 'documents_shipment_packing_lists';

    protected $fillable = [
        'created_by_id',
        'updated_by_id',
        'approved_by_id',
        'packing_list_id',
        'number',
        'date',
        'approved',
        'comment',
        'filename',
        'approved_at',
        'organization_id',
        'organization_place_id',
        'organization_bank_id',
        'contractor_id',
        'contractor_place_id',
        'contractor_bank_id',
        'director',
        'bookkeeper',
        'storekeeper',
    ];

    /**
     * @return HasMany
     */
    public function production()
    {
        return $this->hasMany(PackingListProduct::class, 'packing_list_id')
            ->withTrashed();
    }
}
