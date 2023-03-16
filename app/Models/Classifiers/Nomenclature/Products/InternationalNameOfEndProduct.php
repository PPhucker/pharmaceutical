<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalNameOfEndProduct extends Model
{
    use HasFactory;

    protected $table = 'classifier_international_names_of_end_products';

    public $timestamps = false;

    protected $fillable = ['name'];

    protected $guarded = ['id'];

    public function endProducts()
    {
        return $this->hasMany(EndProduct::class, 'international_name_id');
    }
}
