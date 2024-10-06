<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Media\Models;

use Phlexus\Models\Model;

/**
 * Class MediaType
 *
 * @package Phlexus\Libraries\Media\Models
 */
class MediaType extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public const TYPE_IMAGE = 1;

    public const TYPE_AUDIO = 2;

    /**
     * @var int|null
     */
    public ?int $id = null;

    /**
     * @var string
     */
    public string $mediaType;

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
        $this->setSource('media_type');
    }
}
