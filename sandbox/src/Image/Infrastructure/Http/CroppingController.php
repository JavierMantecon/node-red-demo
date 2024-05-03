<?php

declare(strict_types=1);

namespace Sandbox\Image\Infrastructure\Http;

use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sandbox\Image\Application\AdjustableCropper;
use Sandbox\Image\Application\AdjustableCropperRequest;
use Sandbox\Shared\Infrastructure\SlimUploadedImageMover;
use Slim\App;

final class CroppingController
{
    private SlimUploadedImageMover $imageMover;

    public function __construct(App $app, private AdjustableCropper $cropper)
    {
        $this->uploadDirectory = $app->getContainer()->get('settings')['upload_directory'];
        $this->imageMover = new SlimUploadedImageMover();
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['file'];

        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            throw new \Exception("slim file upload error");
        }

        $filename = $this->imageMover->execute($this->uploadDirectory, $uploadedFile);

        $result = $this->cropper->execute(AdjustableCropperRequest::fromRequestWithFilename($request, $filename));
        $response
            ->withHeader('Content-Type', 'image/jpeg')
            ->withHeader('Content-Disposition', 'attachment; filename=' . pathinfo($filename, PATHINFO_BASENAME));

        $response->getBody()->write($result);
        return $response;
    }
}
