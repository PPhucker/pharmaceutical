<?php

namespace App\Traits\Classifier\Nomenclature\Relation;

use App\Models\Classifier\Nomenclature\Product\OKPD2;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOkpd2Classifier
{
    /**
     * @return BelongsTo
     */
    public function okpd2(): BelongsTo
    {
        return $this->belongsTo(OKPD2::class, 'okpd2_code');
    }
}
