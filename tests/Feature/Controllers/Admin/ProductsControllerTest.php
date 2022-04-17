<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Services\FileStorageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->artisan('db:seed RolesTableSeeder');
        $this->artisan('db:seed UsersTableSeeder');
        Category::factory(3)->create();

        $this->user = $this->getUser();
    }

    public function test_create_product()
    {
        $category = Category::all()->random();
        $productData = [
            'title' => 'Some Watches',
            'category' => $category->id,
            'description' => $this->faker->sentences(12, true),
            'short_description' => $this->faker->sentences(2, true),
            'SKU' => '44455',
            'price' => '100',
            'discount' => $this->faker->numberBetween(0, rand(5, 25)),
            'in_stock' => $this->faker->numberBetween(0, rand(2, 10)),
            'thumbnail' => UploadedFile::fake()->image('test.png'),
        ];

        FileStorageService::shouldReceive('upload')
            ->once()
            ->with('file')
            ->andReturn('value');

        $this->assertEquals(0, Product::all()->count());

        $response = $this->actingAs($this->user, 'web')
            ->post(
                route('admin.products.store', absolute: false),
                $productData
            );

        $product = Product::all()->first();

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas("status", 'The product "'. $productData['title'] . '" was successfully created!');
        $this->assertEquals(1, Product::all()->count());
        $this->assertEquals($productData['title'], $product->title);
    }

    private function getUser($role = 'admin'): User
    {
        $role = Role::$role()->first();
        return User::where('role_id', $role->id)->first();
    }
}
