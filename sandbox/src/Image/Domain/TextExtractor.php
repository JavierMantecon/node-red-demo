<?php

declare(strict_types=1);

namespace Sandbox\Image\Domain;

interface TextExtractor
{
    public function execute(string $fileName): string;
}
