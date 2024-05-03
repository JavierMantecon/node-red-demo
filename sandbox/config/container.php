<?php

use Psr\Container\ContainerInterface;
use Sandbox\Image\Domain\Cropper;
use Sandbox\Image\Domain\TextExtractor;
use Sandbox\Image\Infrastructure\Services\ImagickCropper;
use Sandbox\Image\Infrastructure\Services\TesseractTextExtractor;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },
    TextExtractor::class => function () {
        return new TesseractTextExtractor();
    },
    Cropper::class => function () {
        return new ImagickCropper();
    },
];
