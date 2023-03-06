<?php

namespace App\Http\Controllers;

use App\Repositories\CoreRepository;
use Illuminate\Auth\Access\AuthorizationException;

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

        app($this->getPolicy());

        $this->repository = app($this->getRepository());
    }

    /**
     * @return CoreRepository
     */
    abstract protected function getRepository();

    abstract protected function getPolicy();
}
