<?php

namespace App\Traits\Message;

/**
 * Сообщение о действиях пользователя.
 */
trait MessageTrait
{
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
     * @param array $replace Переменные для локализации.
     *
     * @return string
     */
    public function successMessage(array $replace = []): string
    {
        return __(
            $this->getFullKeyForLocal($this->successKey),
            $replace
        );
    }

    /**
     * Возвращает полный ключ для локализации.
     *
     * @param string $key
     *
     * @return string
     */
    protected function getFullKeyForLocal(string $key): string
    {
        return 'actions.' . request()->route()->getActionMethod() . '.' . $key;
    }


}
