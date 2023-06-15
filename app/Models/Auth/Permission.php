<?php

namespace App\Models\Auth;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
 * @property-read Collection<int, User> $usersForEmailNotification
 * @property-read int|null                                            $usersForEmailNotificationCount
 * @property-read Collection<int, \App\Models\Auth\User> $usersForEmailNotification
 * @mixin Eloquent
 */
class Permission extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return BelongsTo
     */
    final public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roles_permissions');
    }

    /**
     * @return BelongsToMany
     */
    public function usersForEmailNotification()
    {
        return $this->belongsToMany(User::class, 'users_permissions')
            ->withTimestamps()
            ->withoutTrashed();
    }
}
