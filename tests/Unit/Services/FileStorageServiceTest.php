<?php

namespace Tests\Unit\Services;

use App\Models\Category;
use App\Models\Product;
use App\Services\FileStorageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageServiceTest extends TestCase
{
    public function test_upload_file_to_storage()
    {
        $result = FileStorageService::upload(UploadedFile::fake()->image('test.png'));
        $this->assertNotEmpty($result);
        $this->assertTrue(Storage::fileExists($result));
    }

    public function test_upload_if_file_does_not_exists()
    {
        $result = FileStorageService::upload('UploadedFile::fake()->image()');
        $this->assertNotEmpty($result);
        $this->assertFalse(Storage::fileExists($result));
    }

    public function test_upload_if_file_path_is_string()
    {
        $result = FileStorageService::upload('public/storage/images/file.png');
        $this->assertNotEmpty($result);
        $this->assertEquals('/images/file.png', $result);
        $this->assertFalse(Storage::fileExists($result));
    }

    public function test_upload_file_is_null()
    {
        $result = FileStorageService::upload(null);
        $this->assertEmpty($result);
        $this->assertFalse(Storage::fileExists($result));
    }

    public function test_remove_file()
    {
        $result = FileStorageService::upload(UploadedFile::fake()->image('test.png'));
        $this->assertTrue(Storage::fileExists($result));
        FileStorageService::remove($result);
        $this->assertFalse(Storage::fileExists($result));
    }
}
