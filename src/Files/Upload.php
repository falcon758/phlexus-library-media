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
use Phlexus\Libraries\Media\Files\Formatter\UserFormatter;
use Phlexus\Libraries\Media\Models\MediaDestiny;
use Phlexus\Libraries\Media\Models\MediaType;
use Phlexus\PhlexusHelpers\Files;
use Phalcon\Http\Request\File;
use Phalcon\Di\Di;
use Exception;

class Upload implements UploadInterface
{
    private const SYSTEM_DIR = 'intrl';

    private File $file;

    private FormatterInterface $formatter;

    private int $dirTypeID;

    private int $fileTypeID;

    private string $baseDir;

    private string $targetDir;

    private string $uploadName;

    private array $allowedMimeTypes;

    /**
     * Constructor
     * 
     * @throws Exception
     */
    public function __construct()
    {
        $dirTypeID = MediaDestiny::DESTINY_USER;
        $uploadDir = Files::getUploadDir();
        $userDir   = Di::getDefault()->getShared('security')->getStaticUserToken();

        $this->setDirTypeID($dirTypeID)
             ->setBaseDir($uploadDir)
             ->setTargetDir($userDir)
             ->setFormatter(new UserFormatter);
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
        $this->setUploadName($file->getName());

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
        switch ($dirTypeID) {
            case MediaDestiny::DESTINY_INTERNAL:
            case MediaDestiny::DESTINY_USER:
                $this->dirTypeID = $dirTypeID;
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
     * Get target directory
     * 
     * @return string
     */
    public function getTargetDir(): string
    {
        return $this->targetDir;
    }

    /**
     * Set target directory
     * 
     * @param string $targetDir
     * 
     * @return UploadInterface
     */
    public function setTargetDir(string $targetDir): UploadInterface
    {
        $this->targetDir = $targetDir;

        return $this;
    }

    /**
     * Set target directory as system
     * 
     * @return UploadInterface
     */
    public function setTargetDirSystem(): UploadInterface
    {
        $this->targetDir = self::SYSTEM_DIR;

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

        $this->uploadName = $this->formatter->format($name);

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

        return $baseDir . $this->getRelativeUploadDir();
    }

    /**
     * Get relative upload directory
     * 
     * @return string
     */
    public function getRelativeUploadDir(): string
    {
        $fileTypeID = $this->getFileTypeID();
        $dirTypeID  = $this->getDirTypeID();
        $targetDir  = $this->getTargetDir();

        return implode('/', [ $fileTypeID, $dirTypeID, $targetDir]);
    }

    /**
     * Set allowed mimetypes
     * 
     * @param array $mimetypes
     * 
     * @return UploadInterface
     */
    public function setAllowedMimeTypes(array $mimetypes): UploadInterface
    {
        $this->allowedMimeTypes = $mimetypes;

        return $this;
    }

    /**
     * Get allowed mimetypes
     * 
     * @return array
     */
    public function getAllowedMimeTypes(): array
    {
        return $this->allowedMimeTypes;
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
        } else if (!in_array($this->file->getType(), $this->getAllowedMimeTypes())) {
            throw new Exception('Invalid MimeType!');
        }

        $uploadName = $this->getUploadName();

        return $this->getFile()->moveTo($this->getUploadDir() . '/' . $uploadName);
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
        $mimetype = $this->file->getType();

        $mimeTypesRelation = [
            MediaType::TYPE_IMAGE => MimeTypes::IMAGES,
            MediaType::TYPE_AUDIO => MimeTypes::WAV,
        ];

        $fileTypeID = null;
        
        foreach ($mimeTypesRelation as $fileType => $mimeTypes) {
            if (in_array($mimetype, $mimeTypes)) {
                $fileTypeID = $fileType;
                break;
            }
        }

        if (!$fileTypeID) {
            throw new Exception('Mime-Type not supported');
        }

        $this->fileTypeID = $fileTypeID;
    }
}
