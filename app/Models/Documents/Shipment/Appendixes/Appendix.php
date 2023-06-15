<?php

namespace App\Models\Documents\Shipment\Appendixes;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\HasPackingList;

/**
 * App\Models\Documents\Shipment\Appendixes\Appendix
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
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix query()
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereApprovedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix wherePackingListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Appendix withoutTrashed()
 * @mixin \Eloquent
 */
class Appendix extends Shipment
{
    use HasPackingList;

    public const STORAGE = self::SHIPMENT_STORAGE . '/appendixes/';
    protected $table = 'documents_shipment_appendixes';
}
