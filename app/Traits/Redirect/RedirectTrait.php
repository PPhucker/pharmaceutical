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
     * @param array       $replace Переменные для локаизации.
     *
     * @param string|null $route   Маршрут
     * @param array       $routeParameters
     *
     * @return RedirectResponse
     */
    public function successRedirect(
        array $replace = [],
        ?string $route = null,
        array $routeParameters = []
    ): RedirectResponse {
        $successMessage = $this->successMessage($replace);

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
