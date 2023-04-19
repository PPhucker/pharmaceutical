<?php

namespace App\Models\Contractors;

use App\Models\Auth\User;
use App\Traits\Contractors\PlacesOfBusiness\Documents\HasDocuments;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Contractors\PlaceOfBusiness
 *
 * @property int             $id
 * @property int|null        $userId
 * @property int             $contractorId
 * @property string|null     $identifier
 * @property int             $registered
 * @property string          $index
 * @property string          $address
 * @property Carbon|null     $createdAt
 * @property Carbon|null     $updatedAt
 * @property Carbon|null     $deletedAt
 * @property-read Contractor $contractor
 * @property-read User|null  $user
 * @method static Builder|PlaceOfBusiness newModelQuery()
 * @method static Builder|PlaceOfBusiness newQuery()
 * @method static Builder|PlaceOfBusiness onlyTrashed()
 * @method static Builder|PlaceOfBusiness query()
 * @method static Builder|PlaceOfBusiness whereAddress($value)
 * @method static Builder|PlaceOfBusiness whereContractorId($value)
 * @method static Builder|PlaceOfBusiness whereCreatedAt($value)
 * @method static Builder|PlaceOfBusiness whereDeletedAt($value)
 * @method static Builder|PlaceOfBusiness whereId($value)
 * @method static Builder|PlaceOfBusiness whereIdentifier($value)
 * @method static Builder|PlaceOfBusiness whereIndex($value)
 * @method static Builder|PlaceOfBusiness whereRegistered($value)
 * @method static Builder|PlaceOfBusiness whereUpdatedAt($value)
 * @method static Builder|PlaceOfBusiness whereUserId($value)
 * @method static Builder|PlaceOfBusiness withTrashed()
 * @method static Builder|PlaceOfBusiness withoutTrashed()
 * @mixin Eloquent
 */
class PlaceOfBusiness extends Model
{
    use HasFactory, HasDocuments, SoftDeletes;

    protected $table = 'contractors_places_of_business';

    protected $fillable = [
        'user_id',
        'contractor_id',
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

    public function contractor()
    {
        return $this->belongsTo(Contractor::class)
            ->withTrashed();
    }
}
