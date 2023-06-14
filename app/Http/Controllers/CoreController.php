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

        app($this->authorizeActions());

        $this->repository = app($this->getRepository());
    }

    /**
     * @return void
     */
    abstract protected function authorizeActions();

    /**
     * @return CoreRepository
     */
    abstract protected function getRepository();
}
