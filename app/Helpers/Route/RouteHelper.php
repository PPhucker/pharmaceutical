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
    private $name;

    private $controller;

    private $uriParameter;

    private $prefix;

    /**
     * @param Collection $routeParameters
     */
    public function __construct(Collection $routeParameters)
    {
        foreach (['name', 'controller', 'uriParameter'] as $requiredParameter) {
            if (!$routeParameters->has($requiredParameter)) {
                throw new InvalidArgumentException("Missing required parameter: $requiredParameter");
            }
            $this->$requiredParameter = $routeParameters->get($requiredParameter);
        }

        $this->prefix = $routeParameters->has('prefix')
            ? $routeParameters->get('prefix') . '.'
            : '';
    }

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
     * @return RouteHelper
     */
    public function mapWritableRoutes(): RouteHelper
    {
        $this->mapStoreMethod();
        $this->mapUpdateRoute();
        $this->mapDestroyRoute();
        $this->mapRestoreRoute();

        return $this;
    }

    /**
     * @return RouteHelper
     */
    public function mapStoreMethod(): RouteHelper
    {
        Route::post(
            '/' . $this->name,
            $this->controller . '@store'
        )->withTrashed()
            ->name(
                $this->prefix
                . $this->name
                . '.store'
            );

        return $this;
    }

    /**
     * @return RouteHelper
     */
    public function mapUpdateRoute(): RouteHelper
    {
        Route::patch(
            '/'
            . $this->name
            . '/{'
            . $this->uriParameter
            . '?}',
            $this->controller
            . '@update'
        )
            ->name(
                $this->prefix
                . $this->name
                . '.update'
            );

        return $this;
    }

    /**
     * @return RouteHelper
     */
    public function mapDestroyRoute(): RouteHelper
    {
        Route::delete(
            '/'
            . $this->name
            . '/{'
            . $this->uriParameter
            . '}/destroy',
            $this->controller
            . '@destroy'
        )->withTrashed()
            ->name(
                $this->prefix
                . $this->name
                . '.destroy'
            );

        return $this;
    }

    /**
     * @return RouteHelper
     */
    public function mapRestoreRoute(): RouteHelper
    {
        Route::post(
            '/'
            . $this->name
            . '/{'
            . $this->uriParameter
            . '}/restore',
            $this->controller
            . '@restore'
        )->withTrashed()
            ->name(
                $this->prefix
                . $this->name
                . '.restore'
            );

        return $this;
    }
}
