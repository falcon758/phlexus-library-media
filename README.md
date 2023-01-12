# Phlexus Media Library

Media library for Phlexus CMS.

## Example of usage

```php
use Phlexus\Libraries\Media\Files\Upload;
use Exception;

$files = $this->request->getUploadedFiles(true, true);

try {
    $uploader = new Upload();
    $status = $uploader->setFile($files['image'])
                        ->upload();
} catch (Exception $e) {
    exit($e->getMessage());
}
``` 

