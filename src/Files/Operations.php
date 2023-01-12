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

class Operations extends File
{
    /**
     * Rename file
     * 
     * @param string $newName New name to set
     * 
     * @return bool
     * 
     * @throws BadMethodCallException
     */
    public function rename(string $newName): bool
    {
        return rename($this->getFile(), $this->getDirectory() . $newName);
    }

    /**
     * Copy file
     * 
     * @param string $copyTo Copy directory
     * 
     * @return bool
     * 
     * @throws BadMethodCallException
     */
    public function copy(string $copyTo): bool
    {
        return copy($this->getFile(), $this->getDirectory() . $copyTo);
    }

    /**
     * Move file
     * 
     * @param string $moveTo Move directory
     * 
     * @return bool
     * 
     * @throws BadMethodCallException
     */
    public function move(string $moveTo): bool
    {
        $newFile = $this->getDirectory() . $moveTo;

        if (file_exists($newFile)) {
            return false;
        }

        return move($this->getFile(), $newFile);
    }

    /**
     * Delete file
     * 
     * @return bool
     * 
     * @throws BadMethodCallException
     */
    public function delete(): bool
    {
        unlink($this->getFile());
    }
}
