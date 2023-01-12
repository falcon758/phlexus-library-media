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

use Phlexus\Libraries\Media\Files\Formatter\FormatterInterface;
use Phlexus\Libraries\Media\Models\MediaDestiny;
use Phlexus\Libraries\Media\Models\MediaType;
use Phlexus\Libraries\Helpers;
use Phalcon\Http\Request\File;
use Phalcon\Di\Di;
use Exception;

class Upload implements UploadInterface
{
    private File $file;

    private FormatterInterface $formatter;

    private int $dirTypeID;

    private int $fileTypeID;

    private string $baseDir;

    private string $uploadName;

    /**
     * Constructor
     * 
     * @throws Exception
     */
    public function _construct()
    {
        $dirTypeID     = MediaDestiny::DESTINY_USER;
        $uploadDir     = Helpers::getUploadDir();
        $userDirectory = Di::getDefault()->getShared('security')->getStaticUserToken();
        
        $this->setDirTypeID($dirTypeID);
        $this->setBaseDir($uploadDir . '/' . $userDirectory);
    }

    /**
     * Get file
     * 
     * @return string
     * 
     * @throws Exception
     */
    public function getFile(): File
    {
        if (!isset($this->file)) {
            throw new \Exception('File is not set!');
        }
        
        return $this->file;
    }

    /**
     * Set file
     * 
     * @param File $file
     * 
     * @return UploadInterface
     */
    public function setFile(File $file): UploadInterface
    {
        $this->file = $file;

        $this->setFileTypeID();

        return $this;
    }

    /**
     * Get formatter
     * 
     * @return FormatterInterface
     * 
     * @throws Exception
     */
    public function getFormatter(): FormatterInterface
    {
        if (!isset($this->formatter)) {
            throw new \Exception('Formatter is not set!');
        }

        return $this->formatter;
    }

    /**
     * Set formatter
     * 
     * @param FormatterInterface $formatter
     * 
     * @return UploadInterface
     */
    public function setFormatter(FormatterInterface $formatter): UploadInterface
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * Get directory type id
     * 
     * @return int
     */
    public function getDirTypeID(): int
    {
        return $this->dirTypeID;
    }

    /**
     * Set directory type id
     * 
     * @param int $dirTypeID
     * 
     * @return UploadInterface
     * 
     * @throws Exception
     */
    public function setDirTypeID(int $dirTypeID): UploadInterface
    {
        switch ($fileDestiny) {
            case MediaDestiny::DESTINY_INTERNAL:
            case MediaDestiny::DESTINY_USER:
                $this->fileDestiny = $fileDestiny;
                break;
            default:
                throw new \Exception('Destiny not supported');
        }

        return $this;
    }

    /**
     * Get file type id
     * 
     * @return int
     */
    public function getFileTypeID(): int
    {
        return $this->fileTypeID;
    }

    /**
     * Get base directory
     * 
     * @return string
     */
    public function getBaseDir(): string
    {
        return $this->baseDir;
    }

    /**
     * Set base directory
     * 
     * @param string $baseDir
     * 
     * @return UploadInterface
     */
    public function setBaseDir($baseDir): UploadInterface
    {
        $this->baseDir = $baseDir;

        return $this;
    }

    /**
     * Get upload name
     * 
     * @return string
     */
    public function getUploadName(): string
    {
        return $this->uploadName;
    }

    /**
     * Set upload name
     * 
     * @param string $name
     * 
     * @return UploadInterface
     */
    public function setUploadName(string $name): UploadInterface
    {
        $formatter = $this->formatter;

        $this->uploadName = $this->formatter->format($this->uploadName);

        return $this;
    }

    /**
     * Get upload directory
     * 
     * @return string
     */
    public function getUploadDir(): string
    {
        $baseDir = $this->getBaseDir();

        $dirTypeID = $this->getDirTypeID();

        $fileTypeID = $this->getFileTypeID();

        return $baseDir . '/' . $dirTypeID . '/' . $fileTypeID;
    }

    /**
     * Check if can upload
     * 
     * @return bool
     */
    public function canUpload(): bool
    {
        $uploadDir = $this->getUploadDir();

        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Upload file
     * 
     * @return bool
     * 
     * @throws Exception
     */
    public function upload(): bool
    {
        if (!$this->canUpload()) {
            throw new Exception('Unable to upload file!');
        }

        return $this->getFile()->moveTo($this->getUploadDir());
    }

    /**
     * Reset Upload
     * 
     * @return void
     */
    public function reset(): void
    {
        unset($this->file);
        unset($this->formatter);
        unset($this->dirTypeID);
        unset($this->fileTypeID);
        unset($this->baseDir);
        unset($this->uploadName);
    }

    /**
     * Set file type id
     * 
     * @return void
     * 
     * @throws Exception
     */
    private function setFileTypeID(): void
    {
        $mimeType = $this->file->getType();

        switch ($mimeType) {
            case 'image/png':
            case 'image/jpg':
                $this->fileTypeID = MediaType::TYPE_IMAGE;
                break;
            default:
                throw new Exception('Mime-Type not supported');
        }
    }
}
