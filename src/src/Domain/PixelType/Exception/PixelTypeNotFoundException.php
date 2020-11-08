<?php
declare(strict_types=1);

namespace App\Domain\PixelType\Exception;

use App\Domain\DomainException\DomainRecordNotFoundException;

class PixelTypeNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The pixel type you requested does not exist.';
}
