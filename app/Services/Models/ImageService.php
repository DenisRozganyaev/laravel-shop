<?php

namespace App\Services\Models;

use App\Services\Models\Contracts\ImageServiceInterface;
use Illuminate\Database\Eloquent\Model;

class ImageService implements ImageServiceInterface
{
    public static function attach(Model $model, string $methodName, array $images = [])
    {
        if (!method_exists($model, $methodName)) {
            $className = $model::class;
            throw new \Exception("${$className} doesn't have ${$methodName}");
        }

        if (!empty($images)) {
            foreach ($images as $image) {
                $model->$methodName()->create(['path' => $image]);
            }
        }
    }
}
