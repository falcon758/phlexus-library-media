<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Media\Models;

use Phlexus\Models\Model;

/**
 * Class MediaDestiny
 *
 * @package Phlexus\Libraries\Media\Models
 */
class MediaDestiny extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public const DESTINY_INTERNAL = 1;

    public const DESTINY_USER = 2;

    /**
     * @var int|null
     */
    public ?int $id = null;

    /**
     * @var string
     */
    public string $mediaDestiny;

    /**
     * @var int|null
     */
    public ?int $active = null;

    /**
     * @var string|null
     */
    public ?string $createdAt = null;

    /**
     * @var string|null
     */
    public ?string $modifiedAt = null;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->setSource('media_destiny');
    }
}
