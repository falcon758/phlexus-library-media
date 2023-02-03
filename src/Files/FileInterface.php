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

interface FileInterface
{
    /**
     * File exists
     * 
     * @return bool
     */
    public function exists(): bool;

    /**
     * Get fullpath file
     * 
     * @return string
     * 
     * @throws BadMethodCallException
     */
    public function getFile(): string;

    /**
     * Set fullpath file
     * 
     * @param string $file
     * 
     * @return FileInterface
     * 
     * @throws InvalidArgumentException
     */
    public function setFile(string $file): FileInterface;

    /**
     * Get filename
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Get directory
     * 
     * @return string
     */
    public function getDirectory(): string;

    /**
     * Get filetype
     * 
     * @return string
     */
    public function getFileType(): string;

    /**
     * Get content type
     * 
     * @return string
     */
    public function getContentType(): string;

    /**
     * Get file size
     * 
     * @return int
     */
    public function getSize(): int;

    /**
     * Get file content
     * 
     * @return string
     * 
     * @throws BadMethodCallException
     */
    public function getContent(): string;
}
