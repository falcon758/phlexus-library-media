<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Media\Models;

use Phlexus\Models\Model;

/**
 * Class Media
 *
 * @package Phlexus\Libraries\Media\Models
 */
class Media extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    /**
     * @var int|null
     */
    public ?int $id;

    /**
     * @var string
     */
    public string $mediaName;

    /**
     * @var int
     */
    public int $mediaTypeID;

    /**
     * @var int
     */
    public int $mediaDestinyID;

    /**
     * @var int|null
     */
    public ?int $active;

    /**
     * @var string|null
     */
    public ?string $createdAt;

    /**
     * @var string|null
     */
    public ?string $modifiedAt;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->setSource('media');

        $this->hasOne('mediaDestinyID', MediaDestiny::class, 'id', [
            'alias'    => 'MediaDestiny',
            'reusable' => true,
        ]);

        $this->hasOne('mediaTypeID', MediaType::class, 'id', [
            'alias'    => 'MediaType',
            'reusable' => true,
        ]);
    }

    /**
     * Create media
     * 
     * @param string $mediaName    MediaName
     * @param int    $mediaType    MediaType
     * @param int    $mediaDestiny MediaDestiny
     * 
     * @return mixed Media or null
     */
    public static function createMedia(
        string $mediaName, int $mediaType, int $mediaDestiny
    ): ?Media
    {
        $media                 = new self;
        $media->mediaName      = $mediaName;
        $media->mediaTypeID    = $mediaType;
        $media->mediaDestinyID = $mediaDestiny;

        return $media->save() ? $media : null;
    }
}
