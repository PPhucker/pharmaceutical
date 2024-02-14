<?php

namespace App\Models\Classifier;

use App\Models\Admin\Organization\Organization;
use App\Models\Contractor\Contractor;
use App\Traits\Contractor\Relation\HasContractors;
use App\Traits\Model\RelationshipsTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель организационно правовой формы.
 */
class LegalForm extends Model
{
    use HasFactory;
    use RelationshipsTrait;
    use HasContractors;

    protected $table = 'classifier_legal_forms';

    protected $keyType = 'string';

    protected $primaryKey = 'abbreviation';

    protected $foreign_key = 'legal_form_type';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'abbreviation',
        'decoding',
    ];
}
