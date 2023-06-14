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
 * App\Models\Auth\Role
 *
 * @property int                    $id
 * @property string                 $name
 * @property string                 $slug
 * @property Carbon|null            $createdAt
 * @property Carbon|null            $updatedAt
 * @property Carbon|null            $deletedAt
 * @property-read Permission|null   $permissions
 * @property-read Collection|User[] $users
 * @property-read int|null          $usersCount
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role onlyTrashed()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDeletedAt($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereSlug($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @method static Builder|Role withTrashed()
 * @method static Builder|Role withoutTrashed()
 * @mixin Builder
 * @mixin Eloquent
 */
class Role extends Model
{
    use HasFactory, SoftDeletes;

    final public function permissions(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'roles_permissions');
    }

    final public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles')->withTrashed();
    }

    /**
     * @return BelongsToMany
     */
    public function usersForEmailNotification()
    {
        return $this->belongsToMany(User::class, 'users_roles')
            ->withTimestamps()
            ->withoutTrashed();
    }
}
