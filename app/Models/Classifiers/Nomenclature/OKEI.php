<?php

namespace App\Models\Classifiers\Nomenclature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OKEI extends Model
{
    use HasFactory;

    protected $table = 'classifier_okei';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'unit', 'symbol'];

    public $timestamps = false;
}
