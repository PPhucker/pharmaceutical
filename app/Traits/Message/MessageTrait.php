<?php

namespace App\Traits\Message;

/**
 * Сообщение о действиях пользователя.
 */
trait MessageTrait
{
    /**
     * Префикс к массиву файла локализации.
     *
     * @var string
     */
    protected $prefixLocalKey;
    /**
     * Ключ успешного действия.
     *
     * @var string
     */
    protected $successKey = 'success';

    /**
     * Ключ неудавшегося действия.
     *
     * @var string
     */
    protected $failKey = 'fail';

    /**
     * Возвращает локализированное сообщение об успешном действии.
     *
     * @param string $action  Действие (create, update, delete, restore)
     * @param array  $replace Переменные для локализации.
     *
     * @return string
     */
    public function successMessage(string $action, array $replace = []): string
    {
        return __(
            $this->getFullKeyForLocal($action, $this->successKey),
            $replace
        );
    }

    /**
     * Возвращает полный ключ для локализации.
     *
     * @param string $action
     * @param string $key
     *
     * @return string
     */
    protected function getFullKeyForLocal(string $action, string $key): string
    {
        return $this->prefixLocalKey . '.actions.' . $action . '.' . $key;
    }


}
