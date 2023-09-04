<?php

declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->post('/get-image-content', Sandbox\ImageContent\Infrastructure\ImageContentExtractorController::class);
};
