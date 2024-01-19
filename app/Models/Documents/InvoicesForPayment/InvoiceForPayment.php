<?php

namespace App\Models\Documents\InvoicesForPayment;

use App\Models\Auth\User;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use App\Traits\Documents\InvoicesForPayment\HasContractor;
use App\Traits\Documents\InvoicesForPayment\HasOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Documents\InvoicesForPayment\InvoiceForPayment
 *
 * @property int $id
 * @property int|null $userId ID Пользователя
 * @property int $organizationId ID Организации
 * @property int $organizationPlaceId ID Адреса Отгрузки
 * @property int|null $organizationBankId ID Банковских реквизитов организации
 * @property int $contractorId ID Контрагента
 * @property int $contractorPlaceId ID Адреса Доставки
 * @property int|null                                                                                                              $contractorBankId ID Банковских Реквизитов Контрагента
 * @property string                                                                                                                $number Номер
 * @property string                                                                                                                $date Дата выставления
 * @property string|null                                                                                                           $director Руководитель
 * @property string|null                                                                                                           $bookkeeper Главный бухгалтер
 * @property string|null                                                                                                           $filename Прикрепленный файл
 * @property Carbon|null                                                                                                           $createdAt
 * @property string                                                                                                                $updatedAt
 * @property Carbon|null                                                                                                           $deletedAt
 * @property string|null                                                                                                           $fillingType Наполнение счета (Продукция, комплектующие и тд.)
 * @property-read \App\Models\Contractor\Contractor                                                                                $contractor
 * @property-read \App\Models\Contractor\BankAccountDetail|null                                                                    $contractorBankAccountDetail
 * @property-read \App\Models\Contractor\PlaceOfBusiness                                                                           $contractorPlaceOfBusiness
 * @property-read \App\Models\Admin\Organizations\Organization                                                                     $organization
 * @property-read \App\Models\Admin\Organizations\BankAccountDetail|null                                                           $organizationBankAccountDetail
 * @property-read \App\Models\Admin\Organizations\PlaceOfBusiness                                                                  $organizationPlaceOfBusiness
 * @property-read \Illuminate\Database\Eloquent\Collection<int, PackingListProduct>                                                $packingListProdiction
 * @property-read int|null                                                                                                         $packingListProdictionCount
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct> $production
 * @property-read int|null                                                                                                         $productionCount
 * @property-read User|null                                                                                                        $user
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereBookkeeper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereContractorBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereContractorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereContractorPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereFillingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereOrganizationBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereOrganizationPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPayment withoutTrashed()
 * @mixin \Eloquent
 */
class InvoiceForPayment extends Model
{
    use HasFactory;
    use HasOrganization;
    use HasContractor;
    use SoftDeletes;

    public const FILES_DIRECTORY = 'public/documents/invoices_for_payment/';

    protected $table = 'documents_invoices_for_payment';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'filling_type',
        'organization_id',
        'organization_place_id',
        'organization_bank_id',
        'contractor_id',
        'contractor_place_id',
        'contractor_bank_id',
        'number',
        'date',
        'director',
        'bookkeeper',
        'filename',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getDateAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y');
    }

    /**
     * @return HasMany
     */
    public function production()
    {
        switch ($this->filling_type) {
            case 'materials':
                $related = InvoiceForPaymentMaterial::class;
                break;
            default:
                $related = InvoiceForPaymentProduct::class;
                break;
        }
        return $this->hasMany($related, 'invoice_for_payment_id')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function packingListProdiction()
    {
        return $this->hasMany(PackingListProduct::class, 'invoice_for_payment_id')
            ->withTrashed();
    }
}
