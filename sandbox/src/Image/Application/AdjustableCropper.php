<?php

declare(strict_types=1);

namespace Sandbox\Image\Application;

use Sandbox\Image\Domain\Cropper;

final class AdjustableCropper
{
    public function __construct(public Cropper $cropper)
    {
    }

    public function execute(AdjustableCropperRequest $cropImageRequest): string
    {
        return $this->cropper->execute(
            $cropImageRequest->fileName(),
            $cropImageRequest->width(),
            $cropImageRequest->height(),
            $cropImageRequest->xCoordinate(),
            $cropImageRequest->yCoordinate()
        );
    }
}
