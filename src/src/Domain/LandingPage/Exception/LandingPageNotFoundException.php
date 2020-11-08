<?php
declare(strict_types=1);

namespace App\Domain\LandingPage\Exception;

use App\Domain\DomainException\DomainRecordNotFoundException;

class LandingPageNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The landing page you requested does not exist.';
}
