<?php

declare(strict_types=1);

namespace Sandbox\Shared\Infrastructure;

use Laminas\Diactoros\UploadedFile;

class SlimUploadedImageMover
{
    public function execute($directory, UploadedFile $uploadedFile): string
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $destination = $directory . DIRECTORY_SEPARATOR . $filename;
        $uploadedFile->moveTo($destination);

        return $destination;
    }
}
