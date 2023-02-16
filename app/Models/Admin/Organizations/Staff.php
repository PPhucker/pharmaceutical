<?php

namespace App\Models\Admin\Organizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organizations_staff';

    protected $fillable = [
        'organization_id',
        'organization_place_of_business_id',
        'name',
        'post'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STAFF = [
        'director' => 'Директор',
        'bookkeeper' => 'Главный бухгалтер',
        'storekeeper' => 'Заведующий складом готовой продукции',
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)
            ->withTrashed();
    }

    public function placeOfBusiness()
    {
        return $this->belongsTo(PlaceOfBusiness::class, 'organization_place_of_business_id')
            ->withTrashed();
    }
}
