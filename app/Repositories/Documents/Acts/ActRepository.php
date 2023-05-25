<?php

namespace App\Repositories\Documents\Acts;

use App\Repositories\CoreRepository;
use App\Models\Documents\Acts\Act as Model;
use Illuminate\Support\Collection;

class ActRepository extends CoreRepository
{

    /**
     * @param array $filters
     * @param bool  $withTrashed
     *
     * @return Collection
     */
    public function getAll(array $filters, bool $withTrashed = true)
    {
        $acts = $this->clone()
            ->select(
                [
                    'id',
                    'user_id',
                    'organization_id',
                    'contractor_id',
                    'number',
                    'date',
                    'deleted_at',
                ]
            );

        if (isset($filters['organization_id'])) {
            $acts->where(
                'organization_id',
                (int)$filters['organization_id']
            );
        }

        if ($withTrashed) {
            $acts->withTrashed();
        } else {
            $acts->withoutTrashed();
        }

        return $acts
            ->whereBetween(
                'date',
                [$filters['fromDate'], $filters['toDate']]
            )
            ->with(
                [
                    'organization:id,name,legal_form_type',
                    'contractor:id,name,legal_form_type',
                ]
            )
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getById(int $id)
    {
        $act = $this->model::find($id);

        $act->load(
            [
                'user' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name'
                        ]
                    );
                },
                'contractor' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'legal_form_type'
                        ]
                    )
                        ->with('legalForm:abbreviation');
                },
                'organization' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'legal_form_type'
                        ]
                    )
                        ->with(
                            [
                                'legalForm:abbreviation',
                            ]
                        );
                },
                /*'services' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'service_id',
                            'quantity',
                            'price',
                            'nds'
                        ]
                    )
                        ->with(
                            [
                                'okei:code,unit,symbol',
                            ]
                        );
                },*/
            ]
        );

        return $act;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
