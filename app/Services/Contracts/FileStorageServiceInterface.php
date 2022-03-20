<?php

namespace App\Services\Contracts;

interface FileStorageServiceInterface
{
    public static function upload($file): string;
    public static function remove($file);
}
