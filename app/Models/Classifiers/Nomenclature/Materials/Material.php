<?php

namespace App\Models\Classifiers\Nomenclature\Materials;

use App\Models\Classifiers\Nomenclature\OKEI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classifier_materials';

    protected $fillable = ['type_id', 'okei_code', 'name'];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function type()
    {
        return $this->belongsTo(TypeOfMaterial::class, 'type_id');
    }

    public function okei()
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }
}
