<?php

declare(strict_types=1);

namespace Phlexus\Libraries\Media\Files\Formatter;

class TimeFormatter implements FormatterInterface
{
    public function format(string $name): string
    {
        return (string) time();
    }
}
