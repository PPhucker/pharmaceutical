<?php

namespace App\Models\Documents\InvoicesForPayment;

use App\Models\Auth\User;
use App\Models\Classifier\Nomenclature\Products\ProductCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct
 *
 * @property int $id
 * @property int|null $userId Пользователь
 * @property int $invoiceForPaymentId ID счета на оплату
 * @property int|null $productCatalogId ID продукта из каталога
 * @property int $quantity Количество
 * @property float|null $price Цена с НДС
 * @property float|null $nds НДС
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read \App\Models\Documents\InvoicesForPayment\InvoiceForPayment $invoiceForPayment
 * @property-read ProductCatalog|null $productCatalog
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereInvoiceForPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereNds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereProductCatalogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentProduct withoutTrashed()
 * @mixin \Eloquent
 */
class InvoiceForPaymentProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documents_invoices_for_payment_production';

    protected $fillable = [
        'user_id',
        'invoice_for_payment_id',
        'product_catalog_id',
        'quantity',
        'price',
        'nds',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iser_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function invoiceForPayment()
    {
        return $this->belongsTo(InvoiceForPayment::class, 'invoice_for_payment_id');
    }

    /**
     * @return BelongsTo
     */
    public function productCatalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'product_catalog_id');
    }
}
