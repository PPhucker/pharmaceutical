<?php

namespace App\Repositories\Contractors;

use App\Helpers\Dadata\DadataClient;
use App\Models\Classifiers\Bank;
use App\Models\Classifiers\LegalForm;
use App\Models\Contractors\BankAccountDetail;
use App\Models\Contractors\Contractor;
use App\Models\Contractors\PlaceOfBusiness;
use App\Repositories\CoreRepository;
use App\Models\Contractors\Contractor as Model;
use DB;
use Illuminate\Support\Collection;

class ContractorRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return $this->clone()
            ->select(
                [
                    'contractors.id',
                    'contractors.legal_form_type',
                    'contractors.name',
                    'contractors.INN',
                    'contractors.OKPO',
                    'contractors.contacts',
                    'contractors.deleted_at'
                ]
            )
            ->orderBy('contractors.name')
            ->withTrashed()
            ->with('legalForm:abbreviation')
            ->get()
            ->sortBy('legalForm.abbreviation');
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getForEdit(int $id)
    {
        $contractor = $this->model::find($id);

        $contractor->load(
            [
                'legalForm' => static function ($query) {
                    $query->select('classifier_legal_forms.abbreviation')
                        ->orderBy('abbreviation');
                },
                'placesOfBusiness' => static function ($query) {
                    $query->orderByDesc('contractors_places_of_business.registered');
                },
                'bankAccountDetails' => static function ($query) {
                    $query->orderBy('contractors_bank_account_details.bank')
                        ->with('bankClassifier');
                },
                'contactPersons' => static function ($query) {
                    $query->orderByDesc('contractors_contact_persons.name');
                },
            ]
        );

        return $contractor;
    }

    private function create(string $inn)
    {
        $dadataClient = new DadataClient();

        $client = $dadataClient->get($inn);

        $opf = $client->get('legalForm');

        $legalForm = LegalForm::firstOrNew(
            [
                'abbreviation' => $opf->get('abbreviation')
            ]
        );

        $legalForm->decoding = $opf->get('decoding');
        $legalForm->save();

        $contractor = Contractor::create(
            [
                'legal_form_type' => $opf->get('abbreviation'),
                'name' => '"' . $client->get('name') . '"',
                'INN' => $client->get('inn'),
                'OKPO' => $client->get('okpo'),
                'contacts' => $this->getSyncContacts($client->get('inn'))
            ]
        );

        foreach ($this->getSyncBanks($inn) as $bank) {
            $bankClassifier = Bank::firstOrNew(
                [
                    'BIC' => (string)$bank->bic,
                ]
            );

            $dadataBank = $dadataClient->bank($bank->bic);

            if ($dadataBank->first()) {
                $bankClassifier->name = $dadataBank->first()['value'];
                $bankClassifier->correspondent_account = $dadataBank->first(
                )['data']['correspondent_account'] ?: $bank->correspondent_account;
            } else {
                $bankClassifier->name = $bank->name;
                $bankClassifier->correspondent_account = $bank->correspondent_account;
            }

            $bankClassifier->save();

            BankAccountDetail::create(
                [
                    'contractor_id' => $contractor->id,
                    'bank' => (string)$bank->bic,
                    'payment_account' => (string)$bank->payment_account,
                ]
            );
        }

        $registered = $this->getSyncRegisterAddress($inn);

        PlaceOfBusiness::create(
            [
                'contractor_id' => $contractor->id,
                'registered' => 1,
                'index' => $registered->index,
                'address' => $registered->legal_address
            ]
        );

        $placesOfBusiness = $this->getSyncPlacesOfBusiness($inn);

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
                    Contractor::select('INN')
                        ->whereNull('deleted_at')
                        ->get()
                        ->map(function ($inn) {
                            return $inn->INN;
                        })
                )
                ->all()
        );
    }

    private function getSyncContacts(string $inn)
    {
        return DB::connection('mysql@dev')
            ->table('clients')
            ->select('contacts')
            ->where('inn', $inn)
            ->whereNull('deleted_at')
            ->first()->contacts;
    }

    private function getSyncRegisterAddress(string $inn)
    {
        return DB::connection('mysql@dev')
            ->table('clients')
            ->select(['legal_address', 'index'])
            ->where('inn', $inn)
            ->whereNull('deleted_at')
            ->first();
    }

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

    public function sync()
    {
        $innList = $this->getSyncInnList();

        foreach ($innList as $inn) {
            $this->create($inn);
        }
    }
}
