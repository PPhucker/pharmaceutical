<?php

namespace App\Logging;

use App\Helpers\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Класс обработчик действий пользователей для их записи в лог.
 */
class ActionHandler
{
    /**
     * Обработка действий.
     *
     * @param string     $action
     * @param Collection $info
     * @param Model      $model
     * @param array      $relations
     *
     * @return void
     */
    public function handleAction(
        string $action,
        Collection $info,
        $model,
        array $relations = []
    ): void {
        $changes = [];

        switch ($action) {
            case 'attach':
            case 'detach':
            case 'login':
            case 'login_failed':
            case 'logout':
                foreach ($relations as $key => $relation) {
                    $changes['attributes'][$key] = $relation;
                }
                break;
            case 'create':
                $changes = ['attributes' => $model->getAttributes()];
                break;
            case 'update':
                if (ModelHelper::modelIsDirty($model)) {
                    $changes = ['attributes' => ModelHelper::getDirtyAttributes($model)];
                }
                break;
        }

        if (!empty($changes)) {
            $info->put('changes', $changes);
        }
    }
}
