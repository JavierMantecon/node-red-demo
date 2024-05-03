<?php

declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->post('/image/ocr-extractor', \Sandbox\Image\Infrastructure\Http\TextExtractionController::class);
    $app->post('/image/cropper', \Sandbox\Image\Infrastructure\Http\CroppingController::class);
};
