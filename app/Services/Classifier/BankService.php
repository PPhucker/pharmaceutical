<?php

namespace App\Services\Classifier;

/**
 * Сервис классификатора банков.
 */
class BankService extends ClassifierService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $banks = $this->repositories->bank->getAll();

        return compact('banks');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->bank;
    }
}
