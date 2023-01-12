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

interface OperationsInterface
{
    /**
     * Rename file
     * 
     * @param string $newName New name to set
     * 
     * @return bool
     */
    public function rename(string $newName): bool;

    /**
     * Copy file
     * 
     * @param string $copyTo Copy directory
     * 
     * @return bool
     */
    public function copy(string $copyTo): bool;

    /**
     * Move file
     * 
     * @param string $moveTo Move directory
     * 
     * @return bool
     */
    public function move(string $moveTo): bool;

    /**
     * Delete file
     * 
     * @return bool
     */
    public function delete(): bool;
}
