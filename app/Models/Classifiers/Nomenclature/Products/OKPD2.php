<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OKPD2 extends Model
{
    use HasFactory;

    protected $table = 'classifier_okpd2';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['code', 'name'];
}
