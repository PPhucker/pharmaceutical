<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\Contractor as Model;
use Illuminate\Support\Collection;

class ContractorRepository extends CoreRepository
{

    /**
     * @return string
     */
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
}
