<?php

declare(strict_types=1);

namespace Sandbox\Image\Infrastructure\Services;

use Imagick;
use InvalidArgumentException;
use Sandbox\Image\Domain\Cropper;

class ImagickCropper implements Cropper
{
    public function __construct()
    {
    }

    public function execute(string $filename, int $width, int $height, int $xCoordinate, int $yCoordinate ): string
    {
        if(file_exists($filename) === false) {
            throw new InvalidArgumentException('File not found: ' . $filename);
        }
        $image = new Imagick($filename);
        $image->cropImage($width, $height, $xCoordinate, $yCoordinate);
        $image->setImageFormat('jpeg');
        return $image->getImageBlob();
    }
}
