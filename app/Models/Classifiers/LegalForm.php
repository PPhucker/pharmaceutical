<?php

namespace App\Models\Classifiers;

use App\Models\Admin\Organizations\Organization;
use App\Models\Contractors\Contractor;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Classifiers\LegalForm
 *
 * @property string $abbreviation
 * @property string|null $decoding
 * @property-read Collection<int, Contractor> $contractors
 * @property-read int|null $contractorsCount
 * @property-read Collection<int, Organization> $organizations
 * @property-read int|null $organizationsCount
 * @method static Builder|LegalForm newModelQuery()
 * @method static Builder|LegalForm newQuery()
 * @method static Builder|LegalForm query()
 * @method static Builder|LegalForm whereAbbreviation($value)
 * @method static Builder|LegalForm whereDecoding($value)
 * @property-read Collection<int, Contractor> $contractors
 * @property-read Collection<int, Organization> $organizations
 * @mixin Eloquent
 */
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
