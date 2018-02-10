<?php

namespace AppBundle\Cqrs\Query;

use AppBundle\Entity\Product;
use Doctrine\DBAL\Connection as Dbal;

class SingleProductQuery
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function execute(Dbal $dbal) : array
    {
        return $dbal->fetchAssoc(
            'SELECT * FROM product WHERE id = :productId',
             [':productId' => $this->id]
         );
    }
}
