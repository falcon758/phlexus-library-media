<?php

declare(strict_types=1);

namespace Phlexus\Libraries\Media\Files\Formatter;

interface FormatterInterface
{
    public function format(string $name): string;
}
