<?php

namespace App\Models\Classifier\Nomenclature\Material;

use App\Traits\Redirect\RedirectTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Модель типа комплектующего.
 */
class TypeOfMaterial extends Model
{
    use HasFactory;
    use RedirectTrait;

    public $timestamps = false;
    protected $table = 'classifier_types_of_materials';
    protected $fillable = [
        'name',
    ];
    protected $guarded = [
        'id',
    ];

    /**
     * @return HasMany
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'type_id')
            ->withTrashed();
    }
}
