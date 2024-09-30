<?php

namespace App\Http\Controllers;

use App\Traits\Redirect\RedirectTrait;

/**
 * Главный контроллер.
 */
abstract class CoreController extends Controller
{
    use RedirectTrait;
}
