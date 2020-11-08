<?php
declare(strict_types=1);

namespace App\Domain\LandingPageSection\Exception;

use App\Domain\DomainException\DomainRecordNotFoundException;

class LandingPageSectionNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The section you requested does not exist.';
}
