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
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public string $mediaType;

    /**
     * @var int|null
     */
    public $active;

    /**
     * @var string|null
     */
    public $createdAt;

    /**
     * @var string|null
     */
    public $modifiedAt;

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
