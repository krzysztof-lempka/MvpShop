<?php

namespace AppBundle\Cqrs\Query;

use AppBundle\Cqrs\Query\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;

/**
 * Performs the query specified in an instance of class implementing QueryInteface
 * and retrieves result
 */
class QueryDispatcher
{
    private $dbal;

    public function __construct(Dbal $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * Performs the query on the database and returns retrieved data.
     */
    public function execute(QueryInterface $query)
    {
        return $query->execute($this->dbal);
    }
}
