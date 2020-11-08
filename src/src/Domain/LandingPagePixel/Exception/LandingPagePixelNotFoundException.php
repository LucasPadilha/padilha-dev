<?php
declare(strict_types=1);

namespace App\Domain\LandingPagePixel\Exception;

use App\Domain\DomainException\DomainRecordNotFoundException;

class LandingPagePixelNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The pixel you requested does not exist.';
}
