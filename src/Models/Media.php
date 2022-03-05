<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Media\Models;

use Phalcon\Mvc\Model;

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
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $mediaName;

    /**
     * @var int
     */
    public $mediaTypeID;

    /**
     * @var int
     */
    public $mediaDestinyID;

    /**
     * @var int
     */
    public $active;

    /**
     * @var string
     */
    public $createdAt;

    /**
     * @var string
     */
    public $modifiedAt;

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
    )
    {
        $media                 = new self;
        $media->mediaName      = $mediaName;
        $media->mediaTypeID    = $mediaType;
        $media->mediaDestinyID = $mediaDestiny;

        return $media->save() ? $media : null;
    }

    /**
     * Create media
     * 
     * @param string $mediaName    MediaName
     * @param string $mediaType    MediaType
     * @param string $mediaDestiny MediaDestiny
     * 
     * @return mixed Media or null
     */
    public static function createMediaByName(
        string $mediaName, string $mediaType, string $mediaDestiny
    )
    {
        $mediaTypeModel = MediaType::findFirstBymediaType($mediaType);

        $mediaDestinyModel = MediaDestiny::findFirstBymediaDestiny($mediaDestiny);

        if (!$mediaTypeModel || !$mediaDestinyModel) {
            return null;
        }

        $media               = new self;
        $media->mediaName    = $mediaName;
        $media->mediaTypeID    = $mediaTypeModel->id;
        $media->mediaDestinyID = $mediaDestinyModel->id;

        return $media->save() ? $media : null;
    }
}
