# Phlexus Media Library

Media library for Phlexus CMS.

## Example of usage

```php
use Phlexus\Libraries\Media\Handler;

$files = $this->request->getUploadedFiles(true, true);

$handler = new Handler($files['image']);
            
$status = $handler->setFileDestiny(MediaDestiny::DESTINY_USER)->uploadFile()
``` 

