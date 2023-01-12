<?php

declare(strict_types=1);

namespace Phlexus\Libraries\Media\Files\Formatter;

use Phalcon\Di\Di;

class TimeFormatter implements FormatterInterface
{
    public function format(string $name): string
    {
        return base64_encode(Di::getDefault()->getShared('security')->getUserToken($fileName));
    }
}
