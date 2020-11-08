<?php
declare(strict_types=1);

namespace App\Domain\UserToken\Exception;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserTokenNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The token you requested does not exist.';
}
