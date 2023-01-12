# Phlexus Media Library

Media library for Phlexus CMS.

## Example of usage

```php
use Phlexus\Libraries\Media\Files\Upload;
use Exception;

$files = $this->request->getUploadedFiles(true, true);

$uploader = new Upload($files['image']);

try {
    $status = $uploader->upload();
} catch (Exception $e) {
    exit($e->getMessage());
}
``` 

