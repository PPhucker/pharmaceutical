<?php

namespace App\Helpers;

/**
 * Класс для помощи локализации сообщений.
 */
class Local
{
    private const SUCCESS_KEY = 'success';

    /**
     * Формирование ключа для сообщения об успешном действии.
     *
     * @param string $prefix
     * @param string $action
     *
     * @return string
     */
    public static function getSuccessMessageKey(string $prefix, string $action): string
    {
        return $prefix . '.actions.' . $action . '.' . self::SUCCESS_KEY;
    }
}
