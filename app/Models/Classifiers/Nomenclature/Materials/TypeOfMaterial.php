<?php

namespace App\Models\Classifiers\Nomenclature\Materials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfMaterial extends Model
{
    use HasFactory;

    protected $table = 'classifier_types_of_materials';

    protected $fillable = ['name'];

    protected $guarded = ['id'];

    public $timestamps = false;

    public function materials()
    {
        return $this->hasMany(Material::class, 'type_id')
            ->withTrashed();
    }
}
