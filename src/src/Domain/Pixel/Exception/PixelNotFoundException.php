<?php
declare(strict_types=1);

namespace App\Domain\Pixel\Exception;

use App\Domain\DomainException\DomainRecordNotFoundException;

class PixelNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The pixel you requested does not exist.';
}
