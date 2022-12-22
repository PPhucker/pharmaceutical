<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
