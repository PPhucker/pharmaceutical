<?php

namespace App\Models\Auth;

use App\Models\Contractors\BankAccountDetail;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use App\Traits\Auth\Documents\HasDocuments;
use App\Traits\Auth\HasContractors;
use App\Traits\Auth\HasNomenclature;
use App\Traits\Auth\HasOrganizations;
use App\Traits\Auth\HasRolesAndPermissions;
use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Модель пользователя.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRolesAndPermissions;
    use HasDocuments;
    use SoftDeletes;
    use HasNomenclature;
    use HasOrganizations;
    use HasContractors;

    protected $dates = ['email_verified_at',];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)->format('d.m.Y');
    }
}
