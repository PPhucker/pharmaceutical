<?php

namespace App\Helpers\Dadata;

use Dadata\DadataClient as DadataAPI;

class DadataClient extends Dadata
{
    public function get(string $inn)
    {
        $client = (new DadataAPI($this->token, null))
            ->findById('party', $inn, 1);

        $data = collect($client[0]['data']);

        $opf = $data->get('opf');
        $name = $data->get('name');

        return collect(
            [
                'legalForm' => collect(
                    [
                        'abbreviation' => $opf['short'],
                        'decoding' => $opf['full']
                    ]
                ),
                'name' => $name['short'] ?: $name['full'],
                'inn' => $data['inn'],
                'okpo' => $data['okpo'],
                'kpp' => $data['kpp'],
            ]
        );
    }

    public function bank(string $bic)
    {
        return collect(
            (new DadataAPI($this->token, null))
                ->findById('bank', $bic, 1)
        );
    }
}
