<?php
declare(strict_types=1);

namespace App\Infrastructure;

use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    protected $schema;

    public function init()
    {
        $this->schema = $this->getAdapter()->getOption('capsule')->schema();
    }
}