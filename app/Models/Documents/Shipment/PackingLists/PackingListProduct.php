<?php

namespace App\Models\Documents\Shipment\PackingLists;

use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
