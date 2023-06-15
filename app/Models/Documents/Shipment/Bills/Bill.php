<?php

namespace App\Models\Documents\Shipment\Bills;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\HasPackingList;

/**
 * App\Models\Documents\Shipment\Bills\Bill
 *
 * @property int $id
 * @property int|null $createdById Пользователь, создавший документ
 * @property int|null $updatedById Пользователь, изменивший документ
 * @property int|null $approvedById Пользователь, согласовавший документ
 * @property int $packingListId ID Товарной накладной
 * @property string $number Номер
 * @property string $date Дата выставления
 * @property int|null $approved Согласовано
 * @property string|null $comment Комментарий
 * @property string|null $filename Прикрепленный файл
 * @property string $approvedAt Дата и время согласования
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property string $updatedAt
 * @property-read \App\Models\Auth\User|null $approvedBy
 * @property-read \App\Models\Auth\User|null $createdBy
 * @property-read \App\Models\Documents\Shipment\PackingLists\PackingList $packingList
 * @property-read \App\Models\Auth\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereApprovedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill wherePackingListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill withoutTrashed()
 * @mixin \Eloquent
 */
class Bill extends Shipment
{
    use HasPackingList;

    public const STORAGE = self::SHIPMENT_STORAGE . '/bills/';
    protected $table = 'documents_shipment_bills';
}
