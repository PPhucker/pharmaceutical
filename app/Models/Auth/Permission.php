<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель прав пользователя.
 */
class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'permissions';

    /**
     * @return BelongsTo
     */
    final public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roles_permissions');
    }

    /**
     * @param bool $withTrashed
     *
     * @return BelongsToMany
     */
    public function users(bool $withTrashed = false): BelongsToMany
    {
        $users = $this->belongsToMany(User::class, 'users_permissions');

        if ($withTrashed) {
            return $users->withTrashed();
        }

        return $users->withTimestamps()
            ->withoutTrashed();
    }
}
