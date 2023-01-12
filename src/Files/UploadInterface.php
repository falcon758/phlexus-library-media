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

use Phalcon\Http\Request\File;

interface UploadInterface
{
    /**
     * Get file
     * 
     * @return string
     * 
     * @throws Exception
     */
    public function getFile(): File;

    /**
     * Set file
     * 
     * @param File $file
     * 
     * @return UploadInterface
     */
    public function setFile(File $file): UploadInterface;

    /**
     * Get base directory
     * 
     * @return string
     */
    public function getBaseDir(): string;

    /**
     * Set base directory
     * 
     * @param string $baseDir
     * 
     * @return UploadInterface
     */
    public function setBaseDir($baseDir): UploadInterface;

    /**
     * Get formatter
     * 
     * @return FormatterInterface
     * 
     * @throws Exception
     */
    public function getFormatter(): FormatterInterface;

    /**
     * Set formatter
     * 
     * @param FormatterInterface $formatter
     * 
     * @return UploadInterface
     */
    public function setFormatter(FormatterInterface $formatter): UploadInterface;

    /**
     * Get directory type id
     * 
     * @return int
     */
    public function getDirTypeID(): int;

    /**
     * Set directory type id
     * 
     * @param int $dirTypeID
     * 
     * @return UploadInterface
     */
    public function setDirTypeID(int $dirTypeID): UploadInterface;

    /**
     * Get file type id
     * 
     * @return int
     */
    public function getFileTypeID(): int;

    /**
     * Get upload name
     * 
     * @return string
     */
    public function getUploadName(): string;

    /**
     * Set upload name
     * 
     * @param string $name
     * 
     * @return UploadInterface
     */
    public function setUploadName(string $name): UploadInterface;

    /**
     * Get upload directory
     * 
     * @return string
     */
    public function getUploadDir(): string;

    /**
     * Check if can upload
     * 
     * @return bool
     */
    public function canUpload(): bool;

    /**
     * Upload file
     * 
     * @return bool
     * 
     * @throws Exception
     */
    public function upload(): bool;

    /**
     * Reset Upload
     * 
     * @return void
     */
    public function reset(): void;
}
