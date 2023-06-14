<?php

namespace App\Helpers\Dadata;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

/**
 * @property Repository|Application|mixed $secret
 */
abstract class Dadata
{
    /**
     * @var Repository|Application|mixed
     */
    protected $token;

    /**
     * @var Repository|Application|mixed
     */
    protected $secret;

    public function __construct()
    {
        $this->token = config('dadata.token');
        $this->secret = config('dadata.secret');
    }
}
