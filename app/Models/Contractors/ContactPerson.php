<?php

namespace App\Models\Contractors;

use App\Models\Auth\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Contractors\ContactPerson
 *
 * @property int             $id
 * @property int             $contractorId
 * @property string          $name
 * @property string|null     $post
 * @property string|null     $phone
 * @property string|null     $email
 * @property Carbon|null     $createdAt
 * @property Carbon|null     $updatedAt
 * @property Carbon|null     $deletedAt
 * @property-read Contractor $contractor
 * @property-read User       $user
 * @method static Builder|ContactPerson newModelQuery()
 * @method static Builder|ContactPerson newQuery()
 * @method static Builder|ContactPerson onlyTrashed()
 * @method static Builder|ContactPerson query()
 * @method static Builder|ContactPerson whereContractorId($value)
 * @method static Builder|ContactPerson whereCreatedAt($value)
 * @method static Builder|ContactPerson whereDeletedAt($value)
 * @method static Builder|ContactPerson whereEmail($value)
 * @method static Builder|ContactPerson whereId($value)
 * @method static Builder|ContactPerson whereName($value)
 * @method static Builder|ContactPerson wherePhone($value)
 * @method static Builder|ContactPerson wherePost($value)
 * @method static Builder|ContactPerson whereUpdatedAt($value)
 * @method static Builder|ContactPerson withTrashed()
 * @method static Builder|ContactPerson withoutTrashed()
 * @mixin Eloquent
 */
class ContactPerson extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contractors_contact_persons';

    protected $fillable = [
        'contractor_id',
        'name',
        'post',
        'phone',
        'email'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
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
        return $this->belongsTo(Contractor::class);
    }
}
