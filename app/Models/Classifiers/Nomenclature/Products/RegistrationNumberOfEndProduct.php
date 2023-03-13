<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationNumberOfEndProduct extends Model
{
    use HasFactory;

    protected $table = 'classifier_registration_numbers_of_end_products';

    protected $fillable = ['number'];

    protected $guarded = ['id'];

    public $timestamps = false;
}
