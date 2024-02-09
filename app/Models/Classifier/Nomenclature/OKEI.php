<?php

namespace App\Models\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\Materials\Material;
use App\Models\Classifier\Nomenclature\Products\EndProduct;
use App\Models\Classifier\Nomenclature\Services\Service;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OKEI extends Model
{
    use HasFactory;

    protected $table = 'classifier_okei';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'unit', 'symbol'];

    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function materials()
    {
        return $this->hasMany(Material::class, 'okei_code')
            ->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'okei_code');
    }

    /**
     * @return HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'okei_code');
    }
}
