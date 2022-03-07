<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Media\Models;

use Phalcon\Mvc\Model;

/**
 * Class MediaDestiny
 *
 * @package Phlexus\Libraries\Media\Models
 */
class MediaDestiny extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public const DESTINY_USER = 1;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public string $mediaDestiny;

    /**
     * @var int|null
     */
    public $active;

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
