<?php

declare(strict_types=1);

namespace Sandbox\Image\Infrastructure\Services;

use Sandbox\Image\Domain\TextExtractor;


class TesseractTextExtractor implements TextExtractor
{
    public function __construct()
    {
    }

    public function execute(string $fileName): string
    {
        $safeFileName = escapeshellarg($fileName);

        $cmd = 'tesseract ' . $safeFileName . ' stdout';
        exec($cmd, $output);

        return implode(' ', $output);
    }
}
