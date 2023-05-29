<?php

namespace App\Models\Documents\Acts;

use App\Models\Auth\User;
use App\Models\Classifiers\Nomenclature\Services\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'documents_acts_services';

    protected $fillable = [
        'user_id',
        'act_id',
        'service_id',
        'quantity',
        'price',
        'nds',
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
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function act()
    {
        return $this->belongsTo(Act::class, 'act_id');
    }
}
