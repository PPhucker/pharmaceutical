<?php

namespace App\Models\Classifiers\Nomenclature;

use App\Models\Classifiers\Nomenclature\Materials\Material;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OKEI extends Model
{
    use HasFactory;

    protected $table = 'classifier_okei';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'unit', 'symbol'];

    public $timestamps = false;

    public function materials()
    {
        return $this->hasMany(Material::class, 'okei_code')
            ->withTrashed();
    }

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'okei_code');
    }
}
