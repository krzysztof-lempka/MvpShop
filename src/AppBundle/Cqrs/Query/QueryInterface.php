<?php

namespace AppBundle\Cqrs\Query;

use Doctrine\DBAL\Connection as Dbal;

interface QueryInterface
{
    public function execute(Dbal $dbal);
}
