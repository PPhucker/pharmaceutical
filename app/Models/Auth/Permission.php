<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Auth\Permission
 *
 * @property int            $id
 * @property string         $name
 * @property string         $slug
 * @property Carbon|null    $createdAt
 * @property Carbon|null    $updatedAt
 * @property Carbon|null    $deletedAt
 * @property-read Role|null $roles
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission onlyTrashed()
 * @method static Builder|Permission query()
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereDeletedAt($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereName($value)
 * @method static Builder|Permission whereSlug($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 * @method static Builder|Permission withTrashed()
 * @method static Builder|Permission withoutTrashed()
 * @mixin Builder
 */
class Permission extends Model
{
    use HasFactory, SoftDeletes;

    final public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roles_permissions');
    }
}
