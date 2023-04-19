<?php

namespace App\Models\Documents\InvoicesForPayment;

use App\Models\Auth\User;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
