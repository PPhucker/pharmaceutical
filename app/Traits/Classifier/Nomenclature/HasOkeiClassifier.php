<?php

namespace App\Traits\Classifier\Nomenclature;

use App\Models\Classifiers\Nomenclature\OKEI;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOkeiClassifier
{
    /**
     * @return BelongsTo
     */
    public function okei(): BelongsTo
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }
}