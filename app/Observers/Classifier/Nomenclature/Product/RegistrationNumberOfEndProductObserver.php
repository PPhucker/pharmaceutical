<?php

namespace App\Observers\Classifier\Nomenclature\Product;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct;

class RegistrationNumberOfEndProductObserver
{
    /**
     * Handle the RegistrationNumberOfEndProduct "created" event.
     *
     * @param RegistrationNumberOfEndProduct $registrationNumberOfEndProduct
     *
     * @return void
     */
    public function created(RegistrationNumberOfEndProduct $registrationNumberOfEndProduct)
    {
        Logger::userActionNotice('create', $registrationNumberOfEndProduct);
    }

    /**
     * Handle the RegistrationNumberOfEndProduct "updated" event.
     *
     * @param RegistrationNumberOfEndProduct $registrationNumberOfEndProduct
     *
     * @return void
     */
    public function updated(RegistrationNumberOfEndProduct $registrationNumberOfEndProduct)
    {
        Logger::userActionNotice('update', $registrationNumberOfEndProduct);
    }
}
