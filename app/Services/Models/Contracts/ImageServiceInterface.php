<?php

namespace App\Services\Models\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ImageServiceInterface
{
    public static function attach(Model $model, string $methodName, array $images = []);
}
