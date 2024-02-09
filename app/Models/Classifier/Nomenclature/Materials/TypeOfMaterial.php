<?php

namespace App\Models\Classifier\Nomenclature\Materials;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\Nomenclature\Materials\TypeOfMaterial
 *
 * @property int                                                                          $id
 * @property string                                                                       $name Тип материалов
 * @property-read Collection<int, Material>                                               $materials
 * @property-read int|null                                                                $materialsCount
 * @method static Builder|TypeOfMaterial newModelQuery()
 * @method static Builder|TypeOfMaterial newQuery()
 * @method static Builder|TypeOfMaterial query()
 * @method static Builder|TypeOfMaterial whereId($value)
 * @method static Builder|TypeOfMaterial whereName($value)
 * @property-read Collection<int, \App\Models\Classifier\Nomenclature\Materials\Material> $materials
 * @mixin Eloquent
 */
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
