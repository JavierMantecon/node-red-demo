<?php

declare(strict_types=1);

namespace Sandbox\Image\Infrastructure\Http;

use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sandbox\Image\Application\TextExtractorUseCase;
use Sandbox\Image\Domain\TextExtractor;
use Sandbox\Shared\Infrastructure\SlimUploadedImageMover;
use Slim\App;


final class TextExtractionController
{
    private SlimUploadedImageMover $imageMover;

    public function __construct(App $app, private TextExtractorUseCase $textExtractorUseCase)
    {
        $this->uploadDirectory = $app->getContainer()->get('settings')['upload_directory'];
        $this->imageMover = new SlimUploadedImageMover();
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $uploadedFiles = $request->getUploadedFiles();

        if (empty($uploadedFiles['file'])) {
            $response->getBody()->write(json_encode(["error" => "No file sent"]));
            return $response->withStatus(400);
        }

        $uploadedFile = $uploadedFiles['file'];

        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            throw new \Exception("slim file upload error");
        }

        $filename = $this->imageMover->execute($this->uploadDirectory, $uploadedFile);
        $result = $this->textExtractorUseCase->execute($filename);
        $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8');
        $response->getBody()->write(json_encode(["result" => $result], JSON_UNESCAPED_UNICODE));
        return $response;
    }


}
