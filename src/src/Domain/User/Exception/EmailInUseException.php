<?php
declare(strict_types=1);

namespace App\Domain\User\Exception;

use App\Domain\DomainException\DomainException;

class EmailInUseException extends DomainException
{
    public $message = 'This e-mail is already in use.';
}
