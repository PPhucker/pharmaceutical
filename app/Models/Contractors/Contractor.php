<?php

namespace App\Models\Contractors;

use App\Models\Auth\User;
use App\Models\Classifiers\LegalForm;
use App\Traits\Contractors\Notifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Contractor extends Model
{
    use HasFactory, SoftDeletes, Notifications;

    protected $table = 'contractors';

    protected $fillable = [
        'user_id',
        'legal_form_type',
        'name',
        'INN',
        'OKPO',
        'contacts'
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
            ->format('d.m.Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }

    public function legalForm()
    {
        return $this->belongsTo(LegalForm::class, 'legal_form_type');
    }

    public function placesOfBusiness()
    {
        return $this->hasMany(PlaceOfBusiness::class)
            ->withTrashed();
    }

    public function bankAccountDetails()
    {
        return $this->hasMany(BankAccountDetail::class)
            ->withTrashed();
    }

    public function contactPersons()
    {
        return $this->hasMany(ContactPerson::class)
            ->withTrashed();
    }
}
