<?php

namespace App\Models\Documents\Shipment;

use App\Traits\Documents\Shipment\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

abstract class Shipment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUser;

    protected const SHIPMENT_STORAGE = 'public/documents/shipment';
    protected const STORAGE = '/';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
    ];

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getDateAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getApprovedAtAttribute($date)
    {
        if ($date === null) {
            return '';
        }
        return Carbon::parse($date)
            ->format('d.m.Y H:i:s');
    }


    /**
     * @return bool
     */
    public function isApproved()
    {
        return (int)$this->approved !== 0;
    }
}
