<?php

namespace App\Services;

use App\Services\Contracts\FileStorageServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageService implements FileStorageServiceInterface
{
    public static function upload($file): string
    {
        if (is_null($file)) {
            return '';
        }

        if (is_string($file)) {
            return str_replace('public/storage', '', $file);
        }

        if ($is_string = is_string($file)) {
            $fileData = explode('.', $file); // ['1245124124_some_name', 'jpg']
        }

        $filePath = 'public/' . implode('/', str_split(Str::random(2), 2))
            . '/'
            . Str::random()
            . '.'
            . (!$is_string ? $file->getClientOriginalExtension() : $fileData[1]);

        Storage::put($filePath, File::get($file));

        return $filePath;
    }

    public static function remove($file)
    {
        Storage::delete($file);
    }
}
