<?php
declare(strict_types=1);

namespace App\Infrastructure;

use Phinx\Seed\AbstractSeed;

class Seed extends AbstractSeed
{
    protected $capsule;

    public function init()
    {
        $this->capsule = $this->getAdapter()->getOption('capsule');
    }
}