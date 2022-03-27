<?php

namespace Tests\Unit\Services\Models;

use App\Models\Category;
use App\Models\Product;
use App\Services\Models\ImageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class ImageServiceTest extends \Tests\TestCase
{
    use RefreshDatabase;

    protected $category, $product, $images = [];

    protected function setUpVariables(): void
    {
        $this->category = Category::factory(1)->create()->first();
        $this->product = Product::factory(1, ['category_id' => $this->category->id])->create()->first();
        $this->images = [
            UploadedFile::fake()->image('test.png'),
            UploadedFile::fake()->image('test1.png')
        ];
    }

    public function test_attach_images_array_to_product()
    {
        $this->setUpVariables();

        $this->assertEquals(0, $this->product->images()->count());

        ImageService::attach($this->product, 'images', $this->images);

        $this->assertEquals(2, $this->product->images()->count());
    }

    public function test_attach_images_array_is_empty()
    {
        $this->setUpVariables();

        $this->assertEquals(0, $this->product->images()->count());

        ImageService::attach($this->product, 'images', []);

        $this->assertEquals(0, $this->product->images()->count());
    }

    public function test_if_method_does_not_exists()
    {
        $method = "1234";
        $this->setUpVariables();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($this->product::class . " doesn't have $method");

        ImageService::attach($this->product, $method, $this->images);
    }
}

