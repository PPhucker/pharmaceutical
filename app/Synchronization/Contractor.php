<?php

namespace App\Synchronization;

use App\Helpers\Dadata\DadataClient;
use App\Models\Classifiers\Bank;
use App\Models\Classifiers\LegalForm;
use App\Models\Contractors\BankAccountDetail;
use App\Models\Contractors\PlaceOfBusiness;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * Синхронизация конрагентов с rosbio-laravel-dev.
 */
class Contractor
{
    /**
     * Синхронизация.
     *
     * @return void
     */
    public function sync()
    {
        $innList = $this->getSyncInnList();

        foreach ($innList as $inn) {
            $this->create($inn);
        }
    }

    /**
     * Получение списка контрагентов, которых нет в БД проекта.
     *
     * @return array
     */
    private function getSyncInnList()
    {
        return array_unique(
            DB::connection('mysql@dev')
                ->table('clients')
                ->select(
                    'inn'
                )->whereNull('deleted_at')
                ->get()
                ->map(function ($inn) {
                    return $inn->inn;
                })
                ->diff(
                    \App\Models\Contractors\Contractor::select('INN')
                        ->whereNull('deleted_at')
                        ->get()
                        ->map(function ($inn) {
                            return $inn->INN;
                        })
                )
                ->all()
        );
    }

    /**
     * @param string $inn
     *
     * @return void
     */
    private function create(string $inn)
    {
        $dadataClient = new DadataClient();

        /**
         * Информация о контрагенте через DaData API.
         */
        $client = $dadataClient->get($inn);

        /**
         * Правовая форма.
         */
        $opf = $client->get('legalForm');

        /**
         * Обновление или создание правовой формы.
         */
        $legalForm = LegalForm::firstOrNew(
            [
                'abbreviation' => $opf->get('abbreviation')
            ]
        );

        $legalForm->decoding = $opf->get('decoding');
        $legalForm->save();

        /**
         * Занесение основной информации о контрагенте.
         */
        $contractor = \App\Models\Contractors\Contractor::create(
            [
                'legal_form_type' => $opf->get('abbreviation'),
                'name' => '"' . $client->get('name') . '"',
                'INN' => $client->get('inn'),
                'OKPO' => $client->get('okpo'),
                'contacts' => $this->getSyncContacts($client->get('inn')),
                'kpp' => $client->get('kpp'),
            ]
        );

        /**
         * Создание или обновление банков контрагента.
         */
        foreach ($this->getSyncBanks($inn) as $bank) {
            $bankClassifier = Bank::firstOrNew(
                [
                    'BIC' => (string)$bank->bic,
                ]
            );

            /**
             * Получение информации о банке через DaData API.
             */
            $dadataBank = $dadataClient->bank($bank->bic);

            /**
             * Если найдена информация о банке через DaData API, заменяем ей старую информацию о банке.
             */
            if ($dadataBank->first()) {
                $bankClassifier->name = $dadataBank->first()['value'];
                $bankClassifier->correspondent_account = $dadataBank->first()['data']['correspondent_account']
                    ?: $bank->correspondent_account;
            } else {
                $bankClassifier->name = $bank->name;
                $bankClassifier->correspondent_account = $bank->correspondent_account;
            }

            $bankClassifier->save();

            /**
             * Занесение информации о реквизитах контрагента.
             */
            BankAccountDetail::create(
                [
                    'contractor_id' => $contractor->id,
                    'bank' => (string)$bank->bic,
                    'payment_account' => (string)$bank->payment_account,
                ]
            );
        }

        /**
         * Получение юридического адреса контрагента.
         */
        $registered = $this->getSyncRegisterAddress($inn);

        /**
         * Занесение информации о юр. адресе контрагента.
         */
        PlaceOfBusiness::create(
            [
                'contractor_id' => $contractor->id,
                'registered' => 1,
                'index' => $registered->index,
                'address' => $registered->legal_address
            ]
        );

        /**
         * Получение мест осуществления деятельности конрагента.
         */
        $placesOfBusiness = $this->getSyncPlacesOfBusiness($inn);

        /**
         * Занесение информации о местах осуществления деятельности контрагента.
         */
        foreach ($placesOfBusiness as $place) {
            $placeOfBusiness = PlaceOfBusiness::firstOrNew(
                [
                    'contractor_id' => $contractor->id,
                    'address' => $place->address
                ]
            );

            $placeOfBusiness->identifier = $place->rid;
            $placeOfBusiness->index = $place->index;
            $placeOfBusiness->save();
        }
    }

    /**
     * Получение контактов контрагента, которых нет в БД проекта.
     *
     * @param string $inn
     *
     * @return mixed
     */
    private function getSyncContacts(string $inn)
    {
        return DB::connection('mysql@dev')
            ->table('clients')
            ->select('contacts')
            ->where('inn', $inn)
            ->whereNull('deleted_at')
            ->first()->contacts;
    }

    /**
     * Получение багковских реквизитов контрагента, которых нет в БД проекта.
     *
     * @param string $inn
     *
     * @return array
     */
    private function getSyncBanks(string $inn)
    {
        return DB::connection('mysql@dev')
            ->select(
                DB::raw(
                    "SELECT b.bic, b.payment_account, b.correspondent_account, b.name FROM banks b, clients c
                                WHERE b.client_id = c.id AND c.inn = $inn;"
                )
            );
    }

    /**
     * Получение юр. адреса контрагента, которого нет в БД проекта.
     *
     * @param string $inn
     *
     * @return Model|Builder|object|null
     */
    private function getSyncRegisterAddress(string $inn)
    {
        return DB::connection('mysql@dev')
            ->table('clients')
            ->select(['legal_address', 'index'])
            ->where('inn', $inn)
            ->whereNull('deleted_at')
            ->first();
    }

    /**
     * Получение места осуществления деятельности контрагента, которых нет в БД проекта.
     *
     * @param string $inn
     *
     * @return Collection
     */
    private function getSyncPlacesOfBusiness(string $inn)
    {
        $id = DB::connection('mysql@dev')
            ->table('clients')
            ->select('id')
            ->where('inn', $inn)
            ->whereNull('deleted_at')
            ->first()
            ->id;

        return DB::connection('mysql@dev')
            ->table('places_of_business')
            ->select(['index', 'rid', 'address'])
            ->where('client_id', $id)
            ->whereNull('deleted_at')
            ->get();
    }

    /**
     * @return void
     */
    public function syncKpp()
    {
        $devContractors = DB::connection('mysql@dev')
            ->table('clients')
            ->select(['inn', 'kpp'])
            ->whereNull('deleted_at')
            ->get();

        foreach ($devContractors as $devContractor) {
            $contractor = \App\Models\Contractors\Contractor::where('INN', $devContractor->inn)->first();
            if (!$contractor) {
                continue;
            }
            $contractor->fill(
                [
                    'kpp' => $devContractor->kpp
                ]
            )
                ->save();
        }
    }
}
