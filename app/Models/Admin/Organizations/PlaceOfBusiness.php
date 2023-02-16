<?php

namespace App\Models\Admin\Organizations;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class PlaceOfBusiness extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organizations_places_of_business';

    protected $fillable = [
        'user_id',
        'organization_id',
        'identifier',
        'registered',
        'index',
        'address',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)
            ->withTrashed();
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'organization_place_of_business_id')
            ->withTrashed();
    }
}
