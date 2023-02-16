<?php

namespace App\Repositories\Admin\Organizations;

use App\Models\Admin\Organizations\Organization as Model;
use App\Repositories\CoreRepository;
use Illuminate\Support\Collection;

class OrganizationRepository extends CoreRepository
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
                    'organizations.id',
                    'organizations.legal_form_type',
                    'organizations.name',
                    'organizations.INN',
                    'organizations.OKPO',
                    'organizations.contacts',
                    'organizations.deleted_at'
                ]
            )
            ->orderBy('organizations.name')
            ->withTrashed()
            ->with('legalForm:abbreviation')
            ->get();
    }

    /**
     * @param $id
     *
     * @return Collection
     */
    public function getForEdit($id)
    {
        $organization = $this->model::find($id);

        $organization->load([
            'legalForm' => static function ($query) {
                $query->select('classifier_legal_forms.abbreviation')
                    ->orderBy('abbreviation');
            },
            'placesOfBusiness' => static function ($query) {
                $query->orderByDesc('organizations_places_of_business.registered');
            },
            'bankAccountDetails' => static function ($query) {
                $query->orderBy('organizations_bank_account_details.bank')
                    ->with('bankClassifier');
            },
            'staff' => static function ($query) {
                $query->orderBy('name')
                    ->with('placeOfBusiness');
            },
        ]);

        return $organization;
    }
}
