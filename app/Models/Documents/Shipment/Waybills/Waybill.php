<?php

namespace App\Models\Documents\Shipment\Waybills;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\HasPackingList;

/**
 * App\Models\Documents\Shipment\Waybills\Waybill
 *
 * @property int $id
 * @property int|null $createdById Пользователь, создавший документ
 * @property int|null $updatedById Пользователь, изменивший документ
 * @property int|null $approvedById Пользователь, согласовавший документ
 * @property int $packingListId ID Товарной накладной
 * @property string $number Номер
 * @property string $date Дата выставления
 * @property string|null $carModel Марка автомобиля
 * @property string|null $stateCarNumber Гос. № автомобиля
 * @property string|null $driver Водитель
 * @property string $licenceCard Лицензионная карточка
 * @property string $typeOfTransportation Вид перевозки
 * @property string|null $trailer1 Прицеп 1
 * @property string|null $trailer2 Прицеп 2
 * @property string|null $stateTrailer1Number Гос. № Прицеп 1
 * @property string|null $stateTrailer2Number Гос. № Прицеп 1
 * @property int|null $approved Согласовано
 * @property string|null $comment Комментарий
 * @property string|null $filename Прикрепленный файл
 * @property string $approvedAt Дата и время согласования
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property string $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read \App\Models\Auth\User|null $approvedBy
 * @property-read \App\Models\Auth\User|null $createdBy
 * @property-read \App\Models\Documents\Shipment\PackingLists\PackingList $packingList
 * @property-read \App\Models\Auth\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereApprovedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereCarModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereLicenceCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill wherePackingListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereStateCarNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereStateTrailer1Number($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereStateTrailer2Number($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereTrailer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereTrailer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereTypeOfTransportation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Waybill withoutTrashed()
 * @mixin \Eloquent
 */
class Waybill extends Shipment
{
    use HasPackingList;

    public const STORAGE = self::SHIPMENT_STORAGE . '/waybills/';

    protected $table = 'documents_shipment_waybills';

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
        'car_model',
        'state_car_number',
        'driver',
        'licence_card',
        'type_of_transportation',
        'trailer_1',
        'trailer_2',
        'state_trailer_1_number',
        'state_trailer_2_number',
    ];
}
