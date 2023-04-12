<?php

namespace App\Models\Documents;

use App\Models\Auth\User;
use App\Traits\Documents\InvoicesForPayment\HasContractor;
use App\Traits\Documents\InvoicesForPayment\HasOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class InvoiceForPayment extends Model
{
    use HasFactory, HasOrganization, HasContractor, SoftDeletes;

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

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i');
    }

    public function getDateAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y');
    }
}
