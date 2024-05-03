<?php

declare(strict_types=1);

namespace Sandbox\Image\Application;

use Psr\Http\Message\ServerRequestInterface as Request;

final class AdjustableCropperRequest
{
    public function __construct(
        private string $fileName,
        private int $width,
        private int $height,
        private int $xCoordinate,
        private int $yCoordinate
    ) {
    }

    public function fileName(): string
    {
        return $this->fileName;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function xCoordinate(): int
    {
        return $this->xCoordinate;
    }

    public function yCoordinate(): int
    {
        return $this->yCoordinate;
    }

    public static function fromRequestWithFilename(Request $request, $filename)
    {
        $body = $request->getParsedBody();
        return new AdjustableCropperRequest(
            $filename,
            (int) $body['width'],
            (int) $body['height'],
            (int) $body['x'],
            (int) $body['y']
        );
    }
}
