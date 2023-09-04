<?php

declare(strict_types=1);

namespace Sandbox\ImageContent\Infrastructure;

use Slim\App;


class TesseractExtractor
{
    public function __construct()
    {
    }

    public function execute(string $fileName) : array
    {
        $cmd = 'tesseract ' . $fileName . ' stdout';
        exec($cmd, $output);
        return $output;
    }
}
