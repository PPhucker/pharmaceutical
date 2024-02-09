<?php

namespace App\Models\Documents\Shipment\PackingLists;

use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Documents\Shipment\PackingLists\PackingListProduct
 *
 * @property int $id
 * @property int|null $userId Пользователь, создавший документ
 * @property int $invoiceForPaymentId ID Счета на оплату
 * @property int $packingListId ID Товарной накладной
 * @property int|null $productId ID Продукта из каталога
 * @property string|null $series Серия
 * @property int $quantity Количество
 * @property float $price Цена с НДС
 * @property float $nds НДС
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read InvoiceForPayment $invoiceForPayment
 * @property-read \App\Models\Documents\Shipment\PackingLists\PackingList $packingList
 * @property-read ProductCatalog|null $productCatalog
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereInvoiceForPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereNds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct wherePackingListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereSeries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PackingListProduct withoutTrashed()
 * @mixin \Eloquent
 */
class PackingListProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documents_shipment_packing_lists_production';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'invoice_for_payment_id',
        'packing_list_id',
        'product_id',
        'series',
        'quantity',
        'price',
        'nds',
    ];

    /**
     * @return BelongsTo
     */
    public function packingList()
    {
        return $this->belongsTo(PackingList::class, 'packing_list_id')
            ->withTrashed();
    }

    public function invoiceForPayment()
    {
        return $this->belongsTo(InvoiceForPayment::class, 'invoice_for_payment_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function productCatalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'product_id')
            ->withTrashed();
    }
}
