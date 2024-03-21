<?php

namespace App\Helpers\Route;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

use InvalidArgumentException;

use function dirname;

/**
 *
 */
class RouteHelper
{
    /**
     * Метод рекурсивной загрузки маршрутов из директории routes.
     *
     * @param string $directory
     *
     * @return void
     */
    public static function loadRoutesFromDirectory(string $directory): void
    {
        $files = File::allFiles($directory);

        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $relativePath = $file->getRelativePath();

                if (!$relativePath) {
                    continue;
                }

                $dirName = basename(
                    dirname(
                        $file->getPathname()
                    )
                );

                $path = str_replace('\\', '/', $relativePath);

                $routePrefix = ($dirName !== $file->getFilenameWithoutExtension())
                    ? $path . '/'
                    : str_replace($dirName, '', $path);

                Route::prefix($routePrefix)
                    ->group(function () use ($file) {
                        require $file->getPathname();
                    });
            } elseif ($file->isDir()) {
                self::loadRoutesFromDirectory($file->getPathname());
            }
        }
    }

    /**
     * Создает маршруты store, update, destroy, restore для указанного контроллера.
     *
     * @param Collection $routeParameters Параметры маршрута, такие как имя, контроллер и дополнительные параметры.
     *
     * @return void
     */
    public static function mapWritableRoutes(Collection $routeParameters): void
    {
        $requiredParameters = [
            'name',
            'controller',
            'uriParameter'
        ];

        foreach ($requiredParameters as $requiredParameter) {
            if (!$routeParameters->has($requiredParameter)) {
                throw new InvalidArgumentException("Missing required parameter: $requiredParameter");
            }
        }

        $resourceRoutes = Route::resource(
            $routeParameters->get('name'),
            $routeParameters->get('controller')
        )
            ->only(['store', 'destroy'])
            ->parameters(
                [
                    $routeParameters->get('name') => $routeParameters->get('uriParameter')
                ]
            );

        $updateRoute = Route::patch(
            '/'
            . $routeParameters->get('name')
            . '/{'
            . $routeParameters->get('uriParameter')
            . '?}',
            $routeParameters->get('controller')
            . '@update'
        )->defaults(
            $routeParameters->get('uriParameter'),
            1
        );

        $restoreRoute = Route::post(
            '/'
            . $routeParameters->get('name')
            . '/{'
            . $routeParameters->get('uriParameter')
            . '}/restore',
            $routeParameters->get('controller') . '@restore'
        )->withTrashed();

        if ($routeParameters->has('prefix')) {
            $namePrefix = $routeParameters->get('prefix') . '.';
            $resourceRoutes->names(
                $namePrefix
                . $routeParameters->get('name')
            );
            $updateRoute->name(
                $namePrefix
                . $routeParameters->get('name') . '.update'
            );
            $restoreRoute->name(
                $namePrefix
                . $routeParameters->get('name') . '.restore'
            );
        }
    }


}
