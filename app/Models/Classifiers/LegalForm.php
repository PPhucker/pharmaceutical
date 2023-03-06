<?php

namespace App\Models\Classifiers;

use App\Models\Admin\Organizations\Organization;
use App\Models\Contractors\Contractor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalForm extends Model
{
    use HasFactory;

    protected $table = 'classifier_legal_forms';

    protected $keyType = 'string';

    protected $primaryKey = 'abbreviation';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['abbreviation', 'decoding'];

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'legal_form_type')
            ->withTrashed();
    }

    public function contractors()
    {
        return $this->hasMany(Contractor::class, 'legal_form_type')
            ->withTrashed();
    }

}
