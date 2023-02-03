<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <cms@phlexus.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phlexus\Libraries\Media\Files;

use Phlexus\Libraries\Media\Models\Media AS MediaModel;

class Media extends Upload
{
    /**
     * Upload media
     * 
     * @return bool
     * 
     * @throws Exception
     */
    public function uploadMedia(): ?MediaModel
    {
        if (!$this->upload()) {
            return null;
        }

        $media = MediaModel::createMedia(
            $this->getUploadName(),
            $this->getFileTypeID(),
            $this->getDirTypeID()
        );

        $this->reset();

        return $media;
    }
}
