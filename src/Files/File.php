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

class File implements FileInterface
{
    private string $type;

    private string $dir;

    private string $name;

    /**
     * File constructor
     * 
     * @param string $file File to set
     */
    public function _construct(string $file)
    {
        $this->setFile();
    }

    /**
     * File exists
     * 
     * @return bool
     */
    public function exists(): bool
    {
        if (!isset($this->dir) || !isset($this->name)) {
            return false;
        }

        return file_exists($this->dir . $this->name);
    }

    /**
     * Get fullpath file
     * 
     * @return string
     * 
     * @throws BadMethodCallException
     */
    public function getFile(): string
    {
        if (!$this->exists()) {
            throw new \BadMethodCallException('File not set!');
        }

        return $this->getDirectory() . $this->getName();
    }

    /**
     * Set fullpath file
     * 
     * @param string $file
     * 
     * @return File
     * 
     * @throws InvalidArgumentException
     */
    public function setFile($file): File
    {
        if (!file_exists($file)) {
            throw new \InvalidArgumentException('File doesn\'t exists!');
        }

        $this->dir = dirname($file);

        $this->name = basename($file);

        return $this;
    }

    /**
     * Get filename
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get directory
     * 
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->dir;
    }

    /**
     * Get filetype
     * 
     * @return string
     * 
     * @throws BadMethodCallException
     */
    public function getFileType(): string
    {
        return filetype($this->getFile());
    }

    /**
     * Get content type
     * 
     * @return string
     * 
     * @throws BadMethodCallException
     */
    public function getContentType(): string
    {
        return mime_content_type($this->getFile());
    }

    /**
     * Get file size
     * 
     * @return int
     * 
     * @throws BadMethodCallException
     */
    public function getSize(): int
    {
        return filesize($this->getFile());
    }
}
