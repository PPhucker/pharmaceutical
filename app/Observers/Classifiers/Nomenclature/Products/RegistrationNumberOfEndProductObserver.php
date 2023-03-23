<?php

namespace App\Observers\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProduct;

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
