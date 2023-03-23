<?php

namespace App\Models\Classifiers\Nomenclature\Materials;

use App\Models\Classifiers\Nomenclature\OKEI;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classifier_materials';

    protected $fillable = ['type_id', 'okei_code', 'name'];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::create($date)
            ->format('d.m.Y');
    }
    public function type()
    {
        return $this->belongsTo(TypeOfMaterial::class, 'type_id');
    }

    public function okei()
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }

    public function endProducts()
    {
        return $this->belongsToMany(
            ProductCatalog::class,
            'product_catalog_materials'
        )
            ->withPivot('user_id')
            ->withTimestamps();
    }
}
