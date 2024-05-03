<?php

declare(strict_types=1);

namespace Sandbox\Image\Application;

use Sandbox\Image\Domain\TextExtractor;

final class TextExtractorUseCase
{
    public function __construct(public TextExtractor $textExtractor)
    {
    }

    public function execute(string $fileName): string
    {
        return $this->textExtractor->execute($fileName);
    }
}
