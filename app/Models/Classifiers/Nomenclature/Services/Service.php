<?php

namespace App\Models\Classifiers\Nomenclature\Services;

use App\Models\Auth\User;
use App\Models\Classifiers\Nomenclature\OKEI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'classifier_services';

    protected $fillable = [
        'user_id',
        'name',
        'okei_code',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function okei()
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }
}
