<?php

namespace App\Models\Documents\Shipment\Protocols;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\HasPackingList;

/**
 * App\Models\Documents\Shipment\Protocols\Protocol
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
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol query()
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereApprovedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol wherePackingListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Protocol withoutTrashed()
 * @mixin \Eloquent
 */
class Protocol extends Shipment
{
    use HasPackingList;

    public const STORAGE = self::SHIPMENT_STORAGE . '/protocols/';
    protected $table = 'documents_shipment_protocols';
}
