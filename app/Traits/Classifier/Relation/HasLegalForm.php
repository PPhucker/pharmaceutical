<?php

namespace App\Traits\Classifier\Relation;

use App\Models\Classifiers\LegalForm;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasLegalForm
{
    /**
     * @return BelongsTo
     */
    public function legalForm(): BelongsTo
    {
        return $this->belongsTo(LegalForm::class, 'legal_form_type');
    }
}
