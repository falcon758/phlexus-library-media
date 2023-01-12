<?php

declare(strict_types=1);

namespace Phlexus\Libraries\Media\Files\Formatter;


class OriginalFormatter implements FormatterInterface
{
    public function format(string $name): string
    {
        return $name;
    }
}
