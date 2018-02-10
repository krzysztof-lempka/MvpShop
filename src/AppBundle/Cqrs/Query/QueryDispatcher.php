<?php

namespace AppBundle\Cqrs\Query;

use Doctrine\DBAL\Connection as Dbal;

class QueryDispatcher
{
    private $dbal;

    public function __construct(Dbal $dbal)
    {
        $this->dbal = $dbal;
    }

    public function execute($query)
    {
        return $query->execute($this->dbal);
    }
}
