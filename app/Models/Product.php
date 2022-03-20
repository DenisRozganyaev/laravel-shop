<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'short_description',
        'SKU',
        'price',
        'discount',
        'in_stock',
        'thumbnail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setThumbnailAttributes($image)
    {
        if (!empty($this->attributes['thumbnail'])) {
            ImageService::remove($this->attributes['thumbnail']);
        }

        $this->attributes['thumbnail'] = ImageService::upload($image);
    }
}
