<?php

namespace App\Repositories\Admin\Organizations;

use App\Models\Admin\Organizations\Organization as Model;
use App\Repositories\CoreRepository;
use Illuminate\Support\Collection;

class OrganizationRepository extends CoreRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = true)
    {
        $organizations = $this->clone()
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
            ->orderBy('organizations.name');

        if ($withTrashed) {
            $organizations->withTrashed();
        } else {
            $organizations->withoutTrashed();
        }

        return $organizations->with('legalForm:abbreviation')
            ->get()
            ->sortBy('legalForm.abbreviation');
    }

    /**
     * @return Collection
     */
    public function getForDocument()
    {
        return $this->clone()
            ->select(
                [
                    'organizations.id',
                    'organizations.legal_form_type',
                    'organizations.name',
                    'organizations.deleted_at'
                ]
            )
            ->orderBy('organizations.name')
            ->withoutTrashed()
            ->with('legalForm:abbreviation')
            ->get();
    }

    /**
     * @param $id
     *
     * @return Collection
     */
    public function getById($id)
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
            'drivers' => static function ($query) {
                $query->orderBy('name');
            },
            'cars' => static function ($query) {
                $query->orderBy('car_model');
            },
            'trailers' => static function ($query) {
                $query->orderBy('type');
            },
        ]);

        return $organization;
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
