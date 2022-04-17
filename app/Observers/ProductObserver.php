<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductUpdateNotification;
use App\Services\FileStorageService;

class ProductObserver
{

    public function updated(Product $product)
    {
        $old_count = $product->getOriginal('in_stock');

        if($old_count <= 0 && $product->in_stock > $old_count) {
            $product->followers()
                ->get()
                ->each
                ->notify(new ProductUpdateNotification($product));
        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        if ( $product->images()->count() > 0) {
            $product->images->each->delete();
        }
        FileStorageService::remove($product->thumbnail);
    }
}
