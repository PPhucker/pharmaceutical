<?php

namespace App\Models\Documents\InvoicesForPayment;

use App\Models\Classifiers\Nomenclature\Materials\Material;
use App\Models\Auth\User;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Documents\InvoicesForPayment\InvoiceForPaymentMaterial
 *
 * @property int $id
 * @property int|null $userId Пользователь
 * @property int $invoiceForPaymentId ID счета на оплату
 * @property int|null $materialId ID комплектующего
 * @property int $quantity Количество
 * @property float|null $price Цена с НДС
 * @property float|null $nds НДС
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read InvoiceForPayment $invoiceForPayment
 * @property-read Material|null $material
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereInvoiceForPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereNds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceForPaymentMaterial withoutTrashed()
 * @mixin \Eloquent
 */
class InvoiceForPaymentMaterial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'documents_invoices_for_payment_materials';

    protected $fillable = [
        'user_id',
        'invoice_for_payment_id',
        'material_id',
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
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
