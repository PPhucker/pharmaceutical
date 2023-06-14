<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class File
{
    /**
     * @param string $directory
     * @param        $file
     * @param        $name
     *
     * @return void
     */
    public static function attach(string $directory, $file, $name)
    {
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        Storage::putFileAs($directory, $file, $name);
    }
}
