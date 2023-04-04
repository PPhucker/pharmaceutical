<?php

namespace App\Models\Admin\Organizations;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\Organizations\Staff
 *
 * @property int                  $id
 * @property int                  $organizationId
 * @property int                  $organizationPlaceOfBusinessId
 * @property string               $name
 * @property string               $post
 * @property Carbon|null          $createdAt
 * @property Carbon|null          $updatedAt
 * @property Carbon|null          $deletedAt
 * @property-read Organization    $organization
 * @property-read PlaceOfBusiness $placeOfBusiness
 * @method static Builder|Staff newModelQuery()
 * @method static Builder|Staff newQuery()
 * @method static Builder|Staff onlyTrashed()
 * @method static Builder|Staff query()
 * @method static Builder|Staff whereCreatedAt($value)
 * @method static Builder|Staff whereDeletedAt($value)
 * @method static Builder|Staff whereId($value)
 * @method static Builder|Staff whereName($value)
 * @method static Builder|Staff whereOrganizationId($value)
 * @method static Builder|Staff whereOrganizationPlaceOfBusinessId($value)
 * @method static Builder|Staff wherePost($value)
 * @method static Builder|Staff whereUpdatedAt($value)
 * @method static Builder|Staff withTrashed()
 * @method static Builder|Staff withoutTrashed()
 * @mixin Eloquent
 */
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
