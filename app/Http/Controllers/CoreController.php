<?php

namespace App\Http\Controllers;

use App\Repositories\CoreRepository;

abstract class CoreController extends Controller
{
    /**
     * @var CoreRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->middleware(
            [
                'auth',
                'verified'
            ]
        );

        $this->repository = app($this->getRepository());
    }

    /**
     * @return CoreRepository
     */
    abstract protected function getRepository();

}
