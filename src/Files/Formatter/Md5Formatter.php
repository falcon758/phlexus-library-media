<?php

declare(strict_types=1);

namespace Phlexus\Libraries\Media\Files\Formatter;

class Md5Formatter implements FormatterInterface
{
    public function format(string $name): string
    {
        return md5($name);
    }
}
