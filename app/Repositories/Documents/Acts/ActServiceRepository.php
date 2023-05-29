<?php

namespace App\Repositories\Documents\Acts;

use App\Repositories\CoreRepository;
use App\Models\Documents\Acts\ActService as Model;
use Illuminate\Database\Eloquent\Collection;

class ActServiceRepository extends CoreRepository
{
    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getFullInfo(int $id)
    {
        $actService = $this->model->clone()
            ->find($id);

        $actService->load(
            [
                'service' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'okei_code',
                        ]
                    )
                        ->with(
                            [
                                'okei:code,symbol,unit',
                            ]
                        );
                },
            ]
        );

        return $actService;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
