<?php

namespace App\Models;

use App\Services\FileStorageService;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function setThumbnailAttribute($image)
    {
        if (!empty($this->attributes['thumbnail'])) {
            FileStorageService::remove($this->attributes['thumbnail']);
        }

        $this->attributes['thumbnail'] = FileStorageService::upload($image);
    }

//    public function thumbnail(): Attribute
//    {
//        return new Attribute(
//            set: function($image) {
//                dd($this->attributes['thumbnail']);
//                if (!empty($this->attributes['thumbnail'])) {
//                    FileStorageService::remove($this->attributes['thumbnail']);
//                }
//
//                return FileStorageService::upload($image);
//            },
//        );
//    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
