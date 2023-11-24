<?php

namespace App\Repositories\Admin\Organizations;

use App\Models\Admin\Organizations\Organization;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий организации.
 */
class OrganizationRepository extends CoreRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = false): Collection
    {
        $organizations = $this->clone()
            ->select(
                [
                    'id',
                    'legal_form_type',
                    'name',
                    'INN',
                    'OKPO',
                    'contacts',
                    'deleted_at'
                ]
            )
            ->orderBy('name');

        if ($withTrashed) {
            $organizations->withTrashed();
        }

        return $organizations->with('legalForm:abbreviation')
            ->get()
            ->sortBy('legalForm.abbreviation');
    }

    /**
     * @return Collection
     */
    public function getForDocument(): Collection
    {
        return $this->clone()
            ->select(
                [
                    'id',
                    'legal_form_type',
                    'name',
                    'deleted_at'
                ]
            )
            ->orderBy('name')
            ->withoutTrashed()
            ->with('legalForm:abbreviation')
            ->get();
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function getRegisteredAddress(int $id): ?\Illuminate\Support\Collection
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
     * @param int $id
     *
     * @return Organization
     */
    public function getForEdit(int $id): Organization
    {
        $organization = $this->model::findOrFail($id);

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

    public function create(array $validated)
    {
        // TODO: Implement create() method.
    }

    public function update($model, array $validated)
    {
        // TODO: Implement update() method.
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Organization::class;
    }
}
