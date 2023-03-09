<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfEndProduct extends Model
{
    use HasFactory;

    protected $table = 'classifier_types_of_end_products';

    protected $fillable = ['name', 'color'];

    protected $guarded = ['id'];

    public $timestamps = false;
}
