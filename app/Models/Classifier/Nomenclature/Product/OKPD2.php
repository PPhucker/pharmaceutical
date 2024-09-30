<?php

namespace App\Models\Classifier\Nomenclature\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель классификатора ОКПД2.
 */
class OKPD2 extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'classifier_okpd2';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * @return string
     */
    public function getNameWithCodeAttribute(): string
    {
        return $this->name . ' - ' . $this->code;
    }
}
