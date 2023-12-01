<?php

namespace App\Traits\Redirect;

use App\Traits\Message\MessageTrait;
use Illuminate\Http\RedirectResponse;

/**
 * Трейт редиректов.
 */
trait RedirectTrait
{
    use MessageTrait;

    /**
     * RedirectResponse с сообщением об успешном действии.
     *
     * @param string      $action  Действие
     * @param array       $replace Переменные для локаизации.
     *
     * @param string|null $route   Маршрут
     * @param array       $routeParameters
     *
     * @return RedirectResponse
     */
    public function successRedirect(
        string $action,
        array $replace = [],
        ?string $route = null,
        array $routeParameters = []
    ): RedirectResponse {
        $successMessage = $this->successMessage($action, $replace);

        if ($route) {
            $redirect = redirect()->route($route, $routeParameters);
        } else {
            $redirect = back();
        }

        return $redirect->with(
            $this->successKey,
            $successMessage
        );
    }
}
