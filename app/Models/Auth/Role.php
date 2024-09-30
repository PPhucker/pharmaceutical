<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель роли пользователя.
 */
class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function permissions(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'roles_permissions');
    }

    /**
     * @param bool $withTrashed
     *
     * @return BelongsToMany
     */
    public function users(bool $withTrashed = false): BelongsToMany
    {
        $users = $this->belongsToMany(User::class, 'users_roles');

        if ($withTrashed) {
            return $users->withTrashed();
        }

        return $users->withTimestamps()
            ->withoutTrashed();
    }
}
