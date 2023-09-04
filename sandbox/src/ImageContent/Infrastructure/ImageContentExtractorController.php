<?php

declare(strict_types=1);

namespace Sandbox\ImageContent\Infrastructure;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Laminas\Diactoros\UploadedFile;
use Slim\App;


final class ImageContentExtractorController
{
    public function __construct(App $app, TesseractExtractor $tesseractExtractor)
    {
        $this->uploadDirectory = $app->getContainer()->get('settings')['upload_directory'];
        $this->tesseractExtractor = $tesseractExtractor;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $uploadedFiles = $request->getUploadedFiles();
        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['file'];

        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            throw new \Exception("slim file upload error");
        }

        $filename = $this->moveUploadedFile($this->uploadDirectory, $uploadedFile);
        $result = $this->tesseractExtractor->execute($this->uploadDirectory . DIRECTORY_SEPARATOR . $filename);
        $response->getBody()->write(json_encode(["result" => $result]));
        return $response;
    }

    function moveUploadedFile($directory, UploadedFile $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}
