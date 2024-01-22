<?php

namespace App\Models\Contractor;

use App\Traits\Contractor\HasContractor;
use App\Traits\Contractor\HasOrganization;
use App\Traits\Model\RelationshipsTrait;
use App\Traits\User\HasUserAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Модель договора с контрагентом.
 */
class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasContractor;
    use HasOrganization;
    use HasUserAction;
    use RelationshipsTrait;

    protected $table = 'contractors_contracts';

    protected $fillable = [
        'created_by_id',
        'updated_by_id',
        'organization_id',
        'contractor_id',
        'number',
        'date',
        'comment',
        'is_valid',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Получить дату создания в формате d.m.Y H:i:s.
     *
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y H:i:s');
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getDateAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }

    /**
     * Получить дату обновления в формате d.m.Y H:i:s.
     *
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute($date): string
    {
        return Carbon::create($date)
            ->format('d.m.Y H:i:s');
    }
}
