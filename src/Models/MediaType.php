<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Media\Models;

use Phalcon\Mvc\Model;

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

    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $mediaType;

    /**
     * @var int
     */
    public int $active;

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
