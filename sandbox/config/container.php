<?php
use Psr\Container\ContainerInterface;
use Sandbox\ImageContent\Application\Extract\ImageContentExtractor;
use Sandbox\ImageContent\Infrastructure\TesseractExtractor;
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
    TesseractExtractor::class => function () {
        return new TesseractExtractor();
    },
];
