<?php

namespace App\Models\Classifier\Nomenclature\Product\Type;

use App\Models\Classifier\Nomenclature\Product\EndProduct;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfEndProduct extends Model
{
    use HasFactory;

    protected $table = 'classifier_types_of_end_products';

    protected $fillable = ['name', 'color'];

    protected $guarded = ['id'];

    public $timestamps = false;

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'type_id')
            ->withTrashed();
    }
}
