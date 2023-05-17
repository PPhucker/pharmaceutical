<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\Contractor as Model;
use Illuminate\Support\Collection;

use function Symfony\Component\String\s;

class ContractorRepository extends CoreRepository
{

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
    public function getById(int $id)
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
                'drivers' => static function ($query) {
                    $query->orderBy('name');
                },
                'cars' => static function ($query) {
                    $query->orderBy('car_model');
                },
                'trailers' => static function ($query) {
                    $query->orderBy('type');
                },
            ]
        );

        return $contractor;
    }

    /**
     * @return Collection|null
     */
    public function getRegisteredAddress(int $id)
    {
        $registered = $this->clone()
            ->find($id)
            ->placesOfBusiness()
            ->where('registered', 1)
            ->first();

        if (!$registered) {
            return null;
        }
        return collect(
            [
                'index' => $registered->index,
                'address' => $registered->address,
            ]
        );
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
