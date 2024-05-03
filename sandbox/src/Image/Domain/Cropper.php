<?php

declare(strict_types=1);

namespace Sandbox\Image\Domain;

interface Cropper
{
    public function execute(string $filename, int $width, int $height, int $xCoordinate, int $yCoordinate): string;
}
