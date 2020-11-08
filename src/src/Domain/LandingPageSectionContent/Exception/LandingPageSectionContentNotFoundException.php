<?php
declare(strict_types=1);

namespace App\Domain\LandingPageSectionContent\Exception;

use App\Domain\DomainException\DomainRecordNotFoundException;

class LandingPageSectionContentNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The section content you requested does not exist.';
}
