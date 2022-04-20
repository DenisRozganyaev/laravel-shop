<?php

namespace App\Services\Contracts;

interface IAwsPublicLink
{
    public function generate(string $filePath): string;
}
